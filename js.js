function abrir (posicao)
{
	var el_escondido = document.querySelectorAll(".acao")[posicao];
	if (el_escondido.getAttribute("class") === "acao acao_display acao_opacity")
	{
		el_escondido.classList.toggle("acao_opacity");
		setTimeout(function (){
			el_escondido.classList.toggle("acao_display");
		}, 600);
	}
	else
	{
		el_escondido.classList.toggle("acao_display");
		setTimeout(function (){
			el_escondido.classList.toggle("acao_opacity");
		}, 300);
	}
}
function excluir (posicao)
{
	var el = document.querySelectorAll(".legenda_foto")[posicao];
	console.log(el);
	var nome = el.innerHTML;
	var requisicao = new XMLHttpRequest();
	requisicao.open("GET","acao.php?acao=excluir&arquivo="+nome,true);
	requisicao.send(null);
	requisicao.onreadystatechange = function(){
		var retorno = requisicao.responseText;
		if (retorno.length != 0)
		{
			if (retorno === "Excluido com sucesso")
			{
				window.location.replace("index.php");
			}
			else
			{
				alert(retorno);
			}
			
		}
	};
}
const heightScrenn = screen.height;
const widthScrenn = screen.width;
window.addEventListener("load", function(){
	document.querySelector("title").innerHTML += " - "+document.querySelector("[data-count_content]")["attributes"]["data-count_content"]["nodeValue"] + " Arquivos";
	
	if (heightScrenn < widthScrenn)
	{
		setInterval(function(){
			const element_count = document.querySelector("[data-count_content]");
			const value_element_count = element_count["attributes"]["data-count_content"]["nodeValue"];

			var requisicao = new XMLHttpRequest();
			requisicao.open("GET","refresh_content.php", true);
			requisicao.onreadystatechange = function(){
				var retorno = requisicao.responseText;
				if (value_element_count < retorno)
				{
					window.location.reload();
				}
			}
			requisicao.send();
		}, 500);
		
	}

});

const input_image = document.querySelector("#imagem");
input_image.addEventListener("change", function(){
	const label_input_image = document.querySelector(".label_input_image");
	if (input_image.value == "")
	{
		label_input_image.innerHTML = "Clique para selecionar o arquivo";
		label_input_image.classList.remove("selection_input");
	}
	else
	{
		label_input_image.innerHTML = "Arquivo selecionado";
		label_input_image.classList.add("selection_input");
	}
});
