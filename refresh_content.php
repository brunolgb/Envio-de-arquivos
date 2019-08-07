<?php
$conteudo_diretorio = scandir("envios");
$count_content = count($conteudo_diretorio) - 2;
echo $count_content;
?>