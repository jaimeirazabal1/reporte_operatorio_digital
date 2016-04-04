<?php 
class EstadisticasController extends AppController{

	public function generales(){
		$this->titulo = 'Estadisticas Generales';
		$equipos =Load::model("equipo")->obtenerEquiposAsociadosAlUsuario(Auth::get('id'));
		$this->equipo = $equipos[0];
		$this->formularios = Load::model("formulario")->getByEquipoId($this->equipo->equipo_id);
		if (Input::post('btn_buscar')) {
			
		

			$formulario_id = Input::post("formulario_id");
			if (Input::post('desde') and Input::post("hasta")) {
				$query = " and DATE(creado)  BETWEEN '".Input::post('desde')." 00:00:00' AND '".Input::post("hasta")." 00:00:00'";
				//$query = " and creado > '".Input::post('desde')." 00:00:00' and creado < '".Input::post("hasta")." 00:00:00'";
			}else if(Input::post('desde') and !Input::post("hasta")){
				$query = " and creado > '".Input::post('desde')." 00:00:00'";
			}else if(!Input::post('desde') and Input::post("hasta")){
				$query = " and creado < '".Input::post("hasta")." 00:00:00'";
			}
			/*si no entra en ninguna de las condiciones previas de fecha*/
			$query = isset($query) ? $query : NULL;
			$this->resultado = Load::model("intervenciones")->find("conditions: formulario_id = '$formulario_id'".$query);
			$this->intervenciones_agrupadas = Load::model("intervenciones")->find("conditions: formulario_id = '$formulario_id'".$query." group by identificador");
			$this->cirujanos_principales = Load::model('intervenciones')->cirujano_principal($this->intervenciones_agrupadas);
			$this->intervenciones = count($this->intervenciones_agrupadas);

			
			$suma_de_horas = "00:00:00";
			foreach ($this->intervenciones_agrupadas as $key => $value) {
				$datos = unserialize($value->formulario);
				$suma_de_horas = Util::sumarHoras($suma_de_horas, $datos['tiempo']);
			}

			$this->record_operatorio = $suma_de_horas;
			//die("conditions: formulario_id = '$formulario_id'".$query);

		}

	}
	
}


 ?>