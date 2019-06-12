<?php
$acao = $_GET["acao"];
$arquivo = $_GET["arquivo"];
if (!empty($acao))
{
	switch ($acao)
	{
		case 'excluir':
			unlink($arquivo);
			if (!file_exists($arquivo))
			{
				echo "Excluido com sucesso";
			}
			else
			{
				echo "O arquivo ainda existe";
			}
			break;
	}
}


?>