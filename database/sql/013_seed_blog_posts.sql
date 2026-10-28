-- ============================================================
-- On Solutions - Script SQL #013
-- Seed dos posts do blog (portados FIELMENTE da referência:
-- docs/referencia/home-ref.html). Idempotente por slug.
-- Capas em public/assets/img/blog/<slug>.jpg
-- ============================================================

SET NAMES utf8mb4;

-- 1) Garante as categorias usadas pelos posts (não duplica: slug é UNIQUE).
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('ERP', 'ERP', 'ERP', 'erp', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('CRM', 'CRM', 'CRM', 'crm', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('Sistemas', 'Systems', 'Sistemas', 'sistemas', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('Automação', 'Automation', 'Automatización', 'automacao', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('Atendimento', 'Customer Service', 'Atención', 'atendimento', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);
INSERT INTO `blog_categories` (`name_pt`, `name_en`, `name_es`, `slug`, `is_active`) VALUES ('Dados', 'Data', 'Datos', 'dados', 1) ON DUPLICATE KEY UPDATE `name_pt` = VALUES(`name_pt`);

-- 2) Autor: usa o primeiro usuário (admin). Ajuste se necessário.
SET @author_id = (SELECT MIN(`id`) FROM `users`);

-- 3) Insere/atualiza os posts (idempotente por slug).
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('Quanto custa um ERP sob medida? O que pesa no preço', 'quanto-custa-um-erp-sob-medida', 'Quando um dono pergunta “quanto custa um ERP sob medida?”, a resposta honesta é: depende do que a empresa precisa. Mas dá para entender o que mexe no valor e, principalmente, co...', '<p>Quando um dono pergunta “quanto custa um ERP sob medida?”, a resposta honesta é: depende do que a empresa precisa. Mas dá para entender o que mexe no valor e, principalmente, como pedir uma proposta que você consiga comparar.</p>
<h2>O que faz o preço mudar</h2>
<ul>
<li><strong>Escopo:</strong> quais áreas entram (financeiro, estoque, compras, vendas, produção, equipe) e o quanto cada uma precisa ser detalhada.</li>
<li><strong>Regras do seu negócio:</strong> quanto mais exceções, aprovações e particularidades, mais trabalho de desenho e de teste.</li>
<li><strong>Integrações:</strong> emissão de notas fiscais, bancos, loja virtual, WhatsApp e outros sistemas que precisam conversar com o ERP.</li>
<li><strong>Migração de dados:</strong> trazer clientes, produtos e histórico de planilhas ou de um sistema antigo.</li>
<li><strong>Usuários e acessos:</strong> quem vê e faz o quê dentro do sistema.</li>
<li><strong>Treinamento e suporte:</strong> o quanto o fornecedor acompanha a sua equipe depois da entrega.</li>
</ul>
<h2>Sob medida ou pronto: onde está a diferença de custo</h2>
<p>Um ERP pronto costuma ter um valor inicial menor, mas você paga por funções que talvez nunca use e acaba adaptando o seu processo ao sistema. No sob medida, o investimento inicial tende a ser maior, porque o sistema nasce do jeito que a sua empresa trabalha. A conta certa olha o custo de alguns anos, e não só o primeiro mês.</p>
<h2>Como pedir uma proposta que dá para comparar</h2>
<ol>
<li>Liste as áreas que precisam entrar primeiro e as que podem ficar para depois.</li>
<li>Descreva os três processos que mais doem hoje, como o fechamento do mês ou o controle de estoque.</li>
<li>Peça por escrito o escopo, o prazo, o valor e o que está fora do pacote.</li>
<li>Pergunte como funciona o suporte e quem é dono do código e dos dados.</li>
</ol>
<h2>Dá para começar menor?</h2>
<p>Dá. Muitas empresas começam por um módulo, como financeiro e vendas, e ampliam em etapas. Isso reduz o risco e permite ver resultado cedo, antes de investir no sistema inteiro.</p>', '/assets/img/blog/quanto-custa-um-erp-sob-medida.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'erp' LIMIT 1), 'published', 'Quanto custa um ERP sob medida? O que pesa no preço', 'Quando um dono pergunta “quanto custa um ERP sob medida?”, a resposta honesta é: depende do que a empresa precisa. Mas dá para entender o que mexe no valor e, principalmente, co...', '/assets/img/blog/quanto-custa-um-erp-sob-medida.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('CRM ou planilha: quando é hora de trocar?', 'crm-ou-planilha-quando-trocar', 'A planilha é uma ótima ferramenta para começar. O problema aparece quando o número de clientes, orçamentos e pessoas envolvidas cresce e a planilha vira um lugar onde as informa...', '<p>A planilha é uma ótima ferramenta para começar. O problema aparece quando o número de clientes, orçamentos e pessoas envolvidas cresce e a planilha vira um lugar onde as informações se perdem.</p>
<h2>Sinais de que a planilha já não dá conta</h2>
<ul>
<li>Orçamentos espalhados entre WhatsApp, e-mail e papel.</li>
<li>Ninguém sabe em que etapa está cada cliente.</li>
<li>O retorno depende da memória de cada vendedor.</li>
<li>Você não consegue dizer de onde vêm os melhores clientes.</li>
<li>Quando alguém sai da equipe, leva a carteira de clientes junto.</li>
</ul>
<h2>O que muda com um CRM</h2>
<p>O CRM reúne em um só lugar os contatos, as conversas e as propostas. Cada negociação fica em uma etapa do funil, com o próximo passo definido e um lembrete para ninguém ficar sem resposta. No fim do mês, você enxerga o que realmente converte.</p>
<h2>Como começar sem complicar</h2>
<ol>
<li>Desenhe de três a cinco etapas simples para o seu funil, do primeiro contato ao fechamento.</li>
<li>Defina o mínimo que precisa ser registrado em cada contato.</li>
<li>Comece migrando só os contatos ativos, e não todo o histórico.</li>
<li>Combine uma rotina semanal curta para revisar as negociações paradas.</li>
<li>Acompanhe poucos números: quantos entraram, quantos avançaram e quantos fecharam.</li>
</ol>
<h2>CRM pronto ou sob medida?</h2>
<p>Se o seu processo de venda é parecido com o da maioria, um CRM pronto pode bastar. Se ele tem etapas próprias, aprovações ou integrações com outros sistemas, vale pensar em um CRM desenhado para o seu jeito de vender, sem funções que você não usa.</p>', '/assets/img/blog/crm-ou-planilha-quando-trocar.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'crm' LIMIT 1), 'published', 'CRM ou planilha: quando é hora de trocar?', 'A planilha é uma ótima ferramenta para começar. O problema aparece quando o número de clientes, orçamentos e pessoas envolvidas cresce e a planilha vira um lugar onde as informa...', '/assets/img/blog/crm-ou-planilha-quando-trocar.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('Sistema pronto ou sob medida? Como decidir', 'sistema-pronto-ou-sob-medida', 'Não existe resposta certa para todo mundo. Existem situações em que um sistema pronto resolve muito bem e outras em que ele vira um freio. A decisão fica mais simples quando voc...', '<p>Não existe resposta certa para todo mundo. Existem situações em que um sistema pronto resolve muito bem e outras em que ele vira um freio. A decisão fica mais simples quando você olha para o seu processo, e não para a lista de funções do software.</p>
<h2>Quando o sistema pronto costuma servir</h2>
<ul>
<li>O seu processo é parecido com o da maioria das empresas do setor.</li>
<li>Você precisa começar rápido e com pouco investimento inicial.</li>
<li>Há pouca necessidade de integrar com outros sistemas.</li>
</ul>
<h2>Quando vale pensar em sob medida</h2>
<ul>
<li>O seu jeito de operar é um diferencial e não cabe em um modelo pronto.</li>
<li>Você já usa várias planilhas paralelas para “completar” o sistema.</li>
<li>Precisa integrar ERP, loja, banco e WhatsApp para a informação fluir sozinha.</li>
<li>Espera crescer e não quer trocar de sistema daqui a dois anos.</li>
</ul>
<h2>Cinco perguntas para fazer antes de decidir</h2>
<ol>
<li>O meu processo é igual ao da maioria ou tem particularidades importantes?</li>
<li>Vou pagar por funções que a minha equipe não vai usar?</li>
<li>Com o que esse sistema precisa se integrar?</li>
<li>Consigo exportar os meus dados quando quiser?</li>
<li>Quanto vai custar manter e evoluir nos próximos anos?</li>
</ol>
<h2>Existe um meio-termo</h2>
<p>Em muitos casos, a melhor solução é combinar: manter um sistema pronto no que ele faz bem e construir sob medida só o que está faltando, conectando tudo por integrações. Assim você aproveita o que já funciona e investe apenas onde faz diferença.</p>', '/assets/img/blog/sistema-pronto-ou-sob-medida.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'sistemas' LIMIT 1), 'published', 'Sistema pronto ou sob medida? Como decidir', 'Não existe resposta certa para todo mundo. Existem situações em que um sistema pronto resolve muito bem e outras em que ele vira um freio. A decisão fica mais simples quando voc...', '/assets/img/blog/sistema-pronto-ou-sob-medida.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('Como automatizar processos repetitivos sem complicar a rotina', 'como-automatizar-processos-repetitivos', 'Quase toda empresa tem tarefas que alguém repete todo dia ou toda semana: montar o mesmo relatório, enviar avisos, atualizar planilhas, cobrar clientes. Automatizar isso libera ...', '<p>Quase toda empresa tem tarefas que alguém repete todo dia ou toda semana: montar o mesmo relatório, enviar avisos, atualizar planilhas, cobrar clientes. Automatizar isso libera tempo e reduz erros, desde que seja feito com ordem.</p>
<h2>Passo a passo</h2>
<ol>
<li><strong>Liste as tarefas repetitivas.</strong> Pergunte à equipe o que ela faz sempre do mesmo jeito.</li>
<li><strong>Priorize.</strong> Comece pelas que acontecem com mais frequência ou que mais geram erro.</li>
<li><strong>Escreva a regra.</strong> Toda automação segue um “quando isso acontecer, faça aquilo”. Se a regra não cabe em uma frase, o processo ainda não está claro.</li>
<li><strong>Comece com um processo.</strong> Melhor acertar um do que montar vários pela metade.</li>
<li><strong>Teste com dados reais</strong> e confira os primeiros resultados com a equipe.</li>
<li><strong>Acompanhe.</strong> Registre o que foi executado e revise a regra quando o processo mudar.</li>
</ol>
<h2>Exemplos comuns</h2>
<ul>
<li>Relatórios que chegam sozinhos no e-mail toda semana.</li>
<li>Avisos e lembretes de pagamento ou de prazo.</li>
<li>Atualização de planilhas e sistemas a partir de um novo pedido.</li>
<li>Envio de documentos e confirmações para clientes.</li>
</ul>
<h2>Cuidados importantes</h2>
<p>Não automatize um processo bagunçado: primeiro organize, depois automatize. E mantenha uma pessoa no circuito para as exceções, porque nem tudo cabe em regra. O objetivo é tirar o trabalho repetitivo do caminho da equipe, e não a equipe do processo.</p>', '/assets/img/blog/como-automatizar-processos-repetitivos.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'automacao' LIMIT 1), 'published', 'Como automatizar processos repetitivos sem complicar a rotina', 'Quase toda empresa tem tarefas que alguém repete todo dia ou toda semana: montar o mesmo relatório, enviar avisos, atualizar planilhas, cobrar clientes. Automatizar isso libera ...', '/assets/img/blog/como-automatizar-processos-repetitivos.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('Chatbot no WhatsApp: o que dá para automatizar no atendimento', 'chatbot-no-whatsapp-o-que-automatizar', 'O WhatsApp é onde muitos clientes preferem falar com a empresa. O desafio é responder rápido, a qualquer hora, sem sobrecarregar a equipe. Um chatbot bem planejado ajuda nisso, ...', '<p>O WhatsApp é onde muitos clientes preferem falar com a empresa. O desafio é responder rápido, a qualquer hora, sem sobrecarregar a equipe. Um chatbot bem planejado ajuda nisso, mas funciona melhor quando você sabe o que entregar a ele.</p>
<h2>O que um chatbot resolve bem</h2>
<ul>
<li>Perguntas frequentes, como horário, endereço, formas de pagamento e prazos.</li>
<li>Triagem: entender o que o cliente quer e encaminhar para a pessoa certa.</li>
<li>Qualificação de contatos, coletando as informações básicas antes de passar para vendas.</li>
<li>Consulta de status de pedidos e envio de segunda via de documentos.</li>
<li>Agendamentos e confirmações.</li>
</ul>
<h2>O que deve continuar com uma pessoa</h2>
<ul>
<li>Negociações e propostas mais complexas.</li>
<li>Reclamações delicadas.</li>
<li>Qualquer situação fora do roteiro, em que o cliente precisa ser ouvido.</li>
</ul>
<h2>Boas práticas</h2>
<ol>
<li>Deixe claro que o cliente está falando com um assistente virtual.</li>
<li>Ofereça sempre um caminho para falar com um atendente.</li>
<li>Registre as conversas e conecte o chatbot ao seu CRM, para o contato já chegar organizado.</li>
<li>Comece com poucas perguntas e amplie conforme aprende com as conversas reais.</li>
</ol>
<h2>Como saber se está funcionando</h2>
<p>Acompanhe o tempo de resposta, quantas conversas foram resolvidas sem ajuda humana e quantos contatos qualificados chegaram ao time de vendas. Com esses números, você ajusta o roteiro e decide onde vale investir mais.</p>', '/assets/img/blog/chatbot-no-whatsapp-o-que-automatizar.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'atendimento' LIMIT 1), 'published', 'Chatbot no WhatsApp: o que dá para automatizar no atendimento', 'O WhatsApp é onde muitos clientes preferem falar com a empresa. O desafio é responder rápido, a qualquer hora, sem sobrecarregar a equipe. Um chatbot bem planejado ajuda nisso, ...', '/assets/img/blog/chatbot-no-whatsapp-o-que-automatizar.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);
INSERT INTO `blog_posts` (`title_pt`, `slug`, `excerpt_pt`, `content_pt`, `featured_image`, `author_id`, `category_id`, `status`, `meta_title_pt`, `meta_description_pt`, `og_image`, `published_at`) VALUES ('Quais indicadores o dono da empresa deve acompanhar toda semana', 'indicadores-que-o-dono-deve-acompanhar', 'Ter muitos relatórios não é o mesmo que ter clareza. O dono que decide bem costuma olhar poucos números, sempre os mesmos, com a mesma definição e na mesma frequência.', '<p>Ter muitos relatórios não é o mesmo que ter clareza. O dono que decide bem costuma olhar poucos números, sempre os mesmos, com a mesma definição e na mesma frequência.</p>
<h2>Indicadores que quase toda empresa deveria olhar</h2>
<ul>
<li><strong>Faturamento e meta:</strong> quanto entrou e o quanto falta para chegar ao objetivo do mês.</li>
<li><strong>Margem:</strong> o que sobra depois dos custos de cada produto, serviço ou cliente.</li>
<li><strong>Ticket médio:</strong> o valor médio de cada venda.</li>
<li><strong>Conversão por etapa:</strong> quantos contatos avançam do primeiro contato ao fechamento.</li>
<li><strong>Custo por contato e por venda,</strong> se você investe em marketing.</li>
<li><strong>Prazo médio de entrega ou de atendimento.</strong></li>
<li><strong>Inadimplência:</strong> o quanto do que foi vendido está atrasado.</li>
</ul>
<h2>Como escolher os seus</h2>
<ol>
<li>Pergunte: que decisão esse número me ajuda a tomar? Se nenhuma, descarte.</li>
<li>Limite a lista a cinco a oito indicadores.</li>
<li>Defina a fórmula de cada um e use a mesma em toda a empresa.</li>
<li>Escolha a frequência: semanal para o que muda rápido, mensal para o resto.</li>
</ol>
<h2>De onde vêm os dados</h2>
<p>Normalmente, do ERP, do CRM, da planilha financeira e das ferramentas de marketing. O trabalho de um painel (dashboard) é reunir tudo isso em uma única tela, atualizada sozinha, no computador e no celular.</p>
<h2>Alertas fazem diferença</h2>
<p>Além de mostrar os números, um bom painel avisa quando uma meta foi batida ou quando algo saiu do rumo. Assim você age no meio do mês, e não depois do fechamento.</p>', '/assets/img/blog/indicadores-que-o-dono-deve-acompanhar.jpg', @author_id, (SELECT `id` FROM `blog_categories` WHERE `slug` = 'dados' LIMIT 1), 'published', 'Quais indicadores o dono da empresa deve acompanhar toda semana', 'Ter muitos relatórios não é o mesmo que ter clareza. O dono que decide bem costuma olhar poucos números, sempre os mesmos, com a mesma definição e na mesma frequência.', '/assets/img/blog/indicadores-que-o-dono-deve-acompanhar.jpg', '2026-10-18 09:00:00') ON DUPLICATE KEY UPDATE `title_pt` = VALUES(`title_pt`), `excerpt_pt` = VALUES(`excerpt_pt`), `content_pt` = VALUES(`content_pt`), `featured_image` = VALUES(`featured_image`), `category_id` = VALUES(`category_id`), `status` = VALUES(`status`), `meta_title_pt` = VALUES(`meta_title_pt`), `meta_description_pt` = VALUES(`meta_description_pt`), `og_image` = VALUES(`og_image`), `published_at` = VALUES(`published_at`);

