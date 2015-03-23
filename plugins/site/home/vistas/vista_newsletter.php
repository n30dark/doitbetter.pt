<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
?>
<script type="text/javascript">
    function validate_nl(){
        var valid = true;
        
        //expressions
        var email = '([\\w-+]+(?:\\.[\\w-+]+)*@(?:[\\w-]+\\.)+[a-zA-Z]{2,7})';
        
        var message = "Atenção:<br /><ul>";
        if($("#newsletter_subscription input[name='email']").val().length == 0 ){
            message = message + "<li>O e-mail deve estar preenchido;</li>";
            var valid = false;
        }
        if(!$("#newsletter_subscription input[name='email']").val().match(email) ){
            message = message + "<li>O email deve ser válido (xxx@xxx.xxx);</li>";
            var valid = false;
        }    
        message = message + "</ul>"
            
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
        
        $("#newsletter_subscription input[name='email']").focus(function(){
           $(this).val(""); 
        });
        
        $("#newsletter_subscription").submit(function(){
            
            if(validate_nl()){
            
                $(this).ajaxSubmit(function(){
                    
                    $(".alert-text").html("Newsletter submetida com sucesso.");
                
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
                });
            }
            
            $("#newsletter_subscription input[name='email']").val("");
            
            return false;
            
        });
    });
</script>

<div class="newsletter">
    <div class="headtag"></div>
    <div class="content">
        <form method="POST" action="<?= BO_URL::obterHrefInterno("submeter_newsletter")?>" name="newsletter_subscription" id="newsletter_subscription">
            <label for="email">Subscreva a nossa newsletter:</label><br />
            <div class="fill">
                <input type="text" name="email" value="E-mail" />
                <input type="submit" name="submit_newsletter" value="OK" />
            </div>
        </form>
    </div>
</div>  