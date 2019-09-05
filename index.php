<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="estilo.css">
	<title>Eventos</title>
</head>
<body>
	<div class="corpo">
		<h2 style="font-family: Sawasdee">Envio de arquivos</h2>
		<form method="post" enctype="multipart/form-data">
			<div class="controle_envio">
				<label for="imagem" class="label_input_image" onmouse>Clique para selecionar o arquivo</label>
				<input type="hidden" name='MAX_FILE_SIZE' value='300000000'>
				<input type="file" name="arquivo[]" id="imagem" multiple='multiple'>
				<input type="text" name="name" placeholder="Digite, caso deseje alterar o nome" title="Digite um novo nome, caso deseje alterar o original" list="list_content_dir">
				<datalist style="display: none" id="list_content_dir">
					<?php
					$conteudo_diretorio = scandir("envios");
					foreach ($conteudo_diretorio as $content)
					{
						if (!in_array($content, array(".","..")))
						{
							echo "<option value='$content'></option>";
						}
					}
					?>
				</datalist>
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

		$extensao_file = array(
			"ation/pdf" => ".pdf",
			"image/png" => ".png",
			"image/jpeg" => ".jpeg",
			"image/jpg" => ".jpg",
			"image/gif" => ".gif",
			"application/vnd.oasis.opendocument.text" => ".odt",
			"application/vnd.oasis.opendocument.spreadsheet" => ".ods",
			"image/svg+xml" => ".svg",
			"application/x-blender" => ".blend"
		);

		function envio($temp,$nome)
		{
			$diretorio = "envios" . DIRECTORY_SEPARATOR;
			move_uploaded_file($temp, $diretorio . $nome);
			if(is_uploaded_file($temp))
			{
				return "<span class='enviado'>enviado</span>";;
			}
			if (file_exists($diretorio . $nome))
			{
				// return true;
				// return "<span class='enviado'>enviado</span>";
			}	
		}

		if (isset($_POST["salvar"]))
		{
			define("nomes",$_FILES["arquivo"]["name"]);
			define("temporarios",$_FILES["arquivo"]["tmp_name"]);
			define("tipos",$_FILES["arquivo"]["type"]);
			
			for ($i=0; $i < count($_FILES["arquivo"]["name"]); $i++)
			{
				$nome = $_POST["name"].$extensao_file[tipos[$i]];

				if(empty($_POST["name"]))
				{
					echo envio(temporarios[$i],nomes[$i]);
				}
				else
				{
					echo envio(temporarios[$i],$nome);
				}

			}
		}
		?>
	
	<?php
	$conteudo_diretorio = scandir($diretorio);
	$posicao = 0;
	$count_content = count($conteudo_diretorio) - 2;
	echo "<span data-count_content='" . $count_content . "'>" . $count_content . " Arquivos na pasta</span>";
	echo "<hr>";
	echo "<div class='control_box_files'>";
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
					echo "<img src='".$dir_completo.$conteudo."' class='arquivo_com_imagem'>";
					// echo "<img src='imagens_padrao".DIRECTORY_SEPARATOR."padrao.png' class='arquivo_sem_imagem'>";
					chmod($dir_completo.$conteudo, 0777);
				}
				echo "<hr>";
				echo "<span class='legenda_foto'>".$info["basename"]."</span>";
			
			echo "</div>";
			$posicao++;
		}
	}
	echo "</div>";
	?>
	</div>
	<script src='js.js'></script>
</body>
</html>