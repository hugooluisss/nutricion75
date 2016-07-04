<?php
global $objModulo;
switch($objModulo->getId()){
	case 'configuracion':
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from configuracion");
		$datos = array();
		while(!$rs->EOF){
			$smarty->assign($rs->fields['clave'], $rs->fields['valor']);
			$rs->moveNext();
		}
	break;
	case 'cconfiguracion':
		switch($objModulo->getAction()){
			case 'update':
				$db = TBase::conectaDB();
				$db->Execute("update configuracion set valor = '".$_POST['valor']."' where clave = '".$_POST['clave']."'");
				
				echo json_encode(array("band" => true));
			break;
		}
	break;
}
?>