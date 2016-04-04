<?php 
class Intervenciones extends ActiveRecord{
	public function getRegistrosByEquipoId($equipo_id){
		$r = $this->find();
		if ($r) {
			# code...
			$identificador = $r[0]->identificador;
			$identificadores = array();
			$registros=0;

			foreach ($r as $key => $value) {
				$equipos_pertenece = explode(',',$value->equipos_pertenece);
				

				if (!in_array($identificador, $identificadores) and in_array($equipo_id, $equipos_pertenece)) {
					$identificador=$value->identificador;
					$identificadores[]=$identificador;
					$registros++;
				}else{
					$identificador=$value->identificador;
				}	
			
			}
			return $registros;
		}else{
			return NULL;
		}
	}
	public function getByPath($path){
		$r = $this->find("conditions: url_pdf like '%$path'");
		return isset($r[0]) ? $r[0] : NULL;
	}
	public function usuarioHizoIntervencion($usuario_id,$path){
		$r = $this->getByPath($path);
		return (int)$r->usuario_id == (int)$usuario_id;
	}

	public function usuarioPerteneceEquipoIntervencion($path, $usuario_id){
		$r = $this->getByPath($path);
		/*
		CONDICIONES:
		1.usuario que hizo no tiene equipo.
		2.usuario que entra no tiene equipo.
		*/
		$equipos_usuario_que_hizo = Load::model('usuario_equipo')->find("conditions: usuario_id = '".$r->usuario_id."'");
		$equipos_usuario_ingresa = Load::model('usuario_equipo')->find("conditions: usuario_id = '".$usuario_id."'");
		if (empty($equipos_usuario_que_hizo) or empty($equipos_usuario_ingresa)) {
			return false;
		}
		$array_equipos_usuario_que_hizo=array();
		foreach ($equipos_usuario_que_hizo as $key => $value) {
			$array_equipos_usuario_que_hizo[] = $value->equipo_id;
		}
		$array_equipos_usuario_ingresa=array();

		foreach ($equipos_usuario_ingresa as $key => $value) {
			$array_equipos_usuario_ingresa[] = $value->equipo_id;
		}
		
		$result = array_intersect($array_equipos_usuario_que_hizo, $array_equipos_usuario_ingresa);
		if (empty($result)) {
			return false;
		}else{
			return true;
		}
	}
	/*
	obtiene los cirujanos principales con el numero de intervenciones hechas;
	esta funcion recibe las intervenciones agrupadas por identificador para eliminar repeticiones
	return array('cirujano'=>numero de intervenciones)
	*/
	public function cirujano_principal($intervenciones){
		$cirujanos_principales = array();
		$contador = 0;
		foreach ($intervenciones as $key => $value) {
			Util::p($cirujanos_principales);
			$datos = unserialize($value->formulario);
			$cirujano_principal = $datos['cirujano1'];
			/*si existe en la lista de cirujanos principales entonces se le suma uno a la intervencion*/
			if (isset($cirujanos_principales[$cirujano_principal])) {
				$cirujanos_principales[$cirujano_principal]['intervenciones'] = (int)$cirujanos_principales[$cirujano_principal]['intervenciones'] + 1;
				/*suma los tiempos de las intervenciones*/
				$tiempo_que_lleva = $cirujanos_principales[$cirujano_principal]['record'];
				$cirujanos_principales[$cirujano_principal]['record'] = Util::sumarHoras($tiempo_que_lleva,$datos['tiempo']);
				//die(var_dump($contador));
				
			}else{
				/*si se esta agregando como cirujano principal por primera vez se le coloca la primera intervencion*/
				$cirujanos_principales[$cirujano_principal]['intervenciones'] = 1;
				$cirujanos_principales[$cirujano_principal]['record'] = $datos['tiempo'];
			}
			$contador++;
		}
		return $cirujanos_principales;
	}
	//$file="2016_03_25_12_05_53_HC-CTCV-Compl.docx";
	
	public function word2pdf($file){ 
		
		$var= "/var/www/html/reporteoperatorio_digitalocean2/html/plataforma/files/upload/pdf/";
		//$source= "/var/www/html/plataforma/files/upload/plantillas/";
		$source= "/var/www/html/reporteoperatorio_digitalocean2/html/plataforma/files/upload/plantillas/";

		//var_dump(file_exists($source.$file));
		echo "Imprimiendo resultado de ruta:";
		echo $source.$file."\n"; 
		$result = shell_exec('export HOME='.$source.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$source.$file);
		//exec('export HOME='.$source.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$source.$file,$result,$entero);
		echo "<br>";
		echo 'export HOME='.$source.' && soffice --headless --convert-to pdf --outdir '.$var.' '.$source.$file;
		echo "<br>";
		var_dump($result);
		/*echo "<br>";
		var_dump($entero);*/
		if (strpos($result, "convert")) {
			return true;
		}else{
			return false;
		}
		/*var_dump($result);
		echo "\n";*/
	}
}


 ?>