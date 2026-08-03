<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ActivityLog;
use App\Services\AIService;

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch("SELECT COUNT(*) as total FROM blog_posts")['total'] ?? 0;

        $this->data['posts'] = $this->db->fetchAll(
            "SELECT bp.*, u.name as author_name, bc.name_pt as category_name
             FROM blog_posts bp
             LEFT JOIN users u ON bp.author_id = u.id
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             ORDER BY bp.created_at DESC LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );
        $this->data['pagination'] = ['current_page' => $page, 'total_pages' => (int) ceil($total / $perPage), 'total' => $total];
        $this->data['page_title'] = 'Blog - ' . SITE_NAME;
        $this->view('admin/blog/index', $this->data, 'admin');
    }

    public function create(): void
    {
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM blog_categories WHERE is_active = 1 ORDER BY name_pt");
        $this->data['page_title'] = 'Novo Post - ' . SITE_NAME;
        $this->view('admin/blog/form', $this->data, 'admin');
    }

    public function store(): void
    {
        if (!$this->validateCsrf()) return;

        $data = [
            'title_pt'           => $this->input('title_pt'),
            'title_en'           => $this->input('title_en'),
            'title_es'           => $this->input('title_es'),
            'slug'               => slugify($this->input('title_pt')),
            'excerpt_pt'         => $this->input('excerpt_pt'),
            'content_pt'         => $_POST['content_pt'] ?? '',
            'content_en'         => $_POST['content_en'] ?? '',
            'content_es'         => $_POST['content_es'] ?? '',
            'category_id'        => $this->input('category_id') ?: null,
            'author_id'          => $_SESSION['user_id'],
            'status'             => $this->input('status', 'draft'),
            'is_featured'        => isset($_POST['is_featured']) ? 1 : 0,
            'meta_title_pt'      => $this->input('meta_title_pt'),
            'meta_description_pt'=> $this->input('meta_description_pt'),
            'meta_keywords'      => $this->input('meta_keywords'),
            'featured_image'     => $this->input('featured_image'),
            'published_at'       => $this->input('status') === 'published' ? date('Y-m-d H:i:s') : null,
            'scheduled_at'       => $this->input('scheduled_at') ?: null,
        ];

        // Handle unique slug
        $existing = $this->db->fetch("SELECT id FROM blog_posts WHERE slug = ?", [$data['slug']]);
        if ($existing) $data['slug'] .= '-' . time();

        $postId = $this->db->insert('blog_posts', $data);

        // Tags
        $this->syncTags($postId, $this->input('tags'));

        (new ActivityLog())->log('create', 'blog', "Post criado: {$data['title_pt']}", ['target_type' => 'blog_post', 'target_id' => $postId]);

        $this->flash('success', 'Post criado com sucesso!');
        $this->redirect('admin/blog');
    }

    public function edit(string $id): void
    {
        $post = $this->db->fetch("SELECT * FROM blog_posts WHERE id = ?", [(int)$id]);
        if (!$post) { $this->redirect('admin/blog'); return; }

        $this->data['post'] = $post;
        $this->data['categories'] = $this->db->fetchAll("SELECT * FROM blog_categories WHERE is_active = 1 ORDER BY name_pt");
        $this->data['post_tags'] = $this->db->fetchAll("SELECT bt.name FROM blog_tags bt JOIN blog_post_tags bpt ON bt.id = bpt.tag_id WHERE bpt.post_id = ?", [(int)$id]);
        $this->data['page_title'] = 'Editar Post - ' . SITE_NAME;
        $this->view('admin/blog/form', $this->data, 'admin');
    }

    public function update(string $id): void
    {
        if (!$this->validateCsrf()) return;

        $data = [
            'title_pt'           => $this->input('title_pt'),
            'title_en'           => $this->input('title_en'),
            'title_es'           => $this->input('title_es'),
            'excerpt_pt'         => $this->input('excerpt_pt'),
            'content_pt'         => $_POST['content_pt'] ?? '',
            'content_en'         => $_POST['content_en'] ?? '',
            'content_es'         => $_POST['content_es'] ?? '',
            'category_id'        => $this->input('category_id') ?: null,
            'status'             => $this->input('status', 'draft'),
            'is_featured'        => isset($_POST['is_featured']) ? 1 : 0,
            'meta_title_pt'      => $this->input('meta_title_pt'),
            'meta_description_pt'=> $this->input('meta_description_pt'),
            'meta_keywords'      => $this->input('meta_keywords'),
            'featured_image'     => $this->input('featured_image'),
            'scheduled_at'       => $this->input('scheduled_at') ?: null,
        ];

        $oldPost = $this->db->fetch("SELECT * FROM blog_posts WHERE id = ?", [(int)$id]);
        if ($oldPost['status'] !== 'published' && $data['status'] === 'published') {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $this->db->update('blog_posts', $data, 'id = ?', [(int)$id]);
        $this->syncTags((int)$id, $this->input('tags'));

        $this->flash('success', 'Post atualizado com sucesso!');
        $this->redirect('admin/blog/' . $id . '/edit');
    }

    public function delete(string $id): void
    {
        if (!$this->validateCsrf()) return;
        $this->db->delete('blog_posts', 'id = ?', [(int)$id]);
        (new ActivityLog())->log('delete', 'blog', "Post excluído ID: {$id}");
        $this->flash('success', 'Post excluído.');
        $this->redirect('admin/blog');
    }

    /**
     * Gera post com IA.
     */
    public function generateWithAI(): void
    {
        if (!$this->validateCsrf()) return;

        $topic = $_POST['topic'] ?? '';
        if (empty($topic)) {
            $this->json(['success' => false, 'message' => 'Informe o tema do artigo.'], 400);
            return;
        }

        try {
            $aiService = new AIService(setting('blog_ai_model', 'openai'));
            $result = $aiService->generateBlogPost($topic, [
                'writing_style' => setting('blog_ai_writing_style', 'professional'),
                'custom_prompt' => setting('blog_ai_custom_prompt', ''),
            ]);

            // Criar post como rascunho
            $data = [
                'title_pt'           => $result['title'] ?? $topic,
                'slug'               => $result['slug'] ?? slugify($topic),
                'excerpt_pt'         => $result['excerpt'] ?? '',
                'content_pt'         => $result['content'] ?? '',
                'meta_description_pt'=> $result['meta_description'] ?? '',
                'meta_keywords'      => $result['keywords'] ?? '',
                'author_id'          => $_SESSION['user_id'],
                'status'             => 'draft',
                'generated_by_ai'    => 1,
                'ai_model_used'      => setting('blog_ai_model', 'openai'),
            ];

            $existing = $this->db->fetch("SELECT id FROM blog_posts WHERE slug = ?", [$data['slug']]);
            if ($existing) $data['slug'] .= '-' . time();

            $postId = $this->db->insert('blog_posts', $data);

            // Tags sugeridas pela IA
            if (!empty($result['suggested_tags'])) {
                $tagNames = implode(',', $result['suggested_tags']);
                $this->syncTags($postId, $tagNames);
            }

            (new ActivityLog())->log('ai_generate', 'blog', "Post gerado por IA: {$data['title_pt']}");

            $this->json(['success' => true, 'message' => 'Post gerado com sucesso!', 'post_id' => $postId]);

        } catch (\Exception $e) {
            appLog("Erro ao gerar post com IA: " . $e->getMessage(), 'error');
            $this->json(['success' => false, 'message' => 'Erro ao gerar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Sincroniza tags do post.
     */
    private function syncTags(int $postId, ?string $tagsStr): void
    {
        $this->db->delete('blog_post_tags', 'post_id = ?', [$postId]);

        if (empty($tagsStr)) return;

        $tags = array_map('trim', explode(',', $tagsStr));
        foreach ($tags as $tagName) {
            if (empty($tagName)) continue;
            $slug = slugify($tagName);

            $tag = $this->db->fetch("SELECT id FROM blog_tags WHERE slug = ?", [$slug]);
            if (!$tag) {
                $tagId = $this->db->insert('blog_tags', ['name' => $tagName, 'slug' => $slug]);
            } else {
                $tagId = $tag['id'];
            }

            $this->db->insert('blog_post_tags', ['post_id' => $postId, 'tag_id' => $tagId]);
        }
    }
}
