<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$pagina = $dados['pagina'];
$nacionalidades = $dados['nacionalidades'];
$distritos = $dados['distritos'];
$habilitacoes = $dados['habilitacoes'];
$onde_conheceu = $dados['onde_conheceu'];
?>

<script type="text/javascript">
    function validate_cf(){
        
        
        var valid = true;
        
        //expressions
        var email = '([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';
        var telefone = '(\\d{9})';
        var date = '((?:(?:[0-2]?\\d{1})|(?:[3][01]{1}))[-:\\/.](?:[0]?[1-9]|[1][012])[-:\\/.](?:(?:[1]{1}\\d{1}\\d{1}\\d{1})|(?:[2]{1}\\d{3})))(?![\\d])';
        
        var message = "Atenção:<br /><ul>";
        if($("#contact_form input[name='nome']").val().length == 0 ){
            message = message + "<li>O nome deve estar preenchido;</li>";
            var valid = false;
        }
        if($("#contact_form input[name='nome']").val().length < 3 ){
            message = message + "<li>O nome deve ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#contact_form input[name='telefone']").val().length == 0 ){
            message = message + "<li>O telefone deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#contact_form input[name='telefone']").val().match(telefone) ){
            message = message + "<li>O número de telefone deve ser válido (xxxxxxxxx);</li>";
            var valid = false;    
        }
        if($("#contact_form input[name='e-mail']").val().length == 0 ){
            message = message + "<li>O e-mail deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#contact_form input[name='e-mail']").val().match(email) ){
            message = message + "<li>O email deve ser válido (xxx@xxx.xxx);</li>";
            var valid = false;
        }
        if($("#contact_form input[name='morada']").val().length == 0 ){
            message = message + "<li>A morada deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#contact_form input[name='data_nascimento']").val().length == 0 ){
            message = message + "<li>A data de nascimento deve estar preenchida;</li>";
            var valid = false;
        }
        if(!$("#contact_form input[name='data_nascimento']").val().match(date) ){
            message = message + "<li>A data de nascimento deve ser válida (dd/mm/aaaa);</li>";
            var valid = false;
        }
        if($("#contact_form select[name='habilitacoes']").val().length == 0 ){
            message = message + "<li>As habilitações devem estar preenchidas;</li>";
            var valid = false;
        }
        if($("#contact_form select[name='nacionalidade']").val().length == 0 ){
            message = message + "<li>A nacionalidade deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#contact_form select[name='distrito']").val().length == 0 ){
            message = message + "<li>O distrito deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#contact_form submit[name='li_concordo']").is(":checked") ){
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
        
        $("#contact_form input[name='data_nascimento']" ).datepicker({
            changeMonth: true,
			changeYear: true,
            minDate: new Date(1930, 1 - 1, 1),
            maxDate: new Date(),
            yearRange: "1930:c",
            dateFormat: "dd-mm-yy" 
        });
        
        $("#contact_form input[type='text']").focus(function(){
            $(this).val("");
        });
        
        $("#contact_form").submit(function(){
            
            if(validate_cf()){
            
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
                    
                    $("#contact_form input[type='text']").val("");
                });
            }
            
            return false;
        
           
        });
    });
</script>

<div class="side_contact">
    <div class="headtag"></div>
    <div class="content">
        <form method="POST" action="<?= BO_URL::obterHrefInterno("enviar_contacto") ?>" name="contact_form" id="contact_form">
            <input type="hidden" name="curso" value="<?= $pagina->titulo ?>" />
            <input type="text" name="nome" value="Nome" /><br />
            <input type="text" name="telefone" value="Telefone" /><br />
            <input type="text" name="e-mail" value="E-mail" /><br />
            <input type="text" name="morada" value="Morada" /><br />
            <div class="selectbox">
            <select name="distrito" >
                <option value="">Distrito</option>
                <?php foreach($distritos as $distrito): ?>
                    <option value="<?= $distrito->nome ?>"><?= htmlentities($distrito->nome) ?></option>
                <?php endforeach; ?>
            </select>
            </div><br />
            <input type="text" name="data_nascimento" value="Data de Nascimento" /><br />
            <div class="selectbox">
            <select name="nacionalidade">
                <option value="">Nacionalidade</option>
                <?php foreach($nacionalidades as $nacionalidade): ?>
                    <option value="<?= $nacionalidade->nome ?>"><?= htmlentities($nacionalidade->nome) ?></option>
                <?php endforeach; ?>
            </select>
            </div><br />
            <div class="selectbox">
            <select name="habilitacoes" >
                <option value="">Habilitações</option>
                <?php foreach($habilitacoes as $habilitacao): ?>
                    <option value="<?= $habilitacao->habilitacao ?>"><?= htmlentities($habilitacao->habilitacao) ?></option>
                <?php endforeach; ?>
            </select>
            </div><br />
            <div class="selectbox">
            <select name="onde_nos_conheceu" >
                <option value="">Onde nos Conheceu</option>
                <?php foreach($onde_conheceu as $oc): ?>
                    <option value="<?= $oc->descricao ?>"><?= htmlentities($oc->descricao) ?></option>
                <?php endforeach; ?>
            </select>
            </div><br />
            <input type="checkbox" name="li_concordo" /><label for="li_concordo">Li e aceito a <a href="<?= BO_URL::obterHrefInterno("politica_privacidade") ?>">Política de Privacidade</a> da Do It Better</label><br />
            <input type="submit" name="submit_contact" value="Enviar" /><br />
        </form>
    </div>
</div>