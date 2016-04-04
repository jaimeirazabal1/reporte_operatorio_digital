
<?php
$file="2016_03_25_12_05_53_HC-CTCV-Compl.docx";
//$file = $argv[1];
function word2pdf($file)
{ 
/*       $result = shell_exec('export HOME=/srv/www/htdocs/Creecimientos/sic/ && soffice --headless --convert-to pdf --outdir /srv/www/htdocs/Creecimientos/sic/ /srv/www/htdocs/Creecimientos/sic/app/webroot/usuarios/2/8_Pagare_CreePersonas.docx');*/
//$var=getcwd()."/";
$var= "/var/www/html/plataforma/files/upload/pdf/";
$source= "/var/www/html/plataforma/files/upload/plantillas/";
		$var= "/var/www/html/reporteoperatorio_digitalocean2/html/plataforma/files/upload/pdf/";
		//$source= "/var/www/html/plataforma/files/upload/plantillas/";
		$source= "/var/www/html/reporteoperatorio_digitalocean2/html/plataforma/files/upload/plantillas/";
echo "Imprimiendo resultado de ruta:";
echo $var.$file."\n"; 
$result = shell_exec('export HOME='.$source.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$source.$file);
echo '<br>export HOME='.$source.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$source.$file."<br>";
var_dump($result);
echo "\n";
}
word2pdf($file);
?>