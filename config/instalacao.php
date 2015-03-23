<?php
$tmp = Array( 
    Areas => Array(
	Areas => "artigos,comentarios_artigos,tipos_artigos,paginas,tipos_paginas,seccoes,idiomas,seccoes,objectos_pagina,tipos_objectos_pagina,templates,produtos,categorias_produtos,marcas,clientes,eventos,tipo_eventos,locais"
    ),

    Idiomas => Array(
    	Portugues => "Portugues, pt",
	Ingles => "Ingles, en",
	Espanhol => "Espanhol, es",
	Frances => "Frances, fr",
	Alemao => "Alemao, de"
    ),   

    artigos => Array(
		nome => "artigos",
		campos => "titulo, intro, artigo, video, tipo_artigo, seccao, comentarios, aliasweb, keywords, smalldescription, metadescription, longdescription",
		search_list => "titulo, tipo_artigo, idioma, data_criacao, criado_por, comentarios",
		folder => "artigos",
		search => "titulo, tipo_artigo",
		log => 1,
		order_by => "titulo",
		buttons => "add, edit, delete",
                images => true
    ),   
    artigos_titulo => Array(
                    nome => "titulo",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "nome",
                    default_search => true,
                    seccao => "main"
    ),
    artigos_intro => Array(
                    nome => "intro",
                    tipo => "text",
                    classe => "texto",
                    default_search => false,
                    seccao => "tabs",
                    tab => "introducao"
    ),
    artigos_artigo => Array(
                    nome => "artigo",
                    tipo => "text",
                    classe => "texto",
                    default_search => false,
                    seccao => "tabs",
                    tab => "edicao_pagina"
    ),
    artigos_video => Array(
                    nome => "video",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "url",
                    default_search => false,
                    seccao => "tabs",
                    tab => "multimedia"
    ),
    artigos_tipo_artigo => Array(
                    nome => "tipo_artigo",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "dropdown",
                    default_search => false,
                    ref => "tipos_artigos",
                    search_select => "SELECT cod FROM tipos_artigos WHERE nome LIKE '%",
                    default_select => "SELECT * FROM tipos_artigos ORDER BY nome",
                    seccao => "main"
    ),
    artigos_seccao => Array(
                    nome => "seccao",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "dropdown",
                    default_search => false,
                    ref => "seccoes",,
                    search_select => "SELECT cod FROM seccoes WHERE nome LIKE '%",
                    default_select => "SELECT * FROM seccoes ORDER BY nome",
                    seccao => "main"
    artigos_comentarios => Array(
                    nome => "comentarios",
                    tipo => "int",
                    classe => "num",
                    default_search => false,
                    seccao => "info"
    ),
    artigos_aliasweb => Array(
                    nome => "aliasweb",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "nome",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    artigos_keywords => Array(
                    nome => "keywords",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    artigos_metadescription => Array(
                    nome => "metadescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    artigos_smalldescription => Array(
                    nome => "smalldescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    artigos_longdescription => Array(
                    nome => "longdescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),		

    comentarios_artigos => Array(
                nome => "comentarios_artigos",
		campos => "artigo, comentario",
		search => "artigo",
		search_list => "artigo",
		log => 1,
		order_by => "data_criacao",
		buttons => "edit, delete",
                images => false
    ),
    comentarios_artigos_artigo => Array(
                    nome => "artigo",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "dropdown",
                    ref => "artigos",
                    search_select => "SELECT cod FROM tipos_artigos WHERE nome LIKE '%",
                    default_select => "SELECT * FROM tipos_artigos ORDER BY nome",
                    default_search => true
    ),
    comentarios_artigos_comentario => Array(
                    nome => "comentario",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false
    ),
    tipos_artigos => Array(
            nome => "tipos_artigos",
            campos => "nome",
            search => "nome",
            search_list => "nome, criado_por, editado_por, cod",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    tipos_artigos_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
		seccao => "main"
    ),
    paginas => Array(
            nome => "paginas",
            campos => "titulo, seccao, conteudo, aliasweb, keywords, smalldescription, metadescription, longdescription, mostrar_titulo, mostrar_subpaginas, mostrar_paginas_mesmo_nivel, posicao",
            folder => "paginas",
            search => "seccao, idioma",
            search_list => "titulo, seccao, idioma, criado_por, data_criacao",
            log => 1,
            order_by => "posicao",
            buttons => "add, edit, delete, moveup, movedown",
            images => true
    ),
    paginas_titulo => Array(
                nome => "titulo",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    paginas_tipo_pagina => Array(
                nome => "tipo_pagina",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "tipos_paginas",
                search_select => "SELECT cod FROM tipos_paginas WHERE nome LIKE '%",
                default_select => "SELECT * FROM tipos_paginas ORDER BY nome",
                seccao => "main"
    ),
    paginas_seccao => Array(
                nome => "seccao",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "seccoes",
                search_select => "SELECT cod FROM seccoes WHERE nome LIKE '%",
                default_select => "SELECT * FROM seccoes ORDER BY nome",
                seccao => "main"
    ),
    paginas_idioma => Array(
                nome => "idioma",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "idiomas",
                search_select => "SELECT cod FROM idiomas WHERE nome LIKE '%",
                default_select => "SELECT * FROM idiomas ORDER BY nome",
                seccao => "main"
    ),
    paginas_conteudo => Array(
                nome => "conteudo",
                tipo => "text",
                classe => "texto",
                default_search => false,
                seccao => "tabs",
                tab => "edicao_pagina"
    ),
    paginas_aliasweb => Array(
                nome => "aliasweb",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_keywords => Array(
                nome => "keywords",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_metadescription => Array(
                nome => "metadescription",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_smalldescription => Array(
                nome => "smalldescription",
		tipo => "text",
		classe => "simpletext",
		default_search => false,
		seccao => "tabs",
		tab => "publicacao"
    ),
    paginas_longdescription => Array(
		nome => "longdescription",
		tipo => "text",
		classe => "simpletext",
		default_search => false,
		seccao => "tabs",
		tab => "publicacao"
    ),
    paginas_visivel_menu => Array(
                nome => "visivel_menu",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_pesquisavel => Array(
                nome => "pesquisavel",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_barra_navegacao => Array(
                nome => "barra_navegacao",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_mostrar_titulo => Array(
                nome => "mostrar_titulo",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_mostrar_subpaginas => Array(
                nome => "mostrar_subpaginas",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_mostrar_paginas_mesmo_nivel => Array(
                nome => "mostrar_paginas_mesmo_nivel",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_template => Array(
                nome => "template",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "templates",
                search_select => "SELECT cod FROM templates WHERE nome LIKE '%",
                default_select => "SELECT * FROM templates order by nome",
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_imagem_pagina => Array(
                nome => "imagem_pagina",
                tipo => "varchar",
                tamanho => 255,
                classe => "image_upload",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_html_antes => Array(
                nome => "html_antes",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_html_depois => Array(
                nome => "html_depois",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_area_restrita => Array(
                nome => "area_restrita",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_posicao => Array(
                nome => "posicao",
                tipo => "int",
                classe => "num",
                default_search => false,
                seccao => "tabs",
                tab => "publicacao"
    ),
    paginas_grupos => Array(
                nome => "grupos",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "templates",
                search_select => "SELECT cod FROM grupos_utilizadores WHERE nome LIKE '%",
                default_select => "SELECT * FROM grupos_utilizadores order by nome",
                seccao => "tabs",
                tab => "publicacao"
    ),
    tipos_paginas => Array(
            nome => "tipos_paginas",
            campos => "nome",
            search => "nome",
            search_list => "nome",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    tipos_paginas_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    idiomas => Array(
            nome => "idiomas",
            campos => "nome",
            search => "nome",
            search_list => "nome",
            log => 0,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    idiomas_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    seccoes => Array(
            nome => "seccoes",
            campos => "nome, descricao, ordem",
            search_list => "nome, ordem",
            search => "nome",
            log => 1,
            order_by => "ordem",
            buttons => "add, edit, delete, moveup, movedown",
            images => false
    ),
    seccoes_nome => Array(
                nome => "nome",
                 tipo => "varchar",
                 tamanho => 255,
                 classe => "nome",
                 default_search => true,
                 seccao => "main"
    ),
    seccoes_descricao => Array(
                nome => "descricao",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "configuracao"
    ),
    seccoes_apontar_para => Array(
                nome => "apontar_para",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "paginas",
                search_select => "SELECT cod FROM paginas WHERE titulo LIKE '%",
                default_select => "SELECT * FROM paginas ORDER BY titulo",
                seccao => "tabs",
                tab => "configuracao"
    ),
    seccoes_ordem => Array(
                nome => "ordem",
                tipo => "int",
                classe => "num",
                default_search => false,
                seccao => "tabs",
                tab => "configuracao"
    ),
    objectos_pagina => Array(
            nome => "objectos_pagina",
            campos => "nome, tipo, restrito",
            search => "nome",
            search_list => "nome, tipo, restrito, criado_por, data_criacao",
            log => 1,
            order_by => "id",
            buttons => "add, edit, delete",
            images => false
    ),
    objectos_pagina_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    objectos_pagina_tipo => Array(
                nome => "tipo",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "tipos_objectos_pagina",
                search_select => "SELECT cod FROM tipos_objectos_pagina WHERE nome LIKE '%",
                default_select => "SELECT * FROM tipos_objectos_pagina order by nome",
                seccao => "tabs",
                tab => "configuracao"
    ),
    objectos_pagina_restrito => Array(
                nome => "restrito",
                tipo => "smallint",
                classe => "checkbox",
                default_search => false,
                seccao => "tabs",
                tab => "configuracao"
    ),
    tipos_objectos_pagina => Array(
            nome => "tipos_objectos_pagina",
            campos => "nome",
            search => "nome",
            log => 0,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    tipos_objectos_pagina_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    templates => Array(
            nome => "templates",
            campos => "nome",
            search => "nome",
            search_list => "nome",
            log => 0,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    templates_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    produtos => Array(
            nome => "produtos",
            campos => "nome, modelo, referencia, ref_externa, categoria, marca, peso, webname, keywords, descricao, resumo_produto, texto_produto, texto_destaque, ficheiro1, ficheiro2, template, layout, preco, preco_antigo",
            search => "categoria",
            search_list => "referencia, nome, modelo, marca",
            folder => "produtos",
            log => 1,
            order_by => "data_criacao",
            buttons => "add, edit, delete",
            images => true
    ),
    produtos_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_modelo => Array(
                nome => "modelo",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_referencia => Array(
                nome => "referencia",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_ref_externa => Array(
                nome => "ref_externa",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_categoria => Array(
                nome => "categoria",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "categorias_produtos",
                search_select => "SELECT cod FROM categorias_produtos WHERE nome LIKE '%",
                default_select => "SELECT * FROM categorias_produtos order by nome ",
                seccao => "main"
    ),
    produtos_marca => Array(
                nome => "marca",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "marcas",
                search_select => "SELECT cod FROM marcas WHERE nome LIKE '%",
                default_select => "SELECT * FROM marcas order by nome ",
                seccao => "main"
    ),
    produtos_peso => Array(
                nome => "peso",
                tipo => "double",
                classe => "peso",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_webname => Array(
                nome => "webname",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_keywords => Array(
                nome => "keywords",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_descricao => Array(
                nome => "descricao",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_resumo_produto => Array(
                nome => "resumo_produto",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_texto_produto => Array(
                nome => "texto_produto",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_texto_destaque => Array(
                nome => "texto_destaque",
                tipo => "text",
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_ficheiro1 => Array(
                nome => "ficheiro1",
                tipo => "varchar",
                tamanho => 255,
                classe => "upload",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_ficheiro2 => Array(
                nome => "ficheiro2",
                tipo => "varchar",
                tamanho => 255,
                classe => "upload",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_template => Array(
                nome => "template",
                tipo => "varchar",
                tamanho => 255,
                classe => "dropdown",
                default_search => false,
                ref => "templates",
                search_select => "SELECT cod FROM templates WHERE nome LIKE '%",
                default_select => "SELECT * FROM templates order by nome",
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_layout => Array(
                nome => "layout",
                tipo => "varchar",
                tamanho => 255,
                classe => "dados",
                default_search => false,
                seccao => "tabs",
                tab => "dados_principais"
    ),
    produtos_preco => Array(
                nome => "preco",
                tipo => "double",
                classe => "preco",
                default_search => false,
                seccao => "tabs",
                tab => "preco"
    ),
    produtos_preco_antigo => Array(
                nome => "preco_antigo",
                tipo => "double",
                classe => "preco",
                default_search => false,
                seccao => "tabs",
                tab => "preco"
    ),
    categorias_produtos => Array(
            nome => "categorias_produtos",
            campos => "nome, descricao",
            search => "nome",
            search_list => "nome",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    categorias_produtos_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    categorias_produtos_descricao => Array(
                nome => "descricao",
                tipo => "text",          
                classe => "simpletext",
                default_search => false,
                seccao => "tabs",
                tab => "descricao"
    ),
    marcas => Array(
            nome => "marcas",
            campos => "nome, site, logotipo",
            search => "nome",
            search_list => "nome, site",
            folder => "marcas",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    marcas_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    marcas_site => Array(
                nome => "site",
                tipo => "varchar",
                tamanho => 255,
                classe => "url",
                default_search => false,
                seccao => "tabs",
                tab => "dados"
    ),
    marcas_logotipo => Array(
                nome => "logotipo",
                tipo => "varchar",
                tamanho => 255,
                classe => "image_upload",
                default_search => false,
                seccao => "tabs",
                tab => "dados"
    ),
    familias => Array(
            nome => "familias",
            campos => "nome",
            search => "nome",
            search_list => "nome",
            folder => "familias",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    familias_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    clientes => Array(
            nome => "clientes",
            campos => "nome, referencia, contribuinte",
            search => "nome",
            search_list => "nome, referencia, contribuinte",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    clientes_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
                seccao => "main"
    ),
    clientes_referencia => Array(
                nome => "referencia",
                tipo => "varchar",
                tamanho => 255,
                classe => "dados",
                default_search => false,
                seccao => "main"
    ),
    clientes_contribuinte => Array(
                nome => "contribuinte",
                tipo => "int",
                classe => "nif",
                default_search => false,
                seccao => "tabs",
                tab => "dados_cliente"
    ),
    
    eventos => Array(
		nome => "eventos",
		campos => "nome, intro, evento, video, tipo_evento, local, aliasweb, keywords, smalldescription, metadescription, longdescription",
		search_list => "nome, tipo_evento, idioma, data_criacao, criado_por",
		folder => "eventos",
		search => "nome, tipo_evento",
		log => 1,
		order_by => "nome",
		buttons => "add, edit, delete",
                images => true
    ),   
    eventos_nome => Array(
                    nome => "nome",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "nome",
                    default_search => true,
                    seccao => "main"
    ),
    eventos_intro => Array(
                    nome => "intro",
                    tipo => "text",
                    classe => "texto",
                    default_search => false,
                    seccao => "tabs",
                    tab => "introducao"
    ),
    eventos_evento => Array(
                    nome => "evento",
                    tipo => "text",
                    classe => "texto",
                    default_search => false,
                    seccao => "tabs",
                    tab => "conteudo"
    ),
    eventos_video => Array(
                    nome => "video",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "url",
                    default_search => false,
                    seccao => "tabs",
                    tab => "multimedia"
    ),
    eventos_tipo_evento => Array(
                    nome => "tipo_evento",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "dropdown",
                    default_search => false,
                    ref => "tipo_eventos",
                    search_select => "SELECT cod FROM tipo_eventos WHERE nome LIKE '%",
                    default_select => "SELECT * FROM tipo_eventos ORDER BY nome",
                    seccao => "main"
    ),
    eventos_aliasweb => Array(
                    nome => "aliasweb",
                    tipo => "varchar",
                    tamanho => 255,
                    classe => "nome",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    eventos_keywords => Array(
                    nome => "keywords",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    eventos_metadescription => Array(
                    nome => "metadescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    eventos_smalldescription => Array(
                    nome => "smalldescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    eventos_longdescription => Array(
                    nome => "longdescription",
                    tipo => "text",
                    classe => "simpletext",
                    default_search => false,
                    seccao => "tabs",
                    tab => "publicacao"
    ),
    
    tipo_eventos => Array(
            nome => "tipo_eventos",
            campos => "nome",
            search => "nome",
            search_list => "nome, criado_por, editado_por, cod",
            log => 1,
            order_by => "nome",
            buttons => "add, edit, delete",
            images => false
    ),
    tipo_eventos_nome => Array(
                nome => "nome",
                tipo => "varchar",
                tamanho => 255,
                classe => "nome",
                default_search => true,
		seccao => "main"
    ),

    log_data_criacao => Array(
			nome => "data_criacao",
			label => "Data de Criacao",
			tipo => "date",
			classe => "data",
			hidden => 1
    ),
    log_criado_por => Array(
			nome => "criado_por",
			label => "Criado Por",
			tipo => "varchar",
			tamanho => 255,
			classe => "user",
			hidden => 1
    ),
    log_data_edicao => Array(
			nome => "data_edicao",
			label => "Data de Edicao",
			tipo => "date",
			classe => "data",
			hidden => 1
    ),
    log_editado_por => Array(
			nome => "editado_por",
			label => "Editado Por",
			tipo => "varchar",
			tamanho => 255,
			classe => "user",
			hidden => 1
    )
);
?>
