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