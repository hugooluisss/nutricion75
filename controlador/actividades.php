<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaActividades':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select a.* from actividad a where visible = 1");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'listaFrecuencias':
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from frecuencia");
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
				$obj->setGrasas($_POST['grasas']);
				$obj->setProteinas($_POST['proteinas']);
				$obj->setCarbohidratos($_POST['carbohidratos']);

				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TActividad($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'getData':
				$obj = new TActividad($_POST['id']);
				
				$data = array();
				$data['grasas'] = $obj->getGrasas();
				$data['proteinas'] = $obj->getProteinas();
				$data['carbohidratos'] = $obj->getCarbohidratos();
				
				echo json_encode($data);
			break;
		}
	break;

}
?>