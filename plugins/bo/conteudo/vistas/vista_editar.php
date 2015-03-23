<?php
    $id = $dados['id'];
    $install = $dados['install'];
    $conf = $dados['conf'];
    $tabela = $dados['tabela'];
    $campos = $dados['campos'];
    $item = $dados['item'];
    $formulario = $dados['formulario'];
    $form = $dados['form'];
    $form_action = $dados['form_action'];

    $qs = new QueryString();
    $query = $qs->Segmentos;
    $subseccao = $query[3];

    $bd = new BaseDados();

    $linguas = $bd->obterArrayObjectos("SELECT * FROM idiomas");

    $imagens = $install[$tabela]['images'];

    $form_cont = $formulario->campos;

    $fields = Array();
    foreach($campos as $campo){
        $seccao = $install[$tabela.'_'.$campo]['seccao'];
        if(!isset($fields[$seccao]))
            if($seccao==='tabs'){
                $tab = $install[$tabela.'_'.$campo]['tab'];
                if(!isset($fields[$seccao][$tab]))
                    $fields[$seccao][$tab] = Array($campo);
                else
                    array_push($fields[$seccao][$tab], $campo);
            }else{
               $fields[$seccao] = Array($campo);
            }
            
        else
            if($seccao==='tabs'){
                $tab = $install[$tabela.'_'.$campo]['tab'];
                if(!isset($fields[$seccao][$tab]))
                    $fields[$seccao][$tab] = Array($campo);
                else
                    array_push($fields[$seccao][$tab], $campo);
            }else{
                array_push($fields[$seccao], $campo);
            }
    }

?>
<script type="text/javascript">
	var free_submit = false;

    function save_data(){
            
            if(free_submit){

                    var url = $("#<?= $form ?>").attr('action');
                    var images = "";
                    $("#ul_files > li").each(function(){
                            images = images + escape($(this).attr('id') + ",");
                    });
                    
		    url = url + "?images=" + images;
		    $("#<?= $form ?>").attr('action', url);
                    
                    $("#<?= $form ?>").submit();
                    
/*                    $("#<?= $form ?>").ajaxSubmit({
                            type: "POST",
                            url: url + "?images=" + images,
                            success:
                                    function(msg){
                                            $("#<?= $form ?>").ajaxSubmit({
                                                url: url + "?reup=1"
                                            });
                                            var tmp = msg.split('}');
                                            var rsptext = tmp[0] + '}';
											//alert(rsptext);
                                            var data = eval("(" + rsptext + ")");
											
											window.location.href = "<?= BO_URL::obterHrefInterno("bo/home/index/$subseccao/$tabela") ?>";
                                            /*if(data.value==0)
                                                    $("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Dados editados com sucesso.<br  />" + data.message + "</p>");
                                            else
                                                    $("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Falha na edição dos dados.<br  />" + data.message + "</p>");
                                            $("#alert").dialog({
                                                    resizable: false,
                                                    position: 'center',
                                                    draggable: true,
                                                    closeOnEscape: false,
                                                    title: "Edição Terminada",
                                                    modal: true,
                                                    stack: true,
                                                    buttons:{ Ok: function() {
                                                                                    $(this).dialog('close');                                                                                    
                                                                                    window.location.href = "<?= BO_URL::obterHrefInterno("bo/home/index/$subseccao/$tabela") ?>";
                                                                            }
                                                                    },
                                                    close: function(){
                                                            $(this).dialog('destroy');
                                                            //window.location.href = "<?= BO_URL::obterHrefInterno("bo/home/index/$subseccao/$tabela") ?>";
                                                    }
                                            });*/



//                    return false;
            }

    }
	
    $(function(){
	
	if($("#tabs ul li").length>1){
		$("#tabs .tab_content").hide();
		$("#tabs .tab_content:first").show();
	}else{
		$("#tabs ul").hide();
	}
	
	$("#tabs ul li a").click(function(){
		var tab = $(this).attr('href');
		$("#tabs .tab_content:visible").hide();
		$("#tabs " + tab).show();
		return false;		
	});

/*        $("#<?= $form?>").submit(function(){
			save_data();
            return false;
        });*/
		
		$("a#save").click(function(){
			free_submit = true;
			save_data();
//			$("#<?= $form?>").submit();
		});
		
		$("#upload_imagens").ajaxMultiFileUpload({
			ajaxFile: path + '/plugins/bo/conteudo/scripts/upload.php',
			maxNumFiles: 99,
			uploadFolder: '<?= $conf['Awstats']['Conf'] ?>/uploads/imagens/<?= $tabela ?>/',
			thumbFolder:  '<?= $conf['Awstats']['Conf'] ?>/uploads/imagens/<?= $tabela ?>/'
			<?php if($item->imagens!=""): ?>,
			existentFiles: '<?= $item->imagens?>'
			<?php endif; ?>
		});
		
		$(".upload").uploadify({
		'uploader'       : path + '/plugins/bo/conteudo/scripts/scripts/uploadify.swf',
		'script'         : path + '/plugins/bo/conteudo/scripts/scripts/uploadify.php',
		'cancelImg'      : path + '/plugins/bo/conteudo/scripts/cancel.png',
		'folder'         : '<?= $conf['Awstats']['Conf'] ?>/uploads/imagens/<?= $tabela ?>',
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : false
		
		
	});
	
	$(".languages > a").click(function(){
		$("#idioma").val($(this).attr('id'));
		$(".languages a").css('background', 'none');
		$(this).css('background', '#00CCFF');
		$(this).css('padding', '5px');
		$(this).css('padding-bottom', '8px');
		return false;
	});
	
    });

    

    
</script>

<form id="<?= $form?>" name="<?= $form ?>" action="<?= BO_URL::obterHrefInterno("bo/conteudo/save/$tabela/$subseccao/$id")?>" method="POST" enctype="multipart/form-data">

    <div class="main">
        <?php
            $temp_fields = $fields['main'];
            foreach($temp_fields as $tf):
                echo $form_cont[$tf];
            endforeach;
        ?>
		
		<input style="display:none;" id="idioma" name="idioma" value="pt">
        <!--<input style="float:right;margin-top:-60px;margin-right:20px;width:80px;height:30px;" class="btn ui-state-default ui-corner-all" type='submit' value='Guardar' onclick="save_data()"/>-->
    </div>

    <div class="buttons">
        <a id="save" onclick="save_data()" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/save/$tabela/")?>" href="#" class="button tip newwindow" title="<?= 'Salvar'?>"><img src="<?= BO_URL::obterHrefInterno('estilos/images/save.png')?>" /></a>
        <a id="cancel"  href="<?= BO_URL::obterHrefInterno("bo/home/index/$subseccao/$tabela") ?>" class="button tip newwindow" title="<?= 'Cancelar'?>"><img src="<?= BO_URL::obterHrefInterno('estilos/images/cancel.png')?>" /></a>

		<?php if(count($linguas)>1): ?>
        <div class="languages">
            <?php foreach($linguas as $lingua): ?>
                <a style="<?= ($item->idioma==$lingua->cod)?"background:#00CCFF;padding:5px;padding-bottom:8px;":"";?>" id="<?= $lingua->cod ?>" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/".$lingua->nome."/$tabela/")?>" href="#" class="button tip newwindow" title="<?= $lingua->nome ?>"><img style="height:14px;" src="<?= BO_URL::obterHrefInterno("estilos/images/".$lingua->cod.".png")?>" /></a>
            <?php endforeach; ?>
        </div>
		<?php endif; ?>
    </div>
    <?php if(isset($fields['tabs'])): ?>
    <div class="tabs" id="tabs">
        <ul>
        <?php
            $temp_fields = $fields['tabs'];
            foreach($temp_fields as $tab => $tf):
        ?>
            <li><a href="#tab-<?= $tab?>"><?= ucwords(str_replace("_", " ", $tab))?></a></li>
        <?php endforeach; 
            if($imagens==true):
        ?>
            <li><a href="#tab-images"><?= "Imagens"?></a></li>
            <?php endif; ?>
        </ul>
            <?php
            $temp_fields = $fields['tabs'];
            foreach($temp_fields as $tab => $tf):
        ?>
        <div class="tab_content" id="tab-<?= $tab?>">
        <?php
            foreach($tf as $f):
                echo $form_cont[$f];
            endforeach;
        ?>
        </div>
        <?php if($imagens==true): ?>

        <div class="tab_content" id="tab-images" style="padding:50px;">
            <div id="upload_imagens" style="width:50%"></div>
			<div id="preview"></div>	
					
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
        

    <div class="aproval">

    </div>

    <div class="acess">

    </div>

    <div class="info">

    </div>

</form>