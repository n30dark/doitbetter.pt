<?php

$tmp = Array(
    'Areas' => Array(
	'Num' => 8,
	'Areas' => "utilizadores_bo,grupos_aut,utilizadores_bo_temp,nl_grupos,nl_subscritores,newsletter,utilizadores,utilizadores_temp,contactos,tabelas"
    ),
    'utilizadores_bo' => Array(
		'nome' => "utilizadores_bo",
		'label' => "Administradores",
		'images' => 0,
		'num_campos' => 6,
		'campos' => "utilizador, password, nome, email, avatar, contacto, grupoaut",
		'search' => "utilizador, nome, email, contacto, grupoaut",
		'order_by' => "utilizador",
		'buttons' => "add, delete",
		'buttons_labels' => "Adicionar, Eliminar",
		'num_tabs' => 2,
		'tabs' => "Dados de Login, Dados de Utilizador",
                'folder' => "utilizadores_bo"
    ),
    'utilizadores_bo_utilizador' => Array(
			'nome' => "utilizador",
			'label' => "Utilizador",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "user",
			'default_search' => true,
			'width' => 80,
			'tab' => 1,
			'seccao' => "main"
    ),
    'utilizadores_bo_password' => Array(
			'nome' => "password",
			'label' => "Palavra Passe",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "bopassword",
			'width' => 100,
			'tab' => 1,
			'seccao' => "main"
    ),
    'utilizadores_bo_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'width' => 100,
			'tab' => 2,
			'seccao' => "tabs",
			'tab' => "dados_utilizador"
    ),
    'utilizadores_bo_avatar' => Array(
                        'nome' => "avatar",
			'label' => "Avatar",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "upload",
			'width' => 100,
			'tab' => 2,
			'seccao' => "tabs",
			'tab' => "dados_utilizador"
    ),
    'utilizadores_bo_contacto' => Array(
			'nome' => "contacto",
			'label' => "Contacto",
			'tipo' => "int",
			'tamanho' => 9,
			'classe' => "telefone",
			'width' => 80,
			'tab' => 2,
			'seccao' => "tabs",
			'tab' => "dados_utilizador"
    ),
    'utilizadores_bo_email' => Array(
			'nome' => "email",
			'label' => "email",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "email",
			'width' => 100,
			'tab' => 2,
			'seccao' => "tabs",
			'tab' => "dados_utilizador"
    ),
    'utilizadores_bo_grupoaut' => Array(
			'nome' => "grupoaut",
			'label' => "Grupo",
			'tipo' => "int",
			'ref' => "grupos_aut",
			'classe' => "dropdown_req",
			'width' => 50,
			'tab' => 1,
			'seccao' => "tabs",
			'tab' => "dados_utilizador"
    ),
    'utilizadores_bo_temp' => Array(
		'nome' => "utilizadores_bo_temp",
		'label' => "Logs Utilizadores BO",
		'images' => 0,
		'num_campos' => 3,
		'campos' => "utilizador, codigo, ultimologin",
		'search' => "utilizador, codigo, ultimologin",
		'order_by' => "utilizador",
		'num_tabs' => 1
    ),
    'utilizadores_bo_temp_utilizador' => Array(
			'nome' => "utilizador",
			'label' => "Utilizador",
			'tipo' => "varchar",
			'tamanho' => 255,
			'ref' => "utilizadores_bo",
			'classe' => "user",
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'utilizadores_bo_temp_codigo' => Array(
			'nome' => "codigo",
			'label' => "Codigo",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "password",
			'width' => 100,
			'tab' => 1
    ),
    'utilizadores_bo_temp_ultimologin' => Array(
			'nome' => "ultimologin",
			'label' => "Ultimo Login",
			'tipo' => "date",
			'classe' => "data",
			'width' => 100,
			'tab' => 1
    ),
    'grupos_aut' => Array(
		'nome' => "grupos_aut",
		'label' => "Grupos Admin.",
		'images' => 0,
		'num_campos' => 2,
		'campos' => "nome, tabelas",
		'search' => "nome",
		'order_by' => "nome",
		'buttons' => "add, delete, edit",
		'buttons_labels' => "Adicionar, Eliminar, Editar",
		'num_tabs' => 1
    ),
    'grupos_aut_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'grupos_aut_tabelas' => Array(
			'nome' => "tabelas",
			'label' => "Tabelas",
			'tipo' => "text",
			'classe' => "multiselect",
			'width' => 140,
			'ref' => "tabelas",
			'tab' => 1
    ),
    'newsletter' => Array(
		'nome' => "newsletter",
		'label' => "Newsletter",
		'images' => 1,
		'num_campos' => 1,
		'campos' => "nome",
		'log' => 1,
		'folder' => "newsletter",
		'search' => "nome",
		'order_by' => "data_criacao",
		'buttons' => "add, delete, edit, send, test_send",
		'buttons_labels' => "Adicionar, Eliminar, Editar, Enviar, Testar",
		'num_tabs' => 1
    ),
    'newsletter_nome' => Array(
			'nome' => "nome",
			'label' => "Titulo",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 200,
			'tab' => 1
    ),
    'newsletter_avancada' => Array(
		'nome' => "newsletter_avancada",
		'label' => "Newsletter",
		'images' > 0,
		'num_campos' => 2,
		'campos' => "nome, texto",
		'log' => 1,
		'search' => "nome",
                'search_list' => "id, nome, data_criacao, criado_por",
		'order_by' => "data_criacao",
		'buttons' => "add, delete, edit, send, test_send",
		'buttons_labels' => "Adicionar, Eliminar, Editar, Enviar, Testar",
		'num_tabs' => 1
    ),
    'newsletter_avancada_nome' => Array(
			'nome' => "nome",
			'label' => "Titulo",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 140,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'newsletter_avancada_texto' => Array(
			'nome' => "texto",
			'label' => "Conteúdo",
			'tipo' => "text",
			'classe' => "texto",
			'width' => 200,
			'tab' => 1,
                        'seccao' => "tabs",
                        'tab' => "conteudo"
    ),
    'nl_subscritores' => Array(
		'nome' => "nl_subscritores",
		'label' => "Subscritores Newsletter",
		'images' => 0,
		'num_campos' => 2,
		'campos' => "email, grupo",
		'search' => "email, grupo",
                'search_list' => "email, grupo",
		'order_by' => "email",
		'buttons' => "add, delete, export_list, import_list",
		'buttons_labels' => "Adicionar, Eliminar, Exportar, Importar",
		'num_tabs' => 1
    ),
    'nl_subscritores_email' => Array(
			'nome' => "email",
			'label' => "Email",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "email",
			'default_search' => true,
			'width' => 100,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'nl_subscritores_grupo' => Array(
			'nome' => "grupo",
			'label' => "Grupo",
			'tipo' => "varchar",
			'tamanho' => 255,
			'ref' => "nl_grupos",
			'search_select' => "SELECT id FROM nl_grupos WHERE nome LIKE '%",
                        'default_select' => "SELECT * FROM nl_grupos ORDER BY nome",
			'classe' => "dropdown",
			'width' => 100,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'nl_grupos' => Array(
		'nome' => "nl_grupos",
		'label' => "Grupos Newsletter",
		'images' => 0,
		'num_campos' => 1,
		'campos' => "nome",
		'search' => "nome",
                'search_list' => "nome",
		'order_by' => "nome",
		'buttons' => "add, delete, edit",
		'buttons_labels' => "Adicionar, Eliminar, Editar",
		'num_tabs' => 1
    ),
    'nl_grupos_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 150,
			'tab' => 1
    ),
    'utilizadores' => Array(
		'nome' => "utilizadores",
		'label' => "Utilizadores",
		'images' => 0,
		'num_campos' => 8,
		'campos' => "email, utilizador, palavrapasse, avatar, nome, morada, telefone, pais",
		'search_list' => "utilizador, email, nome, morada, telefone, pais",
                'search' => "utilizador, email, nome, pais",
		'order_by' => "utilizador",
		'buttons' => "add, delete, edit",
		'buttons_labels' => "Adicionar, Eliminar, Editar",
		'num_tabs' => 2,
		'tabs' => "Dados de Login, Dados de Utilizador"
    ),
    'utilizadores_email' => Array(
			'nome' => "email",
			'label' => "Email",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "email",
			'width' => 100,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'utilizadores_utilizador' => Array(
			'nome' => "utilizador",
			'label' => "Utilizador",
			'tipo' => "varchar",
			'tamanho' => "255",
			'classe' => "user",
			'default_search' => true,
			'width' => 100,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'utilizadores_palavrapasse' => Array(
			'nome' => "palavrapasse",
			'label' => "Palavra Passe",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "password",
			'width' => 100,
			'tab' => 1,
                        'seccao' => "main"
    ),
    'utilizadores_avatar' => Array(
			'nome' => "avatar",
			'label' => "Avatar",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "image_upload",
			'width' => 100,
			'tab' => 2,
                        'seccao' => "tabs",
                        'tab' => "dados"
    ),
    'utilizadores_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'width' => 100,
			'tab' => 2,
                        'seccao' => "tabs",
                        'tab' => "dados"
    ),
    'utilizadores_morada' => Array(
			'nome' => "morada",
			'label' => "Morada",
			'tipo' => "text",
			'classe' => "morada",
			'width' => 150,
			'tab' => 2,
                        'seccao' => "tabs",
                        'tab' => "dados"
    ),
    'utilizadores_telefone' => Array(
			'nome' => "telefone",
			'label' => "Telefone",
			'tipo' => "int",
			'tamanho' => 9,
			'classe' => "telefone",
			'width' => 80,
			'tab' => 2,
                        'seccao' => "tabs",
                        'tab' => "dados"
    ),
    'utilizadores_pais' => Array(
			'nome' => "pais",
			'label' => "País",
			'tipo' => "varchar",
			'tamanho' => 3,
			'ref' => "paises",
			'search_select' => "SELECT id FROM paises WHERE nome LIKE '%",
                        'default_select' => "SELECT * FROM paises ORDER BY nome",
			'classe' => "dropdown",
			'width' => 50,
			'tab' => 2,
                        'seccao' => "tabs",
                        'tab' => "dados"
    ),
    'utilizadores_temp' => Array(
		'nome' => "utilizadores_temp",
		'label' => "Logs Utilizadores",
		'images' => 0,
		'num_campos' => 3,
		'campos' => "utilizador, codigo, ultimologin",
		'search' => "utilizador, codigo, ultimologin",
		'order_by' => "utilizador",
		'maxHeight' => 150,
		'maxWidth' => 150,
		'larguras' => "150, 110, 80",
		'num_tabs' => 1
    ),
    'utilizadores_temp_utilizador' => Array(
			'nome' => "utilizador",
			'label' => "Utilizador",
			'tipo' => "varchar",
			'tamanho' => 255,
			'ref' => "utilizadores_bo",
			'classe' => "user",
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'utilizadores_temp_codigo' => Array(
			'nome' => "codigo",
			'label' => "Codigo",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "password",
			'width' => 100,
			'tab' => 1
    ),
    'utilizadores_temp_ultimologin' => Array(
			'nome' => "ultimologin",
			'label' => "Ultimo Login",
			'tipo' => "date",
			'classe' => "data",
			'width' => 100,
			'tab' => 1
    ),
    'paises' => Array(
		'nome' => "paises",
		'label' => "Paises",
		'images' => 0,
		'num_campos' => 8,
		'campos' => "nome",
		'search' => "nome",
		'hidden' => 1,
		'order_by' => "nome",
		'buttons' => "add, delete, edit",
		'buttons_labels' => "Adicionar, Eliminar, Editar",
		'num_tabs' => 1
    ),
    'paises_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'tabelas' => Array(
		'nome' => "tabelas",
		'label' => "Tabelas",
		'images' => 0,
		'num_campos' => 1,
		'campos' => "nome",
		'search' => "nome",
		'hidden' => 1,
		'order_by' => "nome",
		'buttons' => "",
		'buttons_labels' => "",
		'num_tabs' => 1
    ),
    'tabelas_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'contactos' => Array(
		'nome' => "contactos",
		'label' => "Contactos",
		'images' => 0,
		'num_campos' => 6,
		'campos' => "nome, email, assunto, texto, data_criacao, lido",
		'responder' => 1,
		'search' => "nome, email, assunto, texto, data_criacao",
		'order_by' => "lido",
		'buttons' => "read, answer",
		'buttons_labels' => "Ler, Responder",
		'num_tabs' => 1
    ),
    'contactos_nome' => Array(
			'nome' => "nome",
			'label' => "nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'so_leitura' => 1,
			'width' => 100,
			'tab' => 1
    ),
    'contactos_email' => Array(
			'nome' => "email",
			'label' => "email",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "email",
			'so_leitura' => 1,
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'contactos_assunto' => Array(
			'nome' => "assunto",
			'label' => "Assunto",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "dados",
			'so_leitura' => 1,
			'width' => 120,
			'tab' => 1
    ),
    'contactos_texto' => Array(
			'nome' => "texto",
			'label' => "Texto",
			'tipo' => "text",
			'classe' => "texto",
			'so_leitura' => 1,
			'width' => 150,
			'tab' => 1
    ),
    'contactos_data_criacao' => Array(
			'nome' => "data_criacao",
			'label' => "Data de Criação",
			'tipo' => "date",
			'classe' => "data",
			'so_leitura' => 1,
			'width' => 100,
			'tab' => 1
    ),
    'contactos_lido' => Array(
			'nome' => "lido",
			'label' => "Lido",
			'tipo' => "tinyint",
			'classe' => "checkbox",
			'autocheck' => 1,
			'width' => 50,
			'tab' => 1
    ),
    'guestbook' => Array(
		'nome' => "guestbook",
		'label' => "GuestBook",
		'images' => 0,
		'num_campos' => 4,
		'campos' => "nome, email, texto, mostrar",
		'log' => 1,
		'parental' => 1,
		'search' => "nome, email, texto, mostrar",
		'order_by' => "data_criacao",
		'buttons' => "read, delete",
		'buttons_labels' => "Ler, Eliminar",
		'num_tabs' => 1
    ),
    'guestbook_nome' => Array(
			'nome' => "nome",
			'label' => "Nome",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "nome",
			'so_leitura' => 1,
			'width' => 100,
			'tab' => 1
    ),
    'guestbook_email' => Array(
			'nome' => "email",
			'label' => "Email",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "email",
			'so_leitura' => 1,
			'default_search' => true,
			'width' => 100,
			'tab' => 1
    ),
    'guestbook_texto' => Array(
			'nome' => "texto",
			'label' => "Texto",
			'tipo' => "text",
			'classe' => "texto",
			'so_leitura' => 1,
			'width' => 150,
			'tab' => 1
    ),
    'guestbook_mostrar' => Array(
			'nome' => "mostrar",
			'label' => "Aprovado",
			'tipo' => "tinyint",
			'classe' => "checkbox",
			'width' => 50,
			'tab' => 1
    ),
    'log_data_criacao' => Array(
			'nome' => "data_criacao",
			'label' => "Data de Criacao",
			'tipo' => "date",
			'classe' => "data",
			'hidden' => 1,
			'width' => 100
    ),
    'log_criado_por' => Array(
			'nome' => "criado_por",
			'label' => "Criado Por",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "user",
			'hidden' => 1,
			'width' => 100
    ),
    'log_data_edicao' => Array(
			'nome' => "data_edicao",
			'label' => "Data de Edicao",
			'tipo' => "date",
			'classe' => "data",
			'hidden' => 1,
			'width' => 100
    ),
    'log_editado_por' => Array(
			'nome' => "editado_por",
			'label' => "Editado Por",
			'tipo' => "varchar",
			'tamanho' => 255,
			'classe' => "user",
			'hidden' => 1,
			'width' => 100
    )
);
?>
