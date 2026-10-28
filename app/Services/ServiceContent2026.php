<?php
/**
 * Conteúdo das páginas de serviço no tema 2026, portado FIELMENTE da
 * referência (docs/referencia/home-ref.html). Fonte de verdade visual/textual
 * por serviço. A view service-detail-2026 usa isto; quando houver conteúdo real
 * equivalente no banco, ele tem prioridade (ver controller).
 */

namespace App\Services;

class ServiceContent2026
{
    public static function all(): array
    {
        return array (
  'sistemas-web' => 
  array (
    'hero_title' => 'Um sistema feito para <mark>o jeito que a sua empresa trabalha</mark>.',
    'hero_sub' => 'Chega de adaptar a rotina a um software de prateleira. A gente desenvolve a ferramenta certa para a sua operação.',
    'seg_with' => 'Com sistema sob medida',
    'before' => 
    array (
      0 => 'Planilhas e sistemas que não se encaixam no seu processo',
      1 => 'Cada setor usando uma ferramenta diferente',
      2 => 'Informação que depende de uma pessoa específica',
      3 => 'Adaptações improvisadas que quebram toda hora',
    ),
    'after' => 
    array (
      0 => 'Um sistema desenhado a partir da sua rotina',
      1 => 'Todo mundo trabalhando no mesmo lugar',
      2 => 'Informação acessível, com controle de quem vê o quê',
      3 => 'Evolui junto com a empresa, sem gambiarra',
    ),
    'pains' => 
    array (
      0 => 'Nenhum sistema pronto serve para mim.',
      1 => 'Pago por funções que eu nem uso.',
      2 => 'Preciso de algo que cresça com a empresa.',
      3 => 'Meus dados estão espalhados em vários lugares.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Feito sob medida',
        'd' => 'Desenhado a partir do seu processo real, não de um modelo pronto.',
      ),
      1 => 
      array (
        't' => 'Controle de acesso',
        'd' => 'Cada pessoa vê só o que precisa, com permissões.',
      ),
      2 => 
      array (
        't' => 'Relatórios na hora',
        'd' => 'Dados dinâmicos que você consulta e exporta quando quiser.',
      ),
      3 => 
      array (
        't' => 'Conectado ao que você usa',
        'd' => 'Integra com os sistemas e ferramentas que já existem.',
      ),
      4 => 
      array (
        't' => 'Seguro e com backup',
        'd' => 'Dados protegidos e cópia de segurança automática.',
      ),
      5 => 
      array (
        't' => 'Suporte depois da entrega',
        'd' => 'A gente segue junto, com documentação completa.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Funciona no celular?',
        'a' => 'Sim. O sistema se adapta a computador, tablet e celular.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'erp-personalizado',
      1 => 'integracoes-apis',
      2 => 'aplicativos-mobile',
    ),
    'final_title' => 'Pronto para falar sobre Sistemas Web?',
  ),
  'erp-personalizado' => 
  array (
    'hero_title' => 'Toda a empresa <mark>em um só sistema</mark>, funcionando em sintonia.',
    'hero_sub' => 'Financeiro, estoque, compras, vendas e equipe conectados. Uma venda feita já atualiza o resto sozinha.',
    'seg_with' => 'Com ERP',
    'before' => 
    array (
      0 => 'Financeiro em uma planilha, estoque em outra',
      1 => 'Fechamento do mês que vira maratona',
      2 => 'Cada setor com um número diferente',
      3 => 'Decisões tomadas no achismo',
    ),
    'after' => 
    array (
      0 => 'Tudo integrado, em tempo real',
      1 => 'Uma venda atualiza estoque e financeiro',
      2 => 'Uma única versão dos números',
      3 => 'Relatórios gerenciais sem esforço',
    ),
    'pains' => 
    array (
      0 => 'Meus setores não conversam entre si.',
      1 => 'Fecho o mês no sufoco.',
      2 => 'Não sei qual é o meu lucro de verdade.',
      3 => 'O ERP pronto me obriga a mudar meu processo.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Financeiro completo',
        'd' => 'Contas, fluxo de caixa e fechamento sob controle.',
      ),
      1 => 
      array (
        't' => 'Estoque e compras',
        'd' => 'Saiba o que tem, o que falta e o que comprar.',
      ),
      2 => 
      array (
        't' => 'Vendas e pedidos',
        'd' => 'Do pedido à entrega, tudo registrado no mesmo lugar.',
      ),
      3 => 
      array (
        't' => 'Notas fiscais',
        'd' => 'Emissão e integração com a SEFAZ.',
      ),
      4 => 
      array (
        't' => 'Aprovações do seu jeito',
        'd' => 'Regras e avisos que seguem o seu processo.',
      ),
      5 => 
      array (
        't' => 'Várias empresas e filiais',
        'd' => 'Gerencie tudo em um só sistema.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Vocês trocam o sistema que eu já uso?',
        'a' => 'Nem sempre. Dá para integrar o que você já tem e criar só o que falta.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'crm',
      1 => 'dashboards-bi',
      2 => 'integracoes-apis',
    ),
    'final_title' => 'Pronto para falar sobre ERP Personalizado?',
  ),
  'crm' => 
  array (
    'hero_title' => 'Cada cliente e cada orçamento <mark>sob controle</mark>, do primeiro contato ao fechamento.',
    'hero_sub' => 'Centralize contatos, conversas e propostas em um só lugar e nunca mais perca uma venda por falta de acompanhamento.',
    'seg_with' => 'Com CRM',
    'before' => 
    array (
      0 => 'Orçamentos perdidos no meio do WhatsApp',
      1 => 'Ninguém sabe quem já foi respondido',
      2 => 'Retorno depende da memória de cada um',
      3 => 'Não dá para saber de onde veio a venda',
    ),
    'after' => 
    array (
      0 => 'Contatos e propostas em um só lugar',
      1 => 'Cada negociação com etapa e próximo passo',
      2 => 'Lembretes automáticos de retorno',
      3 => 'Relatórios do que realmente converte',
    ),
    'pains' => 
    array (
      0 => 'Perco orçamento no WhatsApp.',
      1 => 'Não sei em que etapa está cada cliente.',
      2 => 'Minha equipe esquece de dar retorno.',
      3 => 'Não sei quanto vendo por canal.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Funil de vendas visual',
        'd' => 'Veja cada negociação em sua etapa, do contato ao fechamento.',
      ),
      1 => 
      array (
        't' => 'Histórico de cada cliente',
        'd' => 'Conversas, propostas e contatos reunidos.',
      ),
      2 => 
      array (
        't' => 'Retorno automático',
        'd' => 'Lembretes e e-mails para ninguém ficar sem resposta.',
      ),
      3 => 
      array (
        't' => 'Propostas e orçamentos',
        'd' => 'Gere e acompanhe tudo sem sair do sistema.',
      ),
      4 => 
      array (
        't' => 'WhatsApp e e-mail',
        'd' => 'Conectado aos canais que sua equipe já usa.',
      ),
      5 => 
      array (
        't' => 'Relatórios em tempo real',
        'd' => 'Conversão, ticket médio e desempenho da equipe.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Serve para o meu tipo de venda?',
        'a' => 'Sim. O CRM é desenhado a partir do seu processo, sem funções que você não usa.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'chatbots',
      1 => 'automacoes',
      2 => 'dashboards-bi',
    ),
    'final_title' => 'Pronto para falar sobre CRM?',
  ),
  'integracoes-apis' => 
  array (
    'hero_title' => 'Seus sistemas conversando entre si, <mark>sem ninguém digitar duas vezes</mark>.',
    'hero_sub' => 'Conectamos ERP, loja, WhatsApp, banco e o que mais você usa para a informação fluir sozinha.',
    'seg_with' => 'Com integração',
    'before' => 
    array (
      0 => 'Copiar dados de um sistema para outro',
      1 => 'Erros de digitação que custam caro',
      2 => 'Ferramentas que não se falam',
      3 => 'Informação sempre desatualizada',
    ),
    'after' => 
    array (
      0 => 'Dado digitado uma vez, usado em todo lugar',
      1 => 'Informação atualizada em tempo real',
      2 => 'Menos erro e menos retrabalho',
      3 => 'Ferramentas funcionando em sincronia',
    ),
    'pains' => 
    array (
      0 => 'Minha equipe digita tudo duas vezes.',
      1 => 'Meu ERP não conversa com a loja.',
      2 => 'Preciso ligar pagamentos e WhatsApp ao meu sistema.',
      3 => 'Os dados nunca batem entre os sistemas.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'WhatsApp Business',
        'd' => 'Seu sistema falando com o canal que seu cliente usa.',
      ),
      1 => 
      array (
        't' => 'Pagamentos e Pix',
        'd' => 'Cobrança integrada aos principais meios de pagamento.',
      ),
      2 => 
      array (
        't' => 'Lojas e marketplaces',
        'd' => 'Pedidos e estoque sincronizados entre canais.',
      ),
      3 => 
      array (
        't' => 'Sincronização entre sistemas',
        'd' => 'Os dados certos no lugar certo, sozinhos.',
      ),
      4 => 
      array (
        't' => 'Atualização em tempo real',
        'd' => 'Mudou em um lugar, mudou em todos.',
      ),
      5 => 
      array (
        't' => 'Acompanhamento de falhas',
        'd' => 'Registramos e monitoramos para nada se perder.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Preciso trocar meus sistemas?',
        'a' => 'Não. A ideia é conectar o que você já usa.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'automacoes',
      1 => 'erp-personalizado',
      2 => 'sistemas-web',
    ),
    'final_title' => 'Pronto para falar sobre Integrações & APIs?',
  ),
  'automacoes' => 
  array (
    'hero_title' => 'Tarefas repetitivas <mark>acontecendo sozinhas</mark>, enquanto a sua equipe foca no que importa.',
    'hero_sub' => 'Relatórios, e-mails, avisos e cobranças no piloto automático, sem esquecimento e sem erro.',
    'seg_with' => 'Com automações',
    'before' => 
    array (
      0 => 'Relatórios montados à mão toda semana',
      1 => 'E-mails e avisos enviados manualmente',
      2 => 'Planilhas atualizadas uma a uma',
      3 => 'Equipe sobrecarregada com tarefa repetitiva',
    ),
    'after' => 
    array (
      0 => 'Relatórios gerados sozinhos',
      1 => 'Mensagens disparadas na hora certa',
      2 => 'Dados atualizados automaticamente',
      3 => 'Equipe livre para o que gera resultado',
    ),
    'pains' => 
    array (
      0 => 'Minha equipe perde horas com tarefa repetitiva.',
      1 => 'Sempre alguém esquece de enviar alguma coisa.',
      2 => 'Gero o mesmo relatório toda semana.',
      3 => 'Erro de digitação me custa dinheiro.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'E-mails e avisos automáticos',
        'd' => 'Mensagens certas, para as pessoas certas, na hora certa.',
      ),
      1 => 
      array (
        't' => 'Relatórios automáticos',
        'd' => 'Prontos no seu e-mail, em PDF ou Excel.',
      ),
      2 => 
      array (
        't' => 'Ação quando algo acontece',
        'd' => 'Chegou um pedido? O resto acontece sozinho.',
      ),
      3 => 
      array (
        't' => 'Tarefas agendadas',
        'd' => 'Rotinas que rodam todo dia, toda semana ou todo mês.',
      ),
      4 => 
      array (
        't' => 'Conectado ao que você usa',
        'd' => 'Funciona com as ferramentas que já existem.',
      ),
      5 => 
      array (
        't' => 'Registro de tudo',
        'd' => 'Você sabe o que foi executado e quando.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Dá para automatizar qualquer processo?',
        'a' => 'Quase todo processo repetitivo e baseado em regras. Na conversa avaliamos o que vale automatizar primeiro.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'integracoes-apis',
      1 => 'chatbots',
      2 => 'crm',
    ),
    'final_title' => 'Pronto para falar sobre Automações?',
  ),
  'dashboards-bi' => 
  array (
    'hero_title' => 'Os números da sua empresa na tela, <mark>em tempo real</mark>, sem esperar o fim do mês.',
    'hero_sub' => 'Painéis claros no computador e no celular para você decidir com dados, e não com palpite.',
    'seg_with' => 'Com painéis',
    'before' => 
    array (
      0 => 'Relatórios que chegam atrasados',
      1 => 'Um número diferente em cada planilha',
      2 => 'Não saber o que acontece hoje',
      3 => 'Decisões tomadas por intuição',
    ),
    'after' => 
    array (
      0 => 'Indicadores atualizados na hora',
      1 => 'Uma única fonte de números',
      2 => 'Alerta quando uma meta é batida ou foge do rumo',
      3 => 'Decisões rápidas e seguras',
    ),
    'pains' => 
    array (
      0 => 'Só sei meus números depois do fechamento.',
      1 => 'Cada área me traz um número diferente.',
      2 => 'Não consigo ver tudo em um só lugar.',
      3 => 'Quero saber logo quando algo sai do rumo.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Painéis em tempo real',
        'd' => 'O que está acontecendo no seu negócio, agora.',
      ),
      1 => 
      array (
        't' => 'Indicadores do seu jeito',
        'd' => 'Os números que importam para a sua empresa.',
      ),
      2 => 
      array (
        't' => 'Gráficos que você explora',
        'd' => 'Clique e descubra o detalhe por trás do número.',
      ),
      3 => 
      array (
        't' => 'Alertas de metas',
        'd' => 'Aviso quando algo precisa da sua atenção.',
      ),
      4 => 
      array (
        't' => 'Relatórios automáticos',
        'd' => 'Prontos em PDF ou Excel, sem montar nada.',
      ),
      5 => 
      array (
        't' => 'Funciona no celular',
        'd' => 'Acompanhe de onde estiver.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Meus dados estão em vários sistemas. Dá certo?',
        'a' => 'Sim. Reunimos dados de várias fontes em um só painel.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'erp-personalizado',
      1 => 'machine-learning',
      2 => 'inteligencia-artificial',
    ),
    'final_title' => 'Pronto para falar sobre Dashboards & BI?',
  ),
  'aplicativos-mobile' => 
  array (
    'hero_title' => 'O seu negócio <mark>no celular</mark> dos seus clientes e da sua equipe.',
    'hero_sub' => 'Aplicativos para iPhone e Android, bonitos, rápidos e conectados à sua operação.',
    'seg_with' => 'Com o app',
    'before' => 
    array (
      0 => 'Cliente precisa ligar ou mandar mensagem',
      1 => 'Equipe de campo anotando no papel',
      2 => 'Processo que só funciona no computador',
      3 => 'Sem canal direto com o cliente',
    ),
    'after' => 
    array (
      0 => 'Cliente resolve tudo pelo app',
      1 => 'Equipe registrando na hora, pelo celular',
      2 => 'Operação acessível de qualquer lugar',
      3 => 'Avisos direto na tela do cliente',
    ),
    'pains' => 
    array (
      0 => 'Meu cliente quer resolver tudo pelo celular.',
      1 => 'Minha equipe de rua trabalha no papel.',
      2 => 'Quero um app, mas não sei por onde começar.',
      3 => 'Preciso de algo que funcione até sem internet.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'iPhone e Android',
        'd' => 'Seu app nas duas plataformas.',
      ),
      1 => 
      array (
        't' => 'Avisos para o cliente',
        'd' => 'Notificações direto na tela do celular.',
      ),
      2 => 
      array (
        't' => 'Funciona sem internet',
        'd' => 'A equipe segue trabalhando e tudo sincroniza depois.',
      ),
      3 => 
      array (
        't' => 'Pagamento no app',
        'd' => 'Seu cliente compra ou paga sem sair dele.',
      ),
      4 => 
      array (
        't' => 'Localização e mapas',
        'd' => 'Rotas, entregas e equipe de campo.',
      ),
      5 => 
      array (
        't' => 'Publicação nas lojas',
        'd' => 'Cuidamos de colocar seu app na App Store e no Google Play.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Preciso de um app para iPhone e outro para Android?',
        'a' => 'Não necessariamente. Quando faz sentido, entregamos os dois a partir de uma única base.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'sistemas-web',
      1 => 'saas',
      2 => 'integracoes-apis',
    ),
    'final_title' => 'Pronto para falar sobre Aplicativos Mobile?',
  ),
  'saas' => 
  array (
    'hero_title' => 'Transforme sua ideia em um <mark>produto digital</mark> vendido por assinatura.',
    'hero_sub' => 'Do primeiro protótipo à plataforma com milhares de usuários, a gente constrói junto com você.',
    'seg_with' => 'Com o produto',
    'before' => 
    array (
      0 => 'Ideia boa, mas sem saber por onde começar',
      1 => 'Medo de gastar muito antes de validar',
      2 => 'Cobrança e cadastro de clientes na mão',
      3 => 'Sistema que não aguenta crescer',
    ),
    'after' => 
    array (
      0 => 'Primeira versão enxuta para validar a ideia',
      1 => 'Cobrança por assinatura automática',
      2 => 'Cada cliente com seus dados protegidos',
      3 => 'Plataforma preparada para crescer',
    ),
    'pains' => 
    array (
      0 => 'Tenho uma ideia de produto digital.',
      1 => 'Quero validar antes de investir pesado.',
      2 => 'Preciso cobrar por assinatura.',
      3 => 'Quero vender para várias empresas na mesma plataforma.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Primeira versão rápida',
        'd' => 'Um MVP para testar com clientes reais.',
      ),
      1 => 
      array (
        't' => 'Cobrança e assinaturas',
        'd' => 'Planos, testes grátis e mudanças de plano.',
      ),
      2 => 
      array (
        't' => 'Dados separados por cliente',
        'd' => 'Cada empresa vê só o que é dela.',
      ),
      3 => 
      array (
        't' => 'Painel para o seu cliente',
        'd' => 'Ele mesmo gerencia a conta, sem chamar você.',
      ),
      4 => 
      array (
        't' => 'Métricas do produto',
        'd' => 'Receita, cancelamentos e crescimento à vista.',
      ),
      5 => 
      array (
        't' => 'Sua marca',
        'd' => 'Versão com a identidade da sua empresa.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'O que é um MVP?',
        'a' => 'É a primeira versão enxuta do produto, para testar com clientes reais antes de investir no resto.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'aplicativos-mobile',
      1 => 'sistemas-web',
      2 => 'infraestrutura',
    ),
    'final_title' => 'Pronto para falar sobre SaaS?',
  ),
  'inteligencia-artificial' => 
  array (
    'hero_title' => 'Inteligência artificial aplicada para resolver <mark>problemas reais</mark> do seu negócio.',
    'hero_sub' => 'Sem modismo: cada solução de IA nasce de um problema específico, com meta clara de resultado.',
    'seg_with' => 'Com IA',
    'before' => 
    array (
      0 => 'Atendimento limitado ao horário comercial',
      1 => 'Documentos digitados à mão',
      2 => 'Análises demoradas e manuais',
      3 => 'Oportunidades que passam despercebidas',
    ),
    'after' => 
    array (
      0 => 'Atendimento rápido a qualquer hora',
      1 => 'Documentos lidos e organizados sozinhos',
      2 => 'Análises e previsões na hora',
      3 => 'Clientes e vendas priorizados por dados',
    ),
    'pains' => 
    array (
      0 => 'Quero atender mais sem contratar mais.',
      1 => 'Perco tempo lendo e digitando documentos.',
      2 => 'Não sei quais clientes vão cancelar.',
      3 => 'Todo mundo fala de IA, mas não sei por onde começar.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Assistentes virtuais',
        'd' => 'Atendimento e vendas com conversa natural.',
      ),
      1 => 
      array (
        't' => 'Previsão de vendas e cancelamentos',
        'd' => 'Saiba antes o que tende a acontecer.',
      ),
      2 => 
      array (
        't' => 'Leitura de documentos',
        'd' => 'A IA extrai os dados e você não digita.',
      ),
      3 => 
      array (
        't' => 'Opinião dos clientes',
        'd' => 'Entenda o que dizem sobre você, em escala.',
      ),
      4 => 
      array (
        't' => 'Recomendações personalizadas',
        'd' => 'A oferta certa para cada cliente.',
      ),
      5 => 
      array (
        't' => 'Treinada com os seus dados',
        'd' => 'Respostas alinhadas à sua empresa.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'A IA pode errar ou inventar respostas?',
        'a' => 'Desenhamos com limites claros, treinamos com os dados da sua empresa e acompanhamos a qualidade das respostas.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'chatbots',
      1 => 'machine-learning',
      2 => 'automacoes',
    ),
    'final_title' => 'Pronto para falar sobre Inteligência Artificial?',
  ),
  'chatbots' => 
  array (
    'hero_title' => 'Atendimento e vendas funcionando <mark>24 horas</mark>, no WhatsApp e onde seu cliente estiver.',
    'hero_sub' => 'Assistentes virtuais que entendem o cliente, respondem na hora e chamam uma pessoa quando precisa.',
    'seg_with' => 'Com chatbot',
    'before' => 
    array (
      0 => 'Cliente esperando horas por resposta',
      1 => 'A mesma pergunta respondida mil vezes',
      2 => 'Contatos esfriando fora do horário',
      3 => 'Equipe sobrecarregada no atendimento',
    ),
    'after' => 
    array (
      0 => 'Resposta na hora, a qualquer horário',
      1 => 'Perguntas comuns resolvidas sozinhas',
      2 => 'Contatos qualificados e enviados ao CRM',
      3 => 'Equipe focada nos casos que importam',
    ),
    'pains' => 
    array (
      0 => 'Perco cliente por demorar a responder.',
      1 => 'Meu time vive no WhatsApp respondendo o mesmo.',
      2 => 'Fora do horário, ninguém atende.',
      3 => 'Quero qualificar o contato antes de passar para vendas.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Atendimento 24 horas',
        'd' => 'Seu cliente é atendido a qualquer momento.',
      ),
      1 => 
      array (
        't' => 'WhatsApp, site e Instagram',
        'd' => 'O mesmo assistente em todos os canais.',
      ),
      2 => 
      array (
        't' => 'Qualifica contatos',
        'd' => 'Só chega para vendas quem tem interesse real.',
      ),
      3 => 
      array (
        't' => 'Passa para uma pessoa',
        'd' => 'Quando o caso pede, um atendente assume.',
      ),
      4 => 
      array (
        't' => 'Histórico de conversas',
        'd' => 'Tudo registrado para consulta e melhoria.',
      ),
      5 => 
      array (
        't' => 'Conectado ao CRM',
        'd' => 'Cada contato já entra organizado.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'O cliente vai achar ruim falar com um robô?',
        'a' => 'Você decide como o assistente se apresenta. Quando o caso pede, ele passa a conversa para uma pessoa da sua equipe.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'crm',
      1 => 'inteligencia-artificial',
      2 => 'automacoes',
    ),
    'final_title' => 'Pronto para falar sobre Chatbots?',
  ),
  'machine-learning' => 
  array (
    'hero_title' => 'Previsões baseadas nos seus dados para <mark>decidir antes</mark> de o problema aparecer.',
    'hero_sub' => 'Seus dados guardam padrões que ninguém vê a olho nu. A gente transforma isso em decisão.',
    'seg_with' => 'Com previsões',
    'before' => 
    array (
      0 => 'Estoque que sobra ou falta',
      1 => 'Clientes que cancelam sem aviso',
      2 => 'Preço definido no chute',
      3 => 'Fraudes e erros descobertos tarde',
    ),
    'after' => 
    array (
      0 => 'Previsão de demanda e de vendas',
      1 => 'Aviso de clientes com risco de sair',
      2 => 'Preço com base em dados',
      3 => 'Anomalias detectadas rapidamente',
    ),
    'pains' => 
    array (
      0 => 'Não sei quanto vou vender no mês que vem.',
      1 => 'Perco clientes e só descubro depois.',
      2 => 'Compro estoque no escuro.',
      3 => 'Quero oferecer o produto certo para cada cliente.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Previsão de vendas e demanda',
        'd' => 'Planeje compras e metas com mais segurança.',
      ),
      1 => 
      array (
        't' => 'Clientes em risco',
        'd' => 'Saiba quem tende a cancelar e aja antes.',
      ),
      2 => 
      array (
        't' => 'Fraudes e anomalias',
        'd' => 'Comportamentos fora do padrão aparecem rápido.',
      ),
      3 => 
      array (
        't' => 'Recomendação de produtos',
        'd' => 'A oferta certa para cada perfil.',
      ),
      4 => 
      array (
        't' => 'Grupos de clientes',
        'd' => 'Entenda quem são e como cada grupo compra.',
      ),
      5 => 
      array (
        't' => 'Sempre atualizado',
        'd' => 'O modelo aprende com os dados novos.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Preciso ter muitos dados?',
        'a' => 'Precisamos de histórico para começar. Na conversa avaliamos se o que você tem já é suficiente.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'inteligencia-artificial',
      1 => 'dashboards-bi',
      2 => 'automacoes',
    ),
    'final_title' => 'Pronto para falar sobre Machine Learning?',
  ),
  'consultoria' => 
  array (
    'hero_title' => 'Um olhar especializado para <mark>destravar sua operação</mark> e mostrar o melhor caminho.',
    'hero_sub' => 'Nem sempre a solução é construir algo novo. Às vezes é entender onde está o gargalo.',
    'seg_with' => 'Com consultoria',
    'before' => 
    array (
      0 => 'A sensação de que algo trava, sem saber o quê',
      1 => 'Processos que ninguém documentou',
      2 => 'Tecnologia escolhida sem critério',
      3 => 'Projetos que começam sem plano claro',
    ),
    'after' => 
    array (
      0 => 'Diagnóstico claro dos gargalos',
      1 => 'Mapa dos processos atuais e ideais',
      2 => 'Plano priorizado, com etapas e retorno estimado',
      3 => 'Decisão de tecnologia com segurança',
    ),
    'pains' => 
    array (
      0 => 'Sei que algo trava, mas não sei onde.',
      1 => 'Não sei se preciso de um sistema novo.',
      2 => 'Quero crescer sem bagunçar a operação.',
      3 => 'Já gastei com tecnologia que não resolveu.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Diagnóstico completo',
        'd' => 'Olhamos sistemas, processos e infraestrutura atuais.',
      ),
      1 => 
      array (
        't' => 'Mapa dos processos',
        'd' => 'Como é hoje e como poderia ser.',
      ),
      2 => 
      array (
        't' => 'Plano de transformação',
        'd' => 'Etapas priorizadas, com marcos e retorno estimado.',
      ),
      3 => 
      array (
        't' => 'Escolha das tecnologias',
        'd' => 'A ferramenta certa, sem modismo.',
      ),
      4 => 
      array (
        't' => 'Análise de viabilidade',
        'd' => 'Saiba se a ideia se sustenta antes de investir.',
      ),
      5 => 
      array (
        't' => 'Mentoria para a equipe',
        'd' => 'Seu time aprende junto e ganha autonomia.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'A consultoria é obrigatória antes de um projeto?',
        'a' => 'Não. Mas quando o cenário não está claro, ela evita gastar com a solução errada.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'sistemas-web',
      1 => 'erp-personalizado',
      2 => 'dashboards-bi',
    ),
    'final_title' => 'Pronto para falar sobre Consultoria?',
  ),
  'performance' => 
  array (
    'hero_title' => 'Um sistema rápido que <mark>aguenta o crescimento</mark> da sua empresa.',
    'hero_sub' => 'Sistema lento custa clientes, produtividade e reputação. A gente acelera e prepara para os picos.',
    'seg_with' => 'Com performance',
    'before' => 
    array (
      0 => 'Sistema lento que trava a equipe',
      1 => 'Site que cai em dia de muito acesso',
      2 => 'Cliente desistindo por demora',
      3 => 'Cada novo usuário piora tudo',
    ),
    'after' => 
    array (
      0 => 'Telas carregando rápido',
      1 => 'Aguenta os picos de acesso',
      2 => 'Cliente satisfeito e menos desistência',
      3 => 'Preparado para crescer sem trocar tudo',
    ),
    'pains' => 
    array (
      0 => 'Meu sistema vive lento.',
      1 => 'Cai quando tem muito acesso.',
      2 => 'Perco venda porque o site demora.',
      3 => 'Tenho medo de crescer e o sistema não aguentar.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Auditoria de desempenho',
        'd' => 'Descobrimos exatamente onde está a lentidão.',
      ),
      1 => 
      array (
        't' => 'Banco de dados mais ágil',
        'd' => 'Consultas lentas corrigidas na origem.',
      ),
      2 => 
      array (
        't' => 'Entrega acelerada',
        'd' => 'Páginas e arquivos chegando mais rápido ao cliente.',
      ),
      3 => 
      array (
        't' => 'Preparado para picos',
        'd' => 'O sistema se ajusta quando o acesso aumenta.',
      ),
      4 => 
      array (
        't' => 'Monitoramento contínuo',
        'd' => 'Você sabe antes de o cliente reclamar.',
      ),
      5 => 
      array (
        't' => 'Teste antes do pico',
        'd' => 'Simulamos a carga para evitar surpresa.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Dá para melhorar sem refazer o sistema?',
        'a' => 'Muitas vezes sim. A auditoria mostra se basta ajustar ou se vale reconstruir alguma parte.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'infraestrutura',
      1 => 'sistemas-web',
      2 => 'consultoria',
    ),
    'final_title' => 'Pronto para falar sobre Performance?',
  ),
  'infraestrutura' => 
  array (
    'hero_title' => 'Seu sistema <mark>sempre no ar</mark>, seguro e preparado para crescer.',
    'hero_sub' => 'Cuidamos de servidores, backup e segurança para você focar no negócio, e não na tecnologia.',
    'seg_with' => 'Com infraestrutura',
    'before' => 
    array (
      0 => 'Sistema fora do ar sem aviso',
      1 => 'Medo de perder dados',
      2 => 'Servidor caro e mal aproveitado',
      3 => 'Atualizações que viram risco',
    ),
    'after' => 
    array (
      0 => 'Sistema disponível e monitorado 24h',
      1 => 'Backup e plano de recuperação',
      2 => 'Custo de nuvem sob controle',
      3 => 'Atualizações automáticas e seguras',
    ),
    'pains' => 
    array (
      0 => 'Já perdi dados e não quero repetir.',
      1 => 'Meu sistema cai e só descubro pelo cliente.',
      2 => 'Minha conta de nuvem só sobe.',
      3 => 'Não tenho ninguém de TI para cuidar disso.',
    ),
    'bens' => 
    array (
      0 => 
      array (
        't' => 'Monitoramento 24 horas',
        'd' => 'Alerta na hora se algo sair do normal.',
      ),
      1 => 
      array (
        't' => 'Backup e recuperação',
        'd' => 'Seus dados protegidos e restauráveis.',
      ),
      2 => 
      array (
        't' => 'Migração para a nuvem',
        'd' => 'Mudança planejada, sem parar a operação.',
      ),
      3 => 
      array (
        't' => 'Custo de nuvem sob controle',
        'd' => 'Pagar só pelo que realmente usa.',
      ),
      4 => 
      array (
        't' => 'Conexão segura',
        'd' => 'Certificados e proteção do tráfego.',
      ),
      5 => 
      array (
        't' => 'Ambientes organizados',
        'd' => 'Teste e produção separados, sem risco.',
      ),
    ),
    'faqs' => 
    array (
      0 => 
      array (
        'q' => 'Quanto custa?',
        'a' => 'Depende do que a sua empresa precisa. Na conversa gratuita entendemos o seu cenário e você recebe uma proposta com escopo, prazo e valor antes de decidir.',
      ),
      1 => 
      array (
        'q' => 'Preciso migrar tudo para a nuvem?',
        'a' => 'Não necessariamente. Avaliamos o que faz sentido para a sua operação e para o seu custo.',
      ),
      2 => 
      array (
        'q' => 'Minha equipe vai conseguir usar?',
        'a' => 'A solução é desenhada em cima da rotina que sua equipe já tem, e não o contrário. Treinamos o time e acompanhamos o início de uso até todo mundo estar seguro.',
      ),
    ),
    'related' => 
    array (
      0 => 'performance',
      1 => 'sistemas-web',
      2 => 'consultoria',
    ),
    'final_title' => 'Pronto para falar sobre Infraestrutura?',
  ),
);
    }

    public static function get(string $slug): ?array
    {
        return self::all()[$slug] ?? null;
    }
}
