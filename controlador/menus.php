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
				$aumento = 200;
				if ($obj->addAlimento($_POST['alimento'], $_POST['cantidad'])){
					if ($obj->cliente->getCalorias() / 5 + $aumento <= $obj->getCalorias()){
						$obj->delAlimento($_POST['alimento']);
						
						echo json_encode(array("band" => false, "mensaje" => "El producto no se agregó por que supera el límite de calorías", "calorias" => $obj->getCalorias()));
					}else{
						#Se va a analizar ahora por el tipo de actividad
						$momento = new TMomento($obj->cliente->getFechaUltimaActualizacion(), $obj->cliente->getId());
						$mensaje = "";
						$carbohidratos = $momento->actividad->getCarbohidratos() / 100;
						if ($obj->getCaloriasCarbohidratos() * $carbohidratos + $aumento <= $obj->getCalorias() * $carbohidratos)
							$mensaje += "El producto supera los límites de calorías en carbohidratos<br />";
							
						$proteinas = $momento->actividad->getProteinas() / 100;
						if ($obj->getCaloriasProteinas() * $proteinas + $aumento <= $obj->getCalorias() * $proteinas)
							$mensaje += "El producto supera los límites de calorías en proteinas<br />";
							
						$grasas = $momento->actividad->getGrasas() / 100;
						if ($obj->getCaloriasGrasas() * $grasas + $aumento <= $obj->getCalorias() * $grasas)
							$mensaje += "El producto supera los límites de calorías en grasas<br />";
							
						if ($mensaje <> '')
							$obj->delAlimento($_POST['alimento']);

						echo json_encode(array(
							"band" => $mensaje == '', 
							"mensaje" => $mensaje,
							"proteinas" => $obj->getCaloriasProteinas(),
							"carbohidratos" => $obj->getCaloriasCarbohidratos(),
							"grasas" => $obj->getCaloriasGrasas()
						));
					}
						
				}else
					echo json_encode(array("band" => false));	
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
				$aumento = 200;
				
				foreach($plantilla->getItemsArray() as $el){
					$menu->addAlimento($el['idAlimento'], $el['cantidad']);
					
					if ($menu->cliente->getCalorias() / 5 + $aumento <= $menu->getCalorias()){
						$menu->delAlimento($el['idAlimento']);
					}else{
						#Se va a analizar ahora por el tipo de actividad
						$momento = new TMomento($menu->cliente->getFechaUltimaActualizacion(), $menu->cliente->getId());
						$mensaje = "";
						$carbohidratos = $momento->actividad->getCarbohidratos() / 100;
						if ($menu->getCaloriasCarbohidratos() * $carbohidratos + $aumento <= $menu->getCalorias() * $carbohidratos)
							$mensaje += "El producto supera los límites de calorías en carbohidratos<br />";
							
						$proteinas = $momento->actividad->getProteinas() / 100;
						if ($menu->getCaloriasProteinas() * $proteinas + $aumento <= $menu->getCalorias() * $proteinas)
							$mensaje += "El producto supera los límites de calorías en proteinas<br />";
							
						$grasas = $momento->actividad->getGrasas() / 100;
						if ($menu->getCaloriasGrasas() * $grasas + $aumento <= $menu->getCalorias() * $grasas)
							$mensaje += "El producto supera los límites de calorías en grasas<br />";
						
						if ($mensaje != '')
							$menu->delAlimento($el['idAlimento']);
					}
				}
				
				echo json_encode(array("band" => true));
			break;
		}
	break;

}