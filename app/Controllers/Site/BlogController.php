<?php

namespace App\Controllers\Site;

use App\Core\Controller;

class BlogController extends Controller
{
    /**
     * Lista de posts — agora servida com o layout/tema 2026
     * (referência /blog-2026), reaproveitando os dados reais do banco.
     */
    public function index(): void
    {
        $this->prepareBlogIndexData();
        $this->view('site/blog-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados da listagem do blog (posts, categorias, paginação) com
     * conteúdo real do banco. Compartilhado entre /blog e /blog-2026,
     * evitando duplicação de lógica entre as duas rotas.
     */
    private function prepareBlogIndexData(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        if ($page < 1) $page = 1;
        $perPage = 9;
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch("SELECT COUNT(*) as total FROM blog_posts WHERE status = 'published'");
        $totalRecords = (int) ($total['total'] ?? 0);
        $totalPages = (int) ceil($totalRecords / $perPage);

        $this->data['posts'] = $this->db->fetchAll(
            "SELECT bp.*, u.name as author_name, bc.name_pt as category_name, bc.slug as category_slug
             FROM blog_posts bp
             LEFT JOIN users u ON bp.author_id = u.id
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             WHERE bp.status = 'published'
             ORDER BY bp.published_at DESC
             LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );
        $this->data['categories'] = $this->db->fetchAll(
            "SELECT bc.*, COUNT(bp.id) as post_count
             FROM blog_categories bc
             LEFT JOIN blog_posts bp ON bc.id = bp.category_id AND bp.status = 'published'
             WHERE bc.is_active = 1
             GROUP BY bc.id
             ORDER BY bc.name_pt ASC"
        );
        $this->data['page_title'] = __('blog.title') . ' - ' . SITE_NAME;
        $this->data['meta_description'] = __('blog.meta_description');
        $this->data['body_class'] = 'blog2026-page';
        $this->data['pagination'] = [
            'current_page' => $page,
            'total_pages'  => $totalPages,
            'total'        => $totalRecords,
        ];
    }

    /**
     * Post individual — agora servido com o layout/tema 2026
     * (referência /blog-2026/{slug}), reaproveitando os dados reais do banco.
     */
    public function show(string $slug): void
    {
        if (!$this->prepareBlogPostData($slug)) {
            return; // 404 já tratado
        }
        $this->view('site/blog-post-2026', $this->data, 'site-2026');
    }

    /**
     * Monta os dados do post individual (post, tags, relacionados, SEO/OG) com
     * conteúdo real do banco e incrementa o contador de views.
     * Compartilhado entre /blog/{slug} e /blog-2026/{slug}.
     * Retorna false quando o post não existe (resposta 404 já emitida).
     */
    private function prepareBlogPostData(string $slug): bool
    {
        $lang = defined('CURRENT_LANG') ? CURRENT_LANG : 'pt';

        $post = $this->db->fetch(
            "SELECT bp.*, u.name as author_name, u.avatar as author_avatar, bc.name_pt as category_name, bc.slug as category_slug
             FROM blog_posts bp
             LEFT JOIN users u ON bp.author_id = u.id
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             WHERE bp.slug = ? AND bp.status = 'published'",
            [$slug]
        );

        if (!$post) {
            http_response_code(404);
            (new \App\Controllers\ErrorController())->notFound();
            return false;
        }

        // Incrementar views (preservado)
        $this->db->query("UPDATE blog_posts SET views_count = views_count + 1 WHERE id = ?", [$post['id']]);

        // Tags do post
        $tags = $this->db->fetchAll(
            "SELECT bt.* FROM blog_tags bt
             JOIN blog_post_tags bpt ON bt.id = bpt.tag_id
             WHERE bpt.post_id = ?",
            [$post['id']]
        );
        // Posts relacionados
        $related = $this->db->fetchAll(
            "SELECT bp.*, bc.name_pt as category_name
             FROM blog_posts bp
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             WHERE bp.status = 'published' AND bp.id != ? AND bp.category_id = ?
             ORDER BY bp.published_at DESC LIMIT 3",
            [$post['id'], $post['category_id']]
        );

        $titleField = "title_{$lang}";
        $metaTitleField = "meta_title_{$lang}";
        $metaDescField = "meta_description_{$lang}";
        $this->data['page_title'] = ($post[$metaTitleField] ?? $post[$titleField] ?? $post['title_pt']) . ' - ' . SITE_NAME;
        $this->data['meta_description'] = $post[$metaDescField] ?? $post['meta_description_pt'] ?? '';
        $this->data['post'] = $post;
        $this->data['tags'] = $tags;
        $this->data['related_posts'] = $related;
        $this->data['og_image'] = $post['og_image'] ?? $post['featured_image'] ?? '';
        $this->data['body_class'] = 'blogpost2026-page';

        return true;
    }

    /**
     * Posts por categoria — servido com o tema 2026, reusando a listagem do blog
     * (grade de posts + barra de categorias) para manter a consistência visual.
     */
    public function category(string $slug): void
    {
        $category = $this->db->fetch(
            "SELECT * FROM blog_categories WHERE slug = ? AND is_active = 1",
            [$slug]
        );

        if (!$category) {
            http_response_code(404);
            (new \App\Controllers\ErrorController())->notFound();
            return;
        }

        $posts = $this->db->fetchAll(
            "SELECT bp.*, u.name as author_name, bc.name_pt as category_name, bc.slug as category_slug
             FROM blog_posts bp
             LEFT JOIN users u ON bp.author_id = u.id
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             WHERE bp.status = 'published' AND bp.category_id = ?
             ORDER BY bp.published_at DESC",
            [$category['id']]
        );

        $this->data['page_title'] = $category['name_pt'] . ' - Blog - ' . SITE_NAME;
        $this->data['category'] = $category;
        $this->data['posts'] = $posts;
        $this->data['categories'] = $this->allBlogCategories();
        $this->data['pagination'] = ['current_page' => 1, 'total_pages' => 1, 'total' => count($posts)];
        $this->data['body_class'] = 'blog2026-page';

        $this->view('site/blog-2026', $this->data, 'site-2026');
    }

    /**
     * Posts por tag — servido com o tema 2026, reusando a listagem do blog.
     */
    public function tag(string $slug): void
    {
        $tag = $this->db->fetch("SELECT * FROM blog_tags WHERE slug = ?", [$slug]);

        if (!$tag) {
            http_response_code(404);
            (new \App\Controllers\ErrorController())->notFound();
            return;
        }

        $posts = $this->db->fetchAll(
            "SELECT bp.*, u.name as author_name, bc.name_pt as category_name, bc.slug as category_slug
             FROM blog_posts bp
             JOIN blog_post_tags bpt ON bp.id = bpt.post_id
             LEFT JOIN users u ON bp.author_id = u.id
             LEFT JOIN blog_categories bc ON bp.category_id = bc.id
             WHERE bp.status = 'published' AND bpt.tag_id = ?
             ORDER BY bp.published_at DESC",
            [$tag['id']]
        );

        $this->data['page_title'] = $tag['name'] . ' - Blog - ' . SITE_NAME;
        $this->data['tag'] = $tag;
        $this->data['posts'] = $posts;
        $this->data['categories'] = $this->allBlogCategories();
        $this->data['pagination'] = ['current_page' => 1, 'total_pages' => 1, 'total' => count($posts)];
        $this->data['body_class'] = 'blog2026-page';

        $this->view('site/blog-2026', $this->data, 'site-2026');
    }

    /**
     * Categorias ativas com contagem de posts (barra de filtros do blog 2026).
     */
    private function allBlogCategories(): array
    {
        return $this->db->fetchAll(
            "SELECT bc.*, COUNT(bp.id) as post_count
             FROM blog_categories bc
             LEFT JOIN blog_posts bp ON bc.id = bp.category_id AND bp.status = 'published'
             WHERE bc.is_active = 1
             GROUP BY bc.id
             ORDER BY bc.name_pt ASC"
        );
    }
}
