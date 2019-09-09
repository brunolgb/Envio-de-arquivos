<?php
$acao = $_GET["acao"];
$arquivo = $_GET["arquivo"];
$filename = "envios" . DIRECTORY_SEPARATOR . $arquivo;
if (!empty($acao))
{
	switch ($acao)
	{
		case 'excluir':
			if(unlink($filename))
			{
				echo "Excluido com sucesso";
			}
			else
			{
				echo "Arquivo não foi excluido";
			}
			break;
	}
}


?>