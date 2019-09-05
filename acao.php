<?php
$acao = $_GET["acao"];
$arquivo = $_GET["arquivo"];
if (!empty($acao))
{
	switch ($acao)
	{
		case 'excluir':
			if(unlink("envios/".$arquivo))
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