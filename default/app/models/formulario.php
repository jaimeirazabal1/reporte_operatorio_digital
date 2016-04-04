<?php 
class Formulario extends ActiveRecord{
	public function getByEquipoId($equipo_id){
		$query = "SELECT formulario.* from formulario_plantilla 
					inner join formulario on formulario_plantilla.formulario_id = formulario.id 
					where formulario_plantilla.equipo_id = '$equipo_id' group by formulario.nombre";

		//die($query);	
		return $this->find_all_by_sql($query);
	}
}


 ?>