/*
 *
 * @name		ajaxMultiFileUpload
 * @author		Kevin Crossman
 * @contact		kevincrossman@gmail.com
 * @version		2.1
 * @date			Oct 14 2008
 * @type    	 	jQuery
 *
*/
; (function($) {

    $.fn.extend({
        ajaxMultiFileUpload: function(options) { 
        	opt = $.extend({}, $.uploadSetUp.defaults, options);
            if (opt.file_types.match('jpg') && !opt.file_types.match('jpeg')) 
            	opt.file_types += ',jpeg';
            $this = $(this);
            new $.uploadSetUp();
        }
    });

    $.uploadSetUp = function() {
    	
    	$('body').append($('<div></div>').append($('<iframe src="about:blank" id="myFrame" name="myFrame"></iframe>')));
        $this.append($('<form target="myFrame" enctype="multipart/form-data" action="' + opt.ajaxFile + '" method="post" name="myUploadForm" id="myUploadForm"></form>')
            .append(
            $('<input type="hidden" name="thumb" value="' + opt.thumbFolder + '" />'),
            $('<input type="hidden" name="upload" value="' + opt.uploadFolder + '" />'),
            $('<input type="hidden" name="mode" value="' + opt.mode + '" />'),
            $('<div class="btn ui-state-default ui-corner-all select" title="upload new picture" value="Carregar Imagem">Carregar Imagem</div>').append($('&nbsp;Carregar Imagem<input id="myUploadFile" class="myUploadFile file" type="file" value="" name="file1" size="1"/>')), 
            $('<h2 class="numFiles"></h2>'),
            $('<ul id="ul_files"></ul>')), 
			$('<div class="responseMsg"><br />(nota: todas as imagens serão renomeadas por questões de segurança. É necessário guardar após alterações nas imagens.)<br /></div><ul id="response"></ul>'));
    	
    	var files =  opt.existentFiles.split(",");
		var i = 0;
		var iMax = files.length;
		var aux = opt.uploadFolder.split("/");
		var tabela = aux[aux.length-2];
		if(files[0]!=""){
			for(i=0; i<iMax; i++){
				
				 var _img = new Image(),
                 
                 $delete = $('<div id="' + files[i] + '" class="delete" title="delete file"></div>');
				 /**$edit = $('<div id="' + pst.img.rename + '" class="edit" title="Editar"></div>');*/
                 // add remove icon
                 $new = $('<div class="fileInfo"></div>').append($delete);
                 // add info wrapper	
                 $name = $('<div class="nameOfFile">' + files[i] + '</div>'); // add name of file							
                 // store names for ajax delete
                 $delete[0]._name = files[i];
                 $delete[0]._rename = files[i];
                 //$edit[0]._name = pst.img.name;
                 //$edit[0]._rename = pst.img.rename;
                
                // setup image
                 $(_img)
                 	.attr({ src: path + "/uploads/imagens/" + tabela + "/" + files[i], alt: files[i], width: 92, height: 60, title: files[i] })
                 	.addClass('uploaded')
                 	.addClass('tip');
                 
                 // display thumbname and info	
                 $("UL#ul_files").append($('<LI class="image_file" id="' + files[i] +'"></LI>').append($new.prepend($(_img))));
			}
		}
		    	
        init();
    };

    $.uploadSetUp.defaults = {
        // image types allowed
        file_types: "jpg,gif,png",
        // php script
        ajaxFile: "upload.php",
        // maximum number of files allowed to upload
        maxNumFiles: 3,
        //files already on database
		existentFiles: "",
        // if set to "demo", files are automatically deleted from server
        mode: "",
        // absolute path for upload pictures folder (don't forget to chmod)
        uploadFolder: "/ajaxMultiFileUpload/upload/",
        // absolute path for thumbnail folder (don't forget to chmod)
        thumbFolder: "/ajaxMultiFileUpload/thumb/"
        
    };

    function init() {

        // if file type is allowed, submit form
        $('#myUploadFile').livequery('change', function() { 
        	if (checkFileType(this.value)) 
        		$('#myUploadForm').submit(); 
        });
        // execute event.submit when form is submitted
        $('#myUploadForm').submit(function() { 
        	return event.submit(this); 
        });
        // delete uploaded file
        $(".delete").livequery('click', function() {
            // avoid duplicate function call
            $(this).unbind('click');
            // determine how to delete based on demo mode
            (opt.mode == "demo") ? _demoDelete($(this)) : _delete($(this));
        });
        
        /**$(".edit").livequery('click', function(){
        	$(this).unbind('click');
        	_edit($(this));
        });*/

        // function to handle form submission using iframe
        var event = {
            // setup iframe
            frame: function(_form) {
                $("#myFrame")
                	.empty()
                	.one('load',  function() { event.loaded(this, _form) });
            },
            // call event.submit after submit
            submit: function(_form) {
                $('.select').addClass('waiting');
                event.frame(_form);
            },
            // display results from submit after loades into iframe
            loaded: function(id, _form) {
                var d = frametype(id),
                data = d.body.innerHTML.replace(/^\s+|\s+$/g, '');
                //aux = data.split("var");
                //data = "var" + aux[1];
                //alert(data);
                eval(data);
                $('.select.waiting').removeClass('waiting');
                $('.select').removeClass('btn');
                $('.select').addClass('btn');
                
                
                // if no problem reported from submit
                if (typeof pst === 'undefined') {
                    
                    var problem = '<P>Houve um problema durante o upload</P>';
                    if (data.length) problem += '<LI><SPAN>A resposta do servidor foi</SPAN> ' + data + '</LI>';
                    else problem += '<LI>Não houve resposta do servidor .</LI>';
                    //$('UL#response').append(problem);
                    $('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>" + problem + "</p>");
                    $("#alert").dialog({
            			resizable: false,
            			position: 'center',
            			draggable: true,
            			closeOnEscape: false,
            			title: "ERRO!!!",
            			modal: true,
            			stack: true,
            			buttons:{ Ok: function() {
            							$(this).dialog('close');
            						}
            					},
            			close: function(){
            				$(this).dialog('destroy');
            			}
            		});
                } 
                else if (!pst.problem) {
                    
                    var _img = new Image(),
                    
                    $delete = $('<div id="' + pst.img.rename + '" class="delete" title="Eliminar"></div>');
                    /**$edit = $('<div id="' + pst.img.rename + '" class="edit" title="Editar"></div>');*/
                    // add remove and edit icons
                    $new = $('<div class="fileInfo"></div>').append($delete);//.append($edit);
                    // add info wrapper	
                    $name = $('<div class="nameOfFile">' + pst.img.name + '</div>'); // add name of file							
                    // store names for ajax delete
                    $delete[0]._name = pst.img.name;
                    $delete[0]._rename = pst.img.rename;
                    //$edit[0]._name = pst.img.name;
                    //$edit[0]._rename = pst.img.rename;
                   
                   // setup image
                    $(_img)
                    	.attr({ src: pst.img.src, alt: pst.img.alt, width: 92, height: 60, title: pst.img.name })
                    	.addClass('uploaded')
                    	.addClass('tip');
                    
                    // display thumbname and info	
                    $("UL#ul_files").append($('<LI class="image_file" id="' + pst.img.rename +'"></LI>').append($new.prepend($(_img))));
                    
                    // display file info in ajax response section
                    //$('UL#response').append('<LI>File <SPAN>' + pst.img.name + '</SPAN> uploaded.</LI>');
                    $('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><LI>Ficheiro <SPAN>" + pst.img.name + "</SPAN> Carregado.</LI></p>");
                    $("#alert").dialog({
            			resizable: false,
            			position: 'center',
            			draggable: true,
            			closeOnEscape: false,
            			title: "Ficheiro Adicionado",
            			modal: true,
            			stack: true,
            			buttons:{ Ok: function() {
            							$(this).dialog('close');
            						}
            					},
            			close: function(){
            				$(this).dialog('destroy');
            			}
            		});
                    //	automatically delete files from server when in demo mode
                    if (opt.mode == "demo") {
                    	var t = setTimeout(
                    		function() {
                        		$.post(opt.ajaxFile, { deleteFile: pst.img.rename, origName: pst.img.name, upload: opt.uploadFolder,  thumb: opt.thumbFolder, mode: opt.mode}) 
                        	}, 4000);
                    }
                    // update file counter
                    updateCount();
                } 
                else {
                
                    var problem = '<P>There was a problem uploading <SPAN>' + pst.problem.name + '</SPAN></P>';
					if (pst.problem.error) problem += '<LI>' +pst.problem.error + '</LI>';
                    if (pst.problem.ext) problem += '<LI class="ext">Extensão do ficheiro <SPAN>' + pst.problem.ext_actual + '</SPAN> não corresponde ao ficheiro <SPAN>' + pst.problem.ext + '</SPAN>.</LI>';
                    //$('UL#response').append(problem);
                    $('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>" + problem + "</p>");
                    $("#alert").dialog({
            			resizable: false,
            			position: 'center',
            			draggable: true,
            			closeOnEscape: false,
            			title: "ERRO!!!",
            			modal: true,
            			stack: true,
            			buttons:{ Ok: function() {
            							$(this).dialog('close');
            						}
            					},
            			close: function(){
            				$(this).dialog('destroy');
            			}
            		});
                }
            }
        };
        // delete during demo mode
        function _demoDelete(toDelete) {
            toDelete
            	.parents('LI')
            	.fadeOut(1000, function() {
                	$(this).remove();
               		//$('UL#response').append('<LI>File <SPAN>' + toDelete[0]._name + '</SPAN> deleted. </LI>');
                	$('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><LI>Ficheiro <SPAN>" + toDelete[0]._name + "</SPAN> eliminado. </LI></p>");
                	$("#alert").dialog({
            			resizable: false,
            			position: 'center',
            			draggable: true,
            			closeOnEscape: false,
            			title: "Ficheiro Eliminado",
            			modal: true,
            			stack: true,
            			buttons:{ Ok: function() {
            							$(this).dialog('close');
            						}
            					},
            			close: function(){
            				$(this).dialog('destroy');
            			}
            		});
                	updateCount();
            	});
        };
        // normal delete
        function _delete(toDelete) {
            $.post(opt.ajaxFile, { deleteFile: toDelete[0]._rename, origName: toDelete[0]._name, upload: opt.uploadFolder, thumb: opt.uploadFolder, mode: opt.mode },
            	function(returned) {
            		//$('UL#response').append('<li>' + returned.replace(/^\s+|\s+$/g, '') + '</li>');
            	$('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span><li>" + returned.replace(/^\s+|\s+$/g, '') + "</li></p>");
            	$("#alert").dialog({
        			resizable: false,
        			position: 'center',
        			draggable: true,
        			closeOnEscape: false,
        			title: "Atenção!!!",
        			modal: true,
        			stack: true,
        			buttons:{ Ok: function() {
        							$(this).dialog('close');
        						}
        					},
        			close: function(){
        				$(this).dialog('destroy');
        			}
        		});
               	 	toDelete
                		.parents('LI')
                		.fadeOut(1000, function(){ $(this).remove(); updateCount() });
            	});
        };
        
        //edit
        /**function _edit(toEdit) {
            $.post(opt.ajaxFile, { editFile: toEdit[0]._rename, origName: toEdit[0]._name, upload: opt.uploadFolder, thumb: opt.thumbFolder, mode: opt.mode },  
            	function(returned) {
            		//$('UL#response').append('<li>' + returned.replace(/^\s+|\s+$/g, '') + '</li>');
            		var img = toEdit[0]._rename;
            		alert(img);
            		var aux = opt.uploadFolder.split('/');
            		var folder = "/";
            		var i = 1;
            		for(i=1; i<aux.length; i++){
            			folder = folder + aux[i] + "/";
            		}
            		var imagem = path + folder + img;
            		alert(imagem);
            		$("img#cropbox").attr('src', imagem);
            	});
        };*/
        
        // update the file counter
        function updateCount() {
            var numUploads = $("UL#ul_files").children('LI').size(),
            limit = (numUploads == opt.maxNumFiles) ? " atingido.": " permitido.";
            $("H2.numFiles").text(numUploads + " Ficheiro(s) Carregados . . . Máximo de  " + opt.maxNumFiles + limit);
            $('.select').css({ opacity: (numUploads == opt.maxNumFiles) ? 0 : 1 });
        };
        // check if file extension is allowed
        function checkFileType(file_) {
            var ext_ = file_.toLowerCase().substr(file_.toLowerCase().lastIndexOf('.') + 1);
            if (!opt.file_types.match(ext_)) {
            	$('#alert').html("<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Extensão " + ext_ + " não é permitida.</p>");
                $("#alert").dialog({
        			resizable: false,
        			position: 'center',
        			draggable: true,
        			closeOnEscape: false,
        			title: "Atenção!!!",
        			modal: true,
        			stack: true,
        			buttons:{ Ok: function() {
        							$(this).dialog('close');
        						}
        					},
        			close: function(){
        				$(this).dialog('destroy');
        			}
        		});
                return false;
            } 
            else return true;
        };
        // check type of iframe
        function frametype(fid) {
            return (fid.contentDocument) ? fid.contentDocument: (fid.contentWindow) ? fid.contentWindow.document: window.frames[fid].document;
        };

        updateCount();
    }

})(jQuery);