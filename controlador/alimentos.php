<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaAlimentos':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from alimento");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'calimentos':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TAlimento();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setCarbohidratos($_POST['carbohidratos']);
				$obj->setProteinas($_POST['proteinas']);
				$obj->setGrasas($_POST['grasas']);
				$obj->setFibra($_POST['fibra']);

				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TAlimento($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
		}
	break;

}
?>