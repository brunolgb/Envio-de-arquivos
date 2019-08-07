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
	var el = document.querySelectorAll("#foto")[posicao];
	var nome = el.getAttribute("href");
	var requisicao = new XMLHttpRequest();
	requisicao.open("GET","acao.php?acao=excluir&arquivo="+nome,true);
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
	requisicao.send();
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
