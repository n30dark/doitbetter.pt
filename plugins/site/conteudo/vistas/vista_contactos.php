<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$conteudo = $dados['conteudo'];
$plug = new GestorPlugins();
$plug->controlador = 'site';
$area = $conteudo->seccao;

?>

<script type="text/javascript">
    function validate_ef(){
        
        
        var valid = true;
        
        //expressions
        var email = '([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';
        
        var message = "Atenção:<br /><ul>";
        if($("#contactar input[name='nome']").val().length == 0 ){
            message = message + "<li>O nome deve estar preenchido;</li>";
            var valid = false;
        }
        if($("#contactar input[name='nome']").val().length < 3 ){
            message = message + "<li>O nome deve ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#contactar input[name='email']").val().length == 0 ){
            message = message + "<li>O e-mail deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#contactar input[name='email']").val().match(email) ){
            message = message + "<li>O email deve ser válido (xxx@xxx.xxx);</li>";
            var valid = false;
        }
        if($("#contactar input[name='assunto']").val().length == 0 ){
            message = message + "<li>O assunto deve estar preenchido;</li>";
            var valid = false;
        }
        if($("#contactar input[name='assunto']").val().length < 3 ){
            message = message + "<li>O assunto deve ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#contactar textarea[name='mensagem']").val().length == 0 ){
            message = message + "<li>A mensagem deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#contactar textarea[name='mensagem']").val().length < 3 ){
            message = message + "<li>A mensagem deve ter no mínimo 3 letras;</li>";
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
        
        $("#contactar input[name='data_nascimento']" ).datepicker();
        
        $("#contactar input[type='text']").focus(function(){
            $(this).val("");
        });
        
        $("#contactar").submit(function(){
            
            if(validate_ef()){
            
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
                    
                    $("#contactar input[type='text']").val("");
                    $("#contactar textarea").val("");
                });
            }
            
            return false;
        
           
        });
    });
</script>

<div class="content">
        <div class="center">
            <?= $plug->dispatch(Array("home", "logo", $area, $lingua->lingua)); ?>
            <span class="title"><?= $conteudo->titulo ?></span><br />
            
            <div class="content">
                <?= html_entity_decode($conteudo->conteudo) ?>
                <br />
                
                <form method="POST" action="<?= BO_URL::obterHrefInterno("enviar_emailcontacto") ?>" name="contactar" id="contactar">
                    <div class="form_field">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" />
                    </div>
                    <div class="form_field">
                        <label for="nome">Email:</label>
                        <input type="text" name="email" />
                    </div>
                    <div class="form_field">
                        <label for="nome">Assunto:</label>
                        <input type="text" name="assunto" />
                    </div>
                    <div class="form_field">
                        <label for="nome">Mensagem:</label>
                        <textarea name="mensagem" ></textarea>
                    </div>
                    <div class="form_field">
                            <input type="submit" value="Enviar Mensagem" />
                        </div>
                </form>
            </div>
        </div>      
        <div class="right">
            <?= $plug->dispatch(Array("home", "phone", $area, $lingua->lingua)); ?>
            <?php if($area=='cursos'): ?>
                <?= $plug->dispatch(Array("conteudo", "contacto_lateral", $area, $lingua->lingua)); ?>    
            <?php else: ?>
                <?= $plug->dispatch(Array("home", "courses", $area, $lingua->lingua)); ?>
            <?php endif; ?>
            <?= $plug->dispatch(Array("home", "promos", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "legal", $area, $lingua->lingua)); ?>
            <?= $plug->dispatch(Array("home", "newsletter", $area, $lingua->lingua)); ?>
            
        </div>  
    </div>