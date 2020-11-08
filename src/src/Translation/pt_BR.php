<?php
declare(strict_types=1);

return [
    'general' => [
        'cancel' => 'Cancelar',
        'confirm' => 'Confirmar',
        'dismiss' => 'Fechar',
        'confirm_heading' => 'Tem certeza?',
        'confirm_message' => 'Ao clicar em confirmar todos os dados não salvos serão perdidos.',
        'delete_heading' => 'Tem certeza?',
        'delete_message' => 'Ao clicar em confirmar o registro será apagado. Lembre-se que essa ação não poderá ser desfeita.',
        'no_data_found' => 'Nenhum dado encontrado.',
        'errors' => [
            'required_fields' => 'Preencha todos os campos obrigatórios.',
            'invalid_data' => 'Os dados informados são inválidos.',
            'database_error' => 'Ocorreu um erro desconhecido',
            'success' => 'Registro salvo com sucesso!',
            'delete_success' => 'Registro removido com sucesso!'
        ]
    ],
    'sidebar' => [
        'dashboard' => 'Início',
        'collapse_heading' => 'Selecione uma opção',
        'heading_1' => 'Conteúdo',
        'heading_2' => 'Basilares',

        'items' => [
            'landing_page' => 'Landing pages',
            'pixels' => 'Pixels',
            'pixel_types' => 'Categorias'
        ]
    ],
    'topbar' => [ 
        'settings' => 'Configurações',
        'logout' => 'Sair',
        'logout_heading' => 'Sair do sistema',
        'logout_message' => 'Clique em "Sair" abaixo quando você estiver pronto para finalizar sua sessão.'
    ],
    'pages' => [
        'login' => [
            'greeting_text' => 'Bem-vindo(a) novamente!',
            'form' => [
                'email_placeholder' => 'Digite seu e-mail...',
                'password_placeholder' => 'Senha',
                'button_text' => 'Entrar',
                'forgot_password' => 'Esqueceu sua senha?',
                'create_account' => 'Crie uma conta!'
            ],
            'errors' => [
                'required_fields' => 'Preencha todos os campos obrigatórios.',
                'invalid_email' => 'E-mail inválido.',
                'user_not_found' => 'E-mail ou senha incorretos. Tente novamente.',
                'not_authenticated' => 'Você deve estar autenticado para ver isso.',
                'user_not_found' => 'Usuário não encontrado.',
                'logout_success' => 'Você foi desconectado do sistema.'
            ]
        ],
        'pixel_type' => [
            'heading' => 'Categorias de Pixel',
            'form' => [
                'buttons' => [
                    'add_new' => 'Adicionar novo',
                    'edit' => 'Alterar',
                    'delete' => 'Excluir'
                ],
                'headings' => [
                    'header_list' => 'Listagem de Categorias de Pixel',
                    'header_add' => 'Adicionar Categorias de Pixel',
                    'header_edit' => 'Editar Categorias de Pixel',
                    'id' => '#',
                    'slug' => 'Código',
                    'title' => 'Título',
                    'is_active' => 'Status',
                    'actions' => 'Ações'
                ],
                'placeholder' => [
                    'title' => 'Digite um título',
                    'is_active' => 'Selecione uma opção'
                ],
                'values' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo'
                ]
            ],
            'errors' => [
                'required_fields' => 'Preencha todos os campos obrigatórios.',
                'invalid_data' => 'Os dados informados são inválidos.',
                'database_error' => 'Ocorreu um erro desconhecido.',
                'success' => 'Registro salvo com sucesso!',
                'delete_success' => 'Registro removido com sucesso!'
            ]
        ],
        'pixel' => [
            'heading' => 'Pixels',
            'form' => [
                'buttons' => [
                    'add_new' => 'Adicionar novo',
                    'edit' => 'Alterar',
                    'delete' => 'Excluir'
                ],
                'headings' => [
                    'header_list' => 'Listagem de Pixels',
                    'header_add' => 'Adicionar Pixel',
                    'header_edit' => 'Editar Pixel',
                    'id' => '#',
                    'pixel_type_id' => 'Categoria',
                    'title' => 'Título',
                    'value' => 'Valor',
                    'is_active' => 'Status',
                    'actions' => 'Ações'
                ],
                'values' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo'
                ],
                'placeholder' => [
                    'pixel_type_id' => 'Selecione uma opção',
                    'title' => 'Digite um título',
                    'value' => 'Digite um valor',
                    'is_active' => 'Selecione uma opção'
                ],
            ]

        ],
        'landing_page' => [
            'heading' => 'Landing Pages',
            'form' => [
                'buttons' => [
                    'add_new' => 'Adicionar novo',
                    'edit' => 'Alterar',
                    'delete' => 'Excluir'
                ],
                'headings' => [
                    'header_list' => 'Listagem de Landing Pages',
                    'header_add' => 'Adicionar Landing Page',
                    'header_edit' => 'Editar Landing Page',
                    'header_pixels' => 'Pixels associados',
                    'header_sections' => 'Seções associadas',
                    'id' => '#',
                    'slug' => 'Código',
                    'title' => 'Título',
                    'description' => 'Descrição',
                    'pixels' => 'Qtd. Pixels',
                    'sections' => 'Qtd. Seções',
                    'is_active' => 'Status',
                    'actions' => 'Ações'
                ],
                'values' => [
                    'active' => 'Ativo', 
                    'inactive' => 'Inativo'
                ],
                'placeholder' => [
                    'slug' => 'Digite um código de identificação',
                    'title' => 'Digite um título',
                    'description' => 'Digite uma descrição',
                    'is_active' => 'Selecione uma opção',
                    'pixels_save_before' => 'Salve para associar um pixel',
                    'pixels_no_data' => 'Nenhum pixel associado',
                    'sections_save_before' => 'Salve para associar uma seção',
                    'sections_no_data' => 'Nenhuma seção associada'
                ],
                'errors' => [
                    'slug_in_use' => 'O código informado está em uso. Por favor escolha outro e tente novamente.'
                ],
                'modal' => [
                    'add_pixel_heading' => 'Associar novo pixel'
                ]
            ]
        ],
        'landing_page_section' => [
            'heading' => 'Seções de Landing Pages',
            'form' => [
                'buttons' => [
                    'add_new' => 'Adicionar novo',
                    'edit' => 'Alterar',
                    'delete' => 'Excluir'
                ],
                'headings' => [
                    'header_add' => 'Adicionar Seção',
                    'header_edit' => 'Editar Seção',
                    'header_contents' => 'Conteúdos',
                    'landing_page_id' => 'Landing Page',
                    'title' => 'Título',
                    'template_name' => 'Template',
                    'order' => 'Posição',
                    'is_active' => 'Status',
                    'actions' => 'Ações'
                ],
                'values' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo'
                ],
                'placeholder' => [
                    'title' => 'Digite um título',
                    'template_name' => 'Digite um nome de template',
                    'order' => 'Selecione uma posição',
                    'is_active' => 'Selecione uma opção',
                    'contents_save_before' => 'Salve para adicionar um conteúdo',
                    'contents_no_data' => 'Nenhum conteúdo adicionado'
                ]
            ]
        ],
        'section_content' => [
            'form' => [
                'headings' => [
                    'slug' => 'Código',
                    'title' => 'Título',
                    'value' => 'Valor',
                    'is_active' => 'Status',
                    'actions' => 'Ações'
                ],
                'values' => [
                    'active' => 'Ativo',
                    'inactive' => 'Inativo'
                ],
            ]
        ]
    ]
];