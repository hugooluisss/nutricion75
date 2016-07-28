<?php
global $objModulo;
switch($objModulo->getId()){
	case 'listaObjetivos':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select a.* from objetivo a");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
		$smarty->assign("json", $datos);
	break;
}
?>