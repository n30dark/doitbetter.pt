function add_image(var1, var2){
	
	document.getElementById(var2).style.display = "block";
	var1.style.display = "none";
}

function verificarTamanho(var1, var2){
	
	var tamanho = var2;
	var conteudo = var1.value;
	var sizeof = conteudo.length;	
	if(sizeof>var2){
		var1.style.background = "#FF6666";
		var1.style.color = "#000000";
	}else{
		var1.style.background = "#FFFFFF";
		var1.style.color = "#666666";
	}
}

function verificarForca(var1){
	var pass = var1;
	var hasnum = false;
	if(var1.value.length<4){
		pass.style.background = "#FF6666";
	}else if(var1.value.length>=4 && var1.length<7){
		pass.style.background = "#FFCC33";
	}else if(var1.value.length>=7){
		for(var counter=0; counter<var1.value.length; counter++){
			if(!isNaN(var1.value.charAt(counter))){
				hasnum = true;
			}
		}
		if(hasnum){
			pass.style.background = "#007AA3";
		}else{
			pass.style.background = "#FFCC33";
		}
	}
}

