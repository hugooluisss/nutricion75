<?php
global $objModulo;
switch($objModulo->getId()){
	case 'actividades':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from tipoactividad");
		$datos = array();
		while(!$rs->EOF){
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("actividades", $datos);
	break;
	case 'listaActividades':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select a.*, b.nombre as tipoActividad, b.color from actividad a join tipoactividad b using(idTipo)");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'listaTipoActividades':
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from tipoactividad");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'cactividades':
		switch($objModulo->getAction()){
			case 'add':
				$db = TBase::conectaDB();
				$obj = new TActividad();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setTipo($_POST['tipo']);
				$obj->setGrasas($_POST['grasas']);
				$obj->setProteinas($_POST['proteinas']);
				$obj->setCarbohidratos($_POST['carbohidratos']);

				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TActividad($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
		}
	break;

}
?>