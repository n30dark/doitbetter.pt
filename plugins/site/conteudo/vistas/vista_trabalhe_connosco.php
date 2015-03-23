<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$conteudo = $dados['conteudo'];
$habilitacoes = $dados['habilitacoes'];
$plug = new GestorPlugins();
$plug->controlador = 'site';
$area = $conteudo->seccao;

?>

<script type="text/javascript">
    function validate_cv(){
        
        
        var valid = true;
        
        //expressions
        var email = '([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';
        
        var message = "Atenção:<br /><ul>";
        if($("#trabalhar input[name='nome']").val().length == 0 ){
            message = message + "<li>O nome deve estar preenchido;</li>";
            var valid = false;
        }
        if($("#trabalhar input[name='nome']").val().length < 3 ){
            message = message + "<li>O nome deve ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#trabalhar input[name='email']").val().length == 0 ){
            message = message + "<li>O e-mail deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#trabalhar input[name='email']").val().match(email) ){
            message = message + "<li>O email deve ser válido (xxx@xxx.xxx);</li>";
            var valid = false;
        }
        if($("#trabalhar select[name='habilitacoes']").val().length == 0 ){
            message = message + "<li>As habilitações devem estar preenchidas;</li>";
            var valid = false;
        }
        if($("#trabalhar select[name='funcao']").val().length == 0 ){
            message = message + "<li>A função deve estar preenchida;</li>";
            var valid = false;
        }
        if($("#trabalhar textarea[name='areas']").val().length == 0 ){
            message = message + "<li>As áreas de formação devem estar preenchidas;</li>";
            var valid = false;
        }
        if($("#trabalhar textarea[name='areas']").val().length < 3 ){   
            message = message + "<li>As áreas de formação devem ter no mínimo 3 letras;</li>";
            var valid = false;
        }
        if($("#trabalhar input[name='cv']").val().length == 0 ){
            message = message + "<li>Deve carregar um cv;</li>";
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
        
        $("#trabalhar input[name='data_nascimento']" ).datepicker();
        
        $("#trabalhar input[type='text']").focus(function(){
            $(this).val("");
        });
        
        $("#trabalhar #funcao_qual").hide();
        $("#trabalhar #areas").hide();
        
        $("#trabalhar select[name='funcao']").change(function(){
            if($(this).val()=="Outro"){
                $("#trabalhar #funcao_qual").show();
            }else{
                $("#trabalhar #funcao_qual").hide();
            }
            
            if($(this).val()=="Formador"){
                $("#trabalhar #areas").show();
            }else{
                $("#trabalhar #areas").hide();
            }
        }); 
        
        $("#trabalhar").ajaxForm({
            beforeSubmit: function(){
                if(validate_cv()){
                    return true;
                }else{
                    return false;
                }
            },
            success:function(){
                $(".alert-text").html(" Candidatura enviada com sucesso.");
                
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
                    
                    $("#trabalhar input[type='text']").val("");
                    $("#trabalhar input[type='file']").val("");
                    $("#trabalhar textarea").val("");
            }
        });
        
        $("#trabalhar").submit(function(){
            
            /*if(validate_cv()){
            
                $(this).ajaxSubmit(function(){
                    
                    $(".alert-text").html(" Candidatura enviada com sucesso.");
                
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
                    
                    $("#trabalhar input[type='text']").val("");
                    $("#trabalhar input[type='file']").val("");
                    $("#trabalhar textarea").val("");
                });
            }*/
            
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
                
                <form method="POST" action="<?= BO_URL::obterHrefInterno("enviar_cv") ?>" name="trabalhar" id="trabalhar" enctype="multipart/form-data">
                    <div class="form_field">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" />
                    </div>
                    <div class="form_field">
                        <label for="nome">Email:</label>
                        <input type="text" name="email" />
                    </div>
                    <div class="form_field">
                        <label for="localidade">Localidade:</label>
                        <input type="text" name="localidade" />
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
                        <label for="funcao">Função a que se candidata:</label>
                        <select name="funcao">
                            <option value="">Escolha a função...</option>
                            <option value="Formador">Formador</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Estagiário">Estagiário</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="form_field" id="funcao_qual">
                        <label for="funcao_qual">Qual?</label>
                        <input type="text" name="funcao_qual" />
                    </div>
                    <div class="form_field" id="areas">
                        <label for="areas">Áreas de formação:</label>
                        <textarea name="areas" ></textarea>
                    </div>
                    <div class="form_field">
                        <label for="cv">Anexar CV(PDF):</label>
                        <input type="file" name="cv" />
                    </div>
                    <div class="form_field">
                            <input type="submit" value="Enviar Candidatura" />
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