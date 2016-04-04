<?php 
class IntervencionesController extends AppController{
	public function index(){
		$this->titulo = 'Lista de Intervenciones';

	}
	public function busqueda(){
		$this->titulo = "Busqueda";

		if (Input::post('busqueda')) {
			$formulario_id = Input::post("formulario_id");
			if (Input::post('desde') and Input::post("hasta")) {
				$query = " and DATE(creado)  BETWEEN '".Input::post('desde')." 00:00:00' AND '".Input::post("hasta")." 00:00:00'";
				//$query = " and creado > '".Input::post('desde')." 00:00:00' and creado < '".Input::post("hasta")." 00:00:00'";
			}else if(Input::post('desde') and !Input::post("hasta")){
				$query = " and creado > '".Input::post('desde')." 00:00:00'";
			}else if(!Input::post('desde') and Input::post("hasta")){
				$query = " and creado < '".Input::post("hasta")." 00:00:00'";
			}
			$sub = array(' 1=1 ');
			if (Input::post('nombre')) {
				$sub[] = " formulario like '%".Input::post('nombre')."%' ";
			}
			if (Input::post('hc')) {
				$sub[] = " formulario like '".Input::post('hc')."' ";
			}
			if (Input::post('operacion')) {
				$sub[] = " formulario like '%".Input::post('operacion')."%' ";
			}
			/*por si acaso no entra en las condiciones de arriba*/
			$query = isset($query) ? $query : NULL;
			$query = " select * from intervenciones where exists (SELECT * from intervenciones where formulario_id = '$formulario_id' $query) and ".implode(" and ",$sub);
			Util::p($query);
			$this->intervenciones = Load::model('intervenciones')->find_all_by_sql($query);
		}

		$equipos =Load::model("equipo")->obtenerEquiposAsociadosAlUsuario(Auth::get('id'));
		$this->equipo = $equipos[0];
		$this->formularios = Load::model("formulario")->getByEquipoId($this->equipo->equipo_id);
	}
	public function lista(){
		$rol = Load::model("usuario")->getRol();
		$this->titulo =  "Lista de Intervenciones";
		if ((int)$rol >= 1  and  (int)$rol <= 5) {
			/*$this->intervenciones = Load::model("intervenciones")->find("join: inner join usuario on usuario.id = intervenciones.usuario_id",
		 																"columns: intervenciones.*, usuario.usuario");*/
		// }else{
			/*
			OBTENER INTERVENCIONES DE EQUIPO
			Intervenciones::usuarioPerteneceEquipoIntervencion($path,$usuario_id)
			*/
			/*la logica del sistema cambio. ahora el usuario solo podra tener un equipo. pero esta funciona era
			para cuando el usuario pueda tener varios equipos. la usare pero solo tomando el primer elemento del array que 
			ahora sera el unico*/
			$equipos =Load::model("equipo")->obtenerEquiposAsociadosAlUsuario(Auth::get('id'));
			$this->equipo = $equipos[0];
			$this->formularios = Load::model("formulario")->getByEquipoId($this->equipo->equipo_id);
			if (isset($_GET['formulario_id'])) {
			
				// $intervenciones = Load::model("intervenciones")->find("conditions: formulario_id = '".$_GET['formulario_id']."'");
				// $intervenciones_=array();
				
				// foreach ($intervenciones as $key => $value) {
				// 	/*nombre del documento de la intervencion*/
				// 	$nombre= Util::verNombreArchivoPdf($value->url_pdf);
				// 	son las intervenciones que le pertenecen a su equipo
				// 	if ($nombre) {
				// 		if (Auth::get('id') == $value->usuario_id) {
				// 			$intervenciones_[] = $value;
				// 		}else{

				// 			if (Load::model('intervenciones')->usuarioPerteneceEquipoIntervencion($nombre, Auth::get('id'))) {
				// 				$intervenciones_[] = $value;
				// 			}
				// 		}
				// 	}
				// }
				$this->intervenciones=Load::model("intervenciones")->find("conditions: formulario_id = '".$_GET['formulario_id']."'");
			}
		}else{
			Flash::error("No tienes suficientes permisos para ver este contenido!");
			Router::redirect("index/index");
		}
	}
	public function nuevo(){
		$this->titulo = 'Agregar Intervencion';
		$q = "SELECT 
				formulario.nombre as nombre_formulario,
				formulario.id as id_formulario
			  FROM 
			  formulario_plantilla 
			  INNER JOIN plantilla on formulario_plantilla.plantilla_id = plantilla.id
			  INNER JOIN formulario on formulario_plantilla.formulario_id = formulario.id
			  INNER JOIN usuario_equipo on usuario_equipo.usuario_id = '".Auth::get('id')."'
			  INNER JOIN equipo on formulario_plantilla.equipo_id = usuario_equipo.equipo_id
			  where usuario_equipo.activo ='1' 
			  group by nombre_formulario";

		$this->formularios_disponibles = Load::model('formulario_plantilla')->find_all_by_sql($q);
	}
 	public function crear($formulario_id){
 		$this->titulo = "Crear Reporte";
 		$formulario = Load::model('formulario')->find($formulario_id);
 		$this->campos = unserialize($formulario->campos);
 		$this->nombre = $formulario->nombre;
 		$this->formulario = $formulario_id;
 		if (Input::post("adherir")) {
 			$nombre = Input::post("adherir");
 			$nombre = str_replace("Generar reporte con: ", "", $nombre);
 			$nombre = str_replace(" ", "_", $nombre);
 			
 			$url = $_POST[$nombre];
 			$identificador = md5(date('Y-m-d_H:i:s'));
 			$_POST['identificador'] = $identificador;
 			//Util::p($_POST);die;
 			/*
 				TODO
				1-verificar si el equipo esta pausado,
				2-verificar si tiene creditos,
				3-verificar si la api tiene creditos, mandar un correo a americo (listo)

 			*/
			$api = Load::model('codigo_api');
			if (!Load::model('equipo')->estaPausadoSuEquipo(Auth::get('id'))) {
					
				if ($api->quedanCreditos()) {

		 			foreach ($_POST['fields'] as $key => $value) {
		 				/*borre que guarde registros de la cantidad de veces que aparece un integrante de un equipo*/
		 				for ($i=0; $i < count($this->campos_autocomplete_usuarios_mismo_equipo) ; $i++) { 
		 					
		 					if (strpos($key, $this->campos_autocomplete_usuarios_mismo_equipo[$i]) !== false) {
		 						if (!empty($value)) {
									$pos_ini = strpos($value,'(');
			 						$pos_fin = strpos($value,')');
			 						$id = substr($value,$pos_ini+1,$pos_fin-1);
			 						$equipos = Load::model('equipo')->obtenerEquiposAsociadosAlUsuario($id);
			 						$equipos_= array();
			 						foreach ($equipos as $key_equipos => $value_equipos) {
			 							$equipos_[]=$value_equipos->equipo_id;
			 						}
			 						if ($id and $id != 0) {
				 						$Intervencion = array(
				 							'id'=>isset($_POST['fields']['id']) ? $_POST['fields']['id'] : NULL,
				 							'usuario_id' => $id,
				 							'formulario' => serialize($_POST['fields']),
				 							'identificador' => $identificador,
				 							'equipos_pertenece'=> implode(",",$equipos_),
				 							'plantilla_nombre' => Input::post("adherir"),
				 							'formulario_id' => Input::post('formulario'),
				 							'creado' => $_POST['fields']['creado']
				 						);
				 						
				 						//$nombres_apellidos = Load::model("usuario")->getNombresYApellidosById($id);

				 						$inter = Load::model("intervenciones",$Intervencion);

				 						if (!$inter->save()) {
				 							
				 							Flash::error("Ocurrio un error sumando la intervencion al usuario ".$nombres_apellidos);
				 						}else{
				 							$this->id = $inter->lastId();
				 							/*$to = "jaimeirazabal1@gmail.com";
				 							$suject = "Prueba cuando se crea reporte";
				 							$message = "Esto es una prueba para cuando se crean reportes";
				 							$to, $nombreUsuario, $departamento, $institucion, $usuario_registro, $enlace_a_pdf
				 							$mail = Mail::avisoNuevoReporte2($to,"Nombre de usuario","Departamento tal", "Institucion tal"," Usuario registro tal","Enlace tal");*/
				 							
				 						}
			 						}
		 						}
		 					}
		 					break;
		 				}
		 				
		 			}
		 			
		 			// foreach ($_POST['fields'] as $key => $value) {
		 			
		 			//include_once(APP_PATH.'libs/opentbs/demo/demo_ms_word.php');
		 			$trozos_nombre_plantilla = explode(":",Input::post("adherir"));
		 			$nombre_plantilla = trim($trozos_nombre_plantilla[1]);
		 			$archivo_plantilla = Load::model("plantilla")->getArchivoByNombrePlantilla($nombre_plantilla);

		 			if(Load::model("intervenciones")->word2pdf($archivo_plantilla)){
		 				
						$equipos = Load::model("usuario_equipo")->find("conditions: usuario_equipo.usuario_id='".Auth::get("id")."'","join: inner join equipo on equipo.id = usuario_equipo.equipo_id","columns: usuario_equipo.*, equipo.nombres_abreviado");
						$equipo = $equipos[0];
						$nombre_abreviado = str_replace(" ", "_", $equipo->nombres_abreviado);
						$fecha_hora = date("Y_m_s_H_i_s_");
						$historia = $_POST['fields']['hc'];
						
						$nombre=str_replace(" ", "_", $nombre_abreviado."-".$fecha_hora."-".$historia);
						
						//var_dump($output_file_name);

						//$url = Load::model('plantilla')->pasarAPdf($output_file_name,date('Y_m_d_H_i_s').'_exito');
						//var_dump(is_writable("/var/www/html/plataforma/files/upload/plantillas/"));
						//$url = Load::model('plantilla')->pasarAPdf($output_file_name,$nombre);
						//$url = "http://".$_SERVER['SERVER_NAME'].$url;
						$url = PUBLIC_PATH."archivos/get_".$nombre.".pdf";

						$intervenciones = Load::model("intervenciones")->find("conditions: identificador='".$_POST['identificador']."' ");
						foreach ($intervenciones as $key => $value) {
							if ($value->url_pdf) {
								$url_new = unserialize($value->url_pdf);
								$url_new[] = $url;
								$value->url_pdf=serialize($url_new);
								$value->update();
							}else{

								$value->url_pdf=serialize(array($url));
								$value->update();
							}
						}
						$to = Auth::get("email");
						$dep = Auth::get("departamento");
						$inst = Auth::get("institucion");
						$user = Auth::get("usuario");
						$mail = Mail::avisoNuevoReporte2($to,$user,$dep, $inst, $user,$url);
						/*esto es una copia*/
						$mail = Mail::avisoNuevoReporte2("jaimeirazabal1@gmail.com",$user,$dep, $inst, $user,$url);

						foreach ($equipos as $key => $value) {
							$equipo = Load::model("equipo")->find($value->equipo_id);
							$usuario = Load::model("usuario")->find($equipo->usuario_id);
							if(!Mail::avisoNuevoReporte2($usuario->email,$usuario->usuario, $usuario->departamento , $usuario->institucion, $user,$url)){
								Flash::error("Error mandando correo a $usuario->usuario y correo $usuario->email");
							}
						}

		 				$api->restarCredito();

		 				$link = "<script>window.open('".$url."')</script>";


						echo $link;
		 			}else{
		 				Flash::error("No se pudo convertir el PDF");
		 			}
		 			// }
					//Load::lib('opentbs/demo/demo_ms_word');
				}else{
					Flash::error("Contacte con el administrador del sistema, es imposible generar reportes ahora Error:".__LINE__);
				}
			}else{
				Flash::error("Tu equipo esta pausado, no puedes imprimir reportes");
			}
 		}
 	}

}


 ?>