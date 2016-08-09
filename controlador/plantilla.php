<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaAlimentosPlantilla':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from plantilla a join alimento b using(idAlimento)");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'cplantilla':
		switch($objModulo->getAction()){
			case 'add':
				$obj = new TPlantilla();

				echo json_encode(array("band" => $obj->agregar($_POST['alimento'], $_POST['cantidad'])));
			break;
			case 'del':
				$obj = new TPlantilla();
				echo json_encode(array("band" => $obj->eliminar($_POST['alimento'])));
			break;
			case 'getAlimentos':
				$db = TBase::conectaDB();
				$rs = $db->Execute("select * from alimento b where nombre like '%".$_GET['term']."%' and not idAlimento in (select idAlimento from plantilla)");
				$datos = array();
				while(!$rs->EOF){
					array_push($datos, array("id" => $rs->fields['idAlimento'], "value" => $rs->fields['nombre'], "label" => $rs->fields['label']));
					$rs->moveNext();
				}
				echo json_encode($datos);
			break;
			case 'setPosicion':
				$obj = new TPlantilla();
				echo json_encode(array("band" => $obj->setPosicion($_POST['alimento'], $_POST['posicion'])));
			break;
		}
	break;

}
?>