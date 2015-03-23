<?php
	$conf = $dados['conf'];

?>
<script type="text/javascript">
	$(function(){

		$("#filetree").fileTree({
			root: '<?= $conf['Caminho']['ServidorWeb']?>/uploads/',
			script: path + '/plugins/bo/conteudo/scripts/jqueryFileTree.php',
			expandSpeed: 1000,
			collapseSpeed: 1000,
			multiFolder: true 
		}, 
		function(file){
                        var aux = file.split("/");
                        aux.splice(1,1);
                        var filename = aux[aux.length-1];
                        var file_path = aux.join("/");
                        var filepath = "<?= BO_URL::obterHrefInterno("")?>" + file_path;
                        $("#alert").html("<p><span class='ui-icon ui-icon-circle-check' style='float:left; margin:0 7px 50px 0;'></span>Escolha a opção que pretende.</p>");
                        $("#alert").dialog({
						resizable: false,
						position: 'center',
						draggable: true,
						closeOnEscape: false,
						title: "O que pretende?",
						modal: true,
						stack: true,
						buttons:{ Abrir: function() {
                                                                    window.open(filepath, "Ficheiro: " + filename);
                                                                    $(this).dialog('close');
                                                                    $(this).dialog('destroy');
                                                                },
                                                           Eliminar: function(){
                                                                    $.post("<?= BO_URL::obterHrefInterno("bo/conteudo/delete_file/")?>", {ficheiro: file_path});
                                                                    $(this).dialog('close');
                                                                    $(this).dialog('destroy');
                                                                }
							},
						close: function(){
							$(this).dialog('destroy');
						}
					});
			//window.open(filepath, "Ficheiro: " + filename);
		});


                $("a#upload").click(function(){
                    $("#upload_file").focus();
                    $("#upload_file").change(function(){
                       $("#upload_file_form").ajaxSubmit();
                    });
                });
	});
</script>
<div class="list-options">
    <div class="list-option">
                    <a id="upload" alt="<?= BO_URL::obterHrefInterno("bo/conteudo/upload_file/")?>" href="#" class="tip newwindow" title="Adicionar Ficheiro"><img src="<?= BO_URL::obterHrefInterno('estilos/images/upload.png')?>" /></a>
    </div>
    
</div>
<div id="filetree" style="background: #F8F8FF;padding:10px;height:70%;overflow:scroll;border:1px solid #CCC;"></div>

<form style="display:none;" action="<?= BO_URL::obterHrefInterno("bo/conteudo/upload_file/") ?>" id="upload_file_form" method="POST">
    <input type="file" name="file" id="upload_file" />
</form>