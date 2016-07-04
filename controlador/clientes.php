<?php
global $objModulo;
switch($objModulo->getId()){
	case 'clientes':
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from paquete");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			
			$rs->moveNext();
		}
		$smarty->assign("paquetes", $datos);
	break;
	case 'listaClientes':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from cliente");
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
	break;
	case 'listaSuscripciones':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from suscripcion a join paquete b using(idPaquete) where idCliente = ".$_POST['cliente']);
		$datos = array();
		while(!$rs->EOF){
			$rs->fields['json'] = json_encode($rs->fields);
			array_push($datos, $rs->fields);
			$rs->moveNext();
		}
		$smarty->assign("lista", $datos);
	break;
	case 'cclientes':
		switch($objModulo->getAction()){
			case 'add':
				$db = TBase::conectaDB();
				$obj = new TCliente();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setEmail($_POST['email']);
				$obj->setPass($_POST['pass']);
				$obj->setSexo($_POST['sexo']);

				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TCliente($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'validaEmail':
				global $userSesion;
				$db = TBase::conectaDB();
				$rs = $db->Execute("select idCliente from cliente where email = '".$_POST['txtCorreo']."' and not idCliente = '".$_POST['id']."'");
				
				echo $rs->EOF?"true":"false";
			break;
			case 'addPaquete':
				$obj = new TSuscripcion();
				
				if ($_POST['id'] <> '')
					$obj->setCliente($_POST['id']);
				
				$obj->setInicio($_POST['inicio']);
				$obj->setPaquete($_POST['paquete']);
				
				if($obj->guardar())
					echo json_encode(array("band" => true, "id" => $obj->getId()));
				else
					echo json_encode(array("band" => false));
			break;
		}
	break;
}
?>