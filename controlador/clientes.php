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
	case 'listaClienteMomentos':
		$db = TBase::conectaDB();
		global $sesion;
		
		$rs = $db->Execute("select * from momento where idCliente = ".$_POST['cliente']);
		$momento = new TMomento;
		$datos = array();
		while(!$rs->EOF){
			$momento->setId($rs->fields['fecha'], $_POST['cliente']);
			$rs->fields['imc'] = $momento->getIMC();
			$rs->fields['pgce'] = $momento->getPGCE();
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
			case 'getData':
				$cliente = new TCliente;
				
				$cliente->setId($_POST['id']);
				
				$data = array();
				$data['idCliente'] = $cliente->getId();
				$data['sexo'] = $cliente->getSexo();
				$data['email'] = $cliente->getEmail();
				$data['nacimiento'] = $cliente->getNacimiento();
				$data['peso'] = $cliente->getPeso();
				$data['estatura'] = $cliente->getEstatura();
				$data['idFrecuencia'] = $cliente->getFrecuencia();
				$data['nombre'] = $cliente->getNombre();
				$data['fecha'] = $cliente->getFechaUltimaActualizacion();
				$data['objetivo'] = $cliente->getObjetivo();
				$data['calorias'] = $cliente->getCalorias();
				$actividad = new TActividad($cliente->getActividad());
				$data['idActividad'] = $actividad->getId();
				$data['nombreActividad'] = $actividad->getNombre();
				
				$db = TBase::conectaDB();
				$rs = $db->Execute("select nombre from frecuencia where idFrecuencia = ".$data['idFrecuencia']);
				$data['nombreFrecuencia'] = $rs->fields['nombre'];
				
				echo json_encode($data);
			break;
			case 'add':
				$db = TBase::conectaDB();
				$obj = new TCliente();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setEmail($_POST['email']);
				$obj->setPass($_POST['pass']);
				$obj->setSexo($_POST['sexo']);
				$obj->setNacimiento($_POST['nacimiento']);
				
				$resp = $obj->guardar();
				
				if ($_POST['suscripcion']){
					$objSuscripcion = new TSuscripcion;
					$objSuscripcion->setCliente($obj->getId());
					$objSuscripcion->setPaquete(1);
					
					$objSuscripcion->guardar();
				}

				echo json_encode(array("band" => $resp));
			break;
			case 'save':
				$db = TBase::conectaDB();
				$obj = new TCliente();
				
				$obj->setId($_POST['id']);
				$obj->setNombre($_POST['nombre']);
				$obj->setEmail($_POST['email']);
				$obj->setSexo($_POST['sexo']);
				
				$resp = $obj->guardar();

				echo json_encode(array("band" => $resp));
			break;
			case 'setPass':
				global $sesion;
				
				$obj = new TCliente();
				$obj->setId($_POST['usuario']);
				$obj->setPass($_POST['pass']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;

			case 'actualizarNacimiento':
				$obj = new TCliente();
				
				$obj->setId($_POST['cliente']);
				$obj->setNacimiento($_POST['nacimiento']);
				
				echo json_encode(array("band" => $obj->guardar()));
			break;
			case 'del':
				$obj = new TCliente($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'validaEmail':
				global $userSesion;
				$db = TBase::conectaDB();
				$rs = $db->Execute("select idCliente from cliente where email = '".($_POST['txtCorreo'] == ''?$_POST['txtUsuario']:$_POST['txtCorreo'])."' and not idCliente = '".$_POST['id']."'");
				
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
			case 'delPaquete':
				$obj = new TSuscripcion($_POST['id']);
				echo json_encode(array("band" => $obj->eliminar()));
			break;
			case 'recuperarPass':
				$db = TBase::conectaDB();
				$rs = $db->Execute("select idCliente from cliente where email = '".$_POST['correo']."'");
				
				if (!$rs->EOF){
					$cliente = new TCliente($rs->fields['idCliente']);
					
					$datos = array();
					$datos['cliente.nombre'] = $cliente->getNombre();
					$datos['cliente.pass'] = $cliente->getPass();
					$datos['cliente.correo'] = $cliente->getEmail();
					
					$email = new TMail();
					$email->setTema("Recuperación de contraseña");
					$email->setDestino($cliente->getEmail(), utf8_decode($cliente->getNombre()));
					
					$email->setBodyHTML(utf8_decode($email->construyeMail(file_get_contents("repositorio/mail/recuperarPass.txt"), $datos)));
					
					echo json_encode(array("band" => $email->send()));
				}else
					echo json_encode(array("band" => false));
			break;
			case 'addMomento':
				$momento = new TMomento;
				
				$momento->setId('', $_POST['']);
				$momento->setFecha($_POST['fecha']);
				$momento->cliente->setId($_POST['cliente']);
				$momento->setAltura($_POST['altura']);
				$momento->setPeso($_POST['peso']);
				$momento->setFrecuencia($_POST['frecuencia']);
				$momento->setObjetivo($_POST['objetivo']);
				
				if ($_POST['nacimiento'] <> ''){
					$cliente = new TCliente($_POST['cliente']);
					$cliente->setNacimiento($_POST['nacimiento']);
					
					$cliente->guardar();
				}
				
				echo json_encode(array(
					"band" => $momento->guardar(), 
					"MBR" => $momento->getMBR(), 
					"PGCE" => $momento->getPGCE(), 
					"magro" => $momento->getObesidad(), 
					"calorias" => $momento->getCalorias()));
			break;
			case 'setActividad':
				$momento = new TMomento();
				$momento->cliente->setId($_POST['cliente']);
				$momento->setId($momento->cliente->getUltimoMomento(), $_POST['cliente']);
				
				$momento->actividad->setId($_POST['actividad']);
				
				echo json_encode(array(
					"band" => $momento->guardar(), 
					"MBR" => $momento->getMBR(), 
					"PGCE" => $momento->getPGCE(), 
					"magro" => $momento->getObesidad(), 
					"calorias" => $momento->getCalorias()));
			break;
			case 'getPeso':
				$db = TBase::conectaDB();
				$rs = $db->Execute("select fecha, peso from momento where fecha > '".(date("Y")-1)."-".date("m-d")."' and idCliente = ".$_POST['id']);
				
				$datos = array();
				while (!$rs->EOF){
					array_push($datos, $rs->fields);
					$rs->moveNext();
				}
				
				echo json_encode($datos);
			break;
		}
	break;
	case 'csuscripcion':
		switch($objModulo->getAction()){
			case 'getSuscripcion':
				$usuario = new TCliente($_POST['id']);
				
				if ($usuario->getId() == '')
					echo json_encode(array("band" => -1));
				else if ($usuario->isSuscripto())
					echo json_encode(array("band" => 1));
				else
					echo json_encode(array("band" => 0));
			break;
		}
	break;
}
?>