<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaComidas':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select a.* from comida a");
		$datos = array();
		while(!$rs->EOF){
			#$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
	case 'listaAlimentosMenu':
		$db = TBase::conectaDB();
		
		$objMenu = new TMenu;
		$objMenu->setIdByComidaCliente($_POST['comida'], $_POST['cliente']);
		
		$smarty->assign("lista", $objMenu->getItemsArray());
		$smarty->assign("json", $objMenu->getItemsArray());
	break;
	case 'cmenus':
		switch($objModulo->getAction()){
			case 'addAlimento':
				$obj = new TMenu();
				$obj->setIdByComidaCliente($_POST['comida'], $_POST['cliente']);

				echo json_encode(array("band" => $obj->addAlimento($_POST['alimento'], $_POST['cantidad'])));
			break;
			case 'delAlimento':
				$obj = new TMenu();
				$obj->setIdByComidaCliente($_POST['comida'], $_POST['cliente']);
				
				echo json_encode(array("band" => $obj->delAlimento($_POST['alimento'])));
			break;
			case 'setPlantilla':
				$plantilla = new TPlantilla;
				
				$menu = new TMenu();
				$menu->setIdByComidaCliente($_POST['comida'], $_POST['cliente']);
				
				foreach($plantilla->getItemsArray() as $el)
					$menu->addAlimento($el['idAlimento'], $el['cantidad']);
				
				echo json_encode(array("band" => true));
			break;
		}
	break;

}