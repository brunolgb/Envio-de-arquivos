<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="estilo.css">
	<script src='js.js'></script>
	<title>Eventos</title>
</head>
<body>
	<div class="corpo">
		<h2 style="font-family: Sawasdee">Envio de arquivos</h2>
		<form method="post" enctype="multipart/form-data">
			<div class="controle_envio">
				<label for="imagem">Clique para selecionar o arquivo</label>
				<input type="file" name="arquivo" id="imagem">
				<input type="text" name="name" placeholder="Digite, caso deseje alterar o nome" title="Digite um novo nome, caso deseje alterar o original">
				<input type="submit" name="salvar" value="Salvar">
			</div>
		</form>
		
		<?php
		$diretorio = "envios";
		if (!is_dir($diretorio))
		{
			mkdir($diretorio,0777);
		}
		$dir_completo = $diretorio.DIRECTORY_SEPARATOR;

		//array contendo as extenções
		$extencao = array(
			"png",
			"jpeg",
			"jpg",
			"gif",
			"svg"
		);
		$ext_musica = array(
			"mp3"
		);
		$ext_video = array(
			"mp4",
			"mov"
		);


		if (isset($_POST["salvar"]))
		{
			//trbalhar a imagem
			if (!empty($_FILES["arquivo"]["name"]))
			{
				$temporario = $_FILES["arquivo"]["tmp_name"];
				$qtd_caracter = strlen($_FILES["arquivo"]["type"]);
				$extension_file = substr($_FILES["arquivo"]["type"],6,$qtd_caracter);
				if (empty($_POST["name"]))
				{
					$nome = $dir_completo . $_FILES["arquivo"]["name"];
				}
				else
				{
					$nome = $dir_completo . $_POST["name"].".".$extension_file;
				}

				move_uploaded_file($temporario, $nome);
				if (file_exists($nome))
				{
					echo "<span class='enviado'>enviado</span>";
				}
				
			}
		}
		?>
	
	<?php
	$conteudo_diretorio = scandir($diretorio);
	$posicao = 0;
	$count_content = count($conteudo_diretorio) - 2;
	echo "<span class='enviado' data-count_content='" . $count_content . "'>" . $count_content . " Arquivos na pasta</span>";
	echo "<hr>";
	foreach ($conteudo_diretorio as $conteudo)
	{
		if (!in_array($conteudo, array(".","..")))
		{
			echo "<div class='controle' onclick='abrir($posicao)'>";
				echo "<div class='acao'>";
					echo "<a href='".$dir_completo.$conteudo."' class='acao_btn baixar' target='_blank'>Baixar</a>";
					echo "<button class='acao_btn excluir' onclick='excluir($posicao)'>Excluir</button>";
				echo "</div>";
				$info = pathinfo($dir_completo.$conteudo);
				//var_dump($info);
				if (!in_array($info["extension"], $extencao))
				{
					if (in_array($info["extension"], $ext_musica))
					{
						echo "<img src='imagens_padrao".DIRECTORY_SEPARATOR."mp3.png' class='arquivo_sem_imagem'>";
					}
					elseif(in_array($info["extension"], $ext_video))
					{
						echo "<img src='imagens_padrao".DIRECTORY_SEPARATOR."mp4.png' class='arquivo_sem_imagem'>";
					}
					else
					{
						echo "<img src='imagens_padrao".DIRECTORY_SEPARATOR."padrao.png' class='arquivo_sem_imagem'>";
					}
				}
				else
				{
					//echo "<img src='".$dir_completo.$conteudo."' class='arquivo_com_imagem'>";
					echo "<img src='imagens_padrao".DIRECTORY_SEPARATOR."padrao.png' class='arquivo_sem_imagem'>";
					chmod($dir_completo.$conteudo, 0777);
				}
				echo "<hr>";
				echo "<span class='legenda_foto'>".$info["basename"]."</span>";
			
			echo "</div>";
			$posicao++;
		}
	}
	?>
	</div>
</body>
</html>