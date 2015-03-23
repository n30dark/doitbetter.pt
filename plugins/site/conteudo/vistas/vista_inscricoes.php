<?php
    $conf = $dados['conf'];
    $lingua = $dados['lingua'];
    $conteudo = $dados['conteudo'];
    $cursos = $dados['cursos'];
    $habilitacoes = $dados['habilitacoes'];
    $nacionalidades = $dados['nacionalidades'];
    $como_soube = $dados['como_soube'];
    
    $plug = new GestorPlugins();
    $plug->controlador = 'site';
    $area = $conteudo->seccao;
?>

<script type="text/javascript">
    function validate_pi(){
        
        
        var valid = true;
        
        //expressions
        var email = '([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';
        var telefone = '(\\d{9})';
        var date = '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';
        
        var message = "Atenção:<br /><ul>";
        if($("#pre_inscricao input[name='nome']").val().length == 0 ){
            message = message + "<li>O nome deve estar preenchido;</li>";
            var valid = false;
        }
        if($("#pre_inscricao input[name='nome']").val().length < 3 ){
            message = message + "<li>O nome deve ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#pre_inscricao input[name='telefone']").val().length == 0 ){
            message = message + "<li>O telefone deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#pre_inscricao input[name='telefone']").val().match(telefone) ){
            message = message + "<li>O número de telefone deve ser válido (xxxxxxxxx);</li>";
            var valid = false;    
        }
        if($("#pre_inscricao input[name='email']").val().length == 0 ){
            message = message + "<li>O e-mail deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#pre_inscricao input[name='email']").val().match(email) ){
            message = message + "<li>O email deve ser válido (xxx@xxx.xxx);</li>";
            var valid = false;
        }
        if($("#pre_inscricao input[name='morada']").val().length == 0 ){
            message = message + "<li>A morada deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#pre_inscricao input[name='data_nascimento']").val().length == 0 ){
            message = message + "<li>A data de nascimento deve estar preenchida;</li>";
            var valid = false;
        }
        if(!$("#pre_inscricao input[name='data_nascimento']").val().match(date) ){
            message = message + "<li>A data de nascimento deve ser válida (dd/mm/aaaa);</li>";
            var valid = false;
        }
        if($("#pre_inscricao select[name='habilitacoes']").val().length == 0 ){
            message = message + "<li>As habilitações devem estar preenchidas;</li>";
            var valid = false;
        }
        if($("#pre_inscricao select[name='nacionalidade']").val().length == 0 ){
            message = message + "<li>A nacionalidade deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#pre_inscricao select[name='razoes']").val().length == 0 ){
            message = message + "<li>As razões devem estar preenchidas;</li>";
            var valid = false;
        }
        if(!$("#pre_inscricao input[name='li_aceito']").is(":checked") ){
            message = message + "<li>Deve aceitar a <a href='<?= BO_URL::obterHrefInterno("politica_privacidade") ?>'>Política de Privacidade</a>;</li>";
            var valid = false;
        }
        
        message = message + "</ul>";
            
        if(!valid){
	
            $(".alert-text").html(message);
            
            $( "#dialog" ).dialog({
			     modal: true,
                 resizable: false,
			     buttons: {
                    Ok: function() {
					   $( this ).dialog( "close" );
                    }
			     }
            });
        }
        
        return valid; 
    }

    $(function(){
        
        $("#pre_inscricao input[name='data_nascimento']" ).datepicker({
            changeMonth: true,
			changeYear: true,
            minDate: new Date(1930, 1 - 1, 1),
            maxDate: new Date(),
            yearRange: "1930:c",
            dateFormat: "dd-mm-yy"
        });
        
        $("#pre_inscricao input[type='text']").focus(function(){
            $(this).val("");
        });
        
        $("#pre_inscricao").submit(function(){
            
            if(validate_pi()){
            
                $(this).ajaxSubmit(function(){
                    
                    $(".alert-text").html("Contacto enviado com sucesso.");
                
                    $( "#dialog" ).dialog({
        			     modal: true,
                         resizable: false,
                         title: "Sucesso!",
        			     buttons: {
                            Ok: function() {
        					   $( this ).dialog( "close" );
                            }
        			     }
                    });
                    $("#pre_inscricao input[type='text']").val("");
                });
            }
            
            return false;
        
           
        });
    });
</script>

<div class="content">
        <div class="center">
            <?= $plug->dispatch(Array("home", "logo", $area, $lingua->lingua)); ?>
            <span class="title">Faça já a sua pré-inscrição</span><br />
            <div class="content">
                <?= html_entity_decode($conteudo->conteudo) ?>
                <form method="POST" action="<?= BO_URL::obterHrefInterno("preinscrever")?>" id="pre_inscricao" name="pre_inscricao">
                    <div class="form_field">
                        <label for="curso">Curso:</label>
                        <select name="curso">
                            <option value="">Escolha o curso...</option>
                            <?php foreach($cursos as $curso): ?>
                            <option value="<?= ($curso->titulo) ?>"><?= $curso->titulo ?></option>
                            <?php endforeach; ?>
                        </select>    
                    </div>
                    <div class="form_field">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" />
                    </div>
                    <div class="form_field">
                        <label for="morada">Morada:</label>
                        <input type="text" name="morada" />
                    </div>
                    <div class="form_field">
                        <label for="localidade">Localidade:</label>
                        <input type="text" name="localidade" />
                    </div>
                    <div class="form_field">
                        <label for="cod_postal">Código Postal:</label>
                        <input type="text" name="cod_postal" />
                    </div>
                    <div class="form_field">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" />
                    </div>
                    <div class="form_field">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" />
                    </div>
                    <div class="form_field">
                        <label for="nacionalidade">Nacionalidade:</label>
                        <select name="nacionalidade">
                            <option value="">Nacionalidade...</option>
                            <?php foreach($nacionalidades as $nacionalidade): ?>
                            <option value="<?= htmlentities($nacionalidade->nome) ?>"><?= htmlentities($nacionalidade->nome) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form_field">
                        <label for="data_nascimento">Data de nascimento:</label>
                        <input type="text" name="data_nascimento" />
                    </div>
                    <div class="form_field">
                        <label for="habilitacoes">Habilitações Literárias:</label>
                        <select name="habilitacoes">
                            <option value="">Habilitações literárias...</option>
                            <?php foreach($habilitacoes as $habilitacao): ?>
                            <option value="<?= htmlentities($habilitacao->habilitacao) ?>"><?= htmlentities($habilitacao->habilitacao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form_field">
                        <label for="como_soube">Como conheceu o curso:</label>
                        <select name="como_soube">
                            <option value="">Como conheceu?...</option>
                            <?php foreach($como_soube as $cs): ?>
                            <option value="<?= htmlentities($cs->descricao) ?>"><?= htmlentities($cs->descricao) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form_field">
                        <label for="razoes">Razões da frequência do curso:</label>
                        <select name="razoes">
                            <option value="">Razões para frequentar...</option>
                            <option value="Curiosidade Pessoal">Curiosidade Pessoal</option>
                            <option value="Interesse Profissional">Interesse Profissional</option>
                            <option value="Actualização/Reciclagem de conhecimentos a nível profissional">Actualização/Reciclagem de conhecimentos a nível profissional</option>
                            <option value="Outro...">Outro...</option>
                        </select>
                    </div>
                    <div class="form_field">
                        <label for="li_aceito">Declaro que li e tomei conhecimento da <a href="<?= BO_URL::obterHrefInterno('politica_privacidade') ?>">Política de Privacidade</a> da DoItBetter</label>
                        <input type="checkbox" name="li_aceito" />
                    </div>
                    <div class="form_field" id="declaracao_confidencialidade">
                        A <i>DoItBetter Consulting</i> garante a estreita confidencialidade no tratamento dos seus dados pessoais. A informação por si disponibilizada não será partilhada com terceiros e será utilizada para fins directamente relacionados com o curso em que irá participar.
                    </div>
                    <div class="form_field">
                        <label for="autorizo_nl">Autorizo que os meus dados sejam usados para efeitos promocionais da actividade formativa.</label>
                        <input type="checkbox" name="autorizo_nl" /> 
                    </div>
                    <div class="form_field">
                        <label for="autorizo_outras">Autorizo as entidades que certificam ou homologam esta entidade Formadora, ou as suas acções formativas, a utilizar os meus dados pessoais, para efeitos de acompanhamento ou da auscultação da qualidade da formação.</label>
                        <input type="checkbox" name="autorizo_outras" />
                    </div>
                    <div class="form_field">
                        <input type="submit" value="Enviar Pré-Inscrição" />
                    </div>
                </form>
            </div>
        </div>      
        <div class="right">
            <?= $plug->dispatch(Array("home", "phone", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "courses", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "promos", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "legal", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "newsletter", $area, $lingua->lingua)); ?>
            
        </div>  
    </div>