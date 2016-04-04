<?php
$file="2016_03_25_12_05_53_HC-CTCV-Compl.docx";
$command = 'cd '.dirname(__FILE__).' && /usr/bin/libreoffice --headless --convert-to pdf '.$file;

/*$result = exec($command,$output,$return_var);
echo "<pre>";
echo $command."<br>";
var_dump($output);
var_dump($return_var);*/


function word2pdf($file)
{ 
/*       $result = shell_exec('export HOME=/srv/www/htdocs/Creecimientos/sic/ && soffice --headless --convert-to pdf --outdir /srv/www/htdocs/Creecimientos/sic/ /srv/www/htdocs/Creecimientos/sic/app/webroot/usuarios/2/8_Pagare_CreePersonas.docx');*/
$var='/home/jaime-ubuntu/Escritorio/html/doc_to_pdf_php/';
echo "Procesando<br>";
//echo 'export HOME='.$var.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$var.$file."<br>";   
$result = shell_exec('export HOME='.$var.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$var.$file);
var_dump($result);
}

word2pdf($file);
?>
