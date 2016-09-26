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
			case 'cambiarAlimento':
				$obj = new TMenu();
				$obj->setIdByComidaCliente($_POST['comida'], $_POST['cliente']);
				$obj->delAlimento($_POST['alimento']);
				
				echo json_encode(array("band" => $obj->addAlimento($_POST['cambio'], $_POST['cantidad'])));
			break;
			case 'setPlantilla':
				$plantilla = new TPlantilla;
				$db = TBase::conectaDB();
				
				if ($_POST['comida'] == null){
					$rs = $db->Execute("select * from comida");
					$comidas = array();
					while(!$rs->EOF){
						array_push($comidas, $rs->fields['idComida']);
						$rs->moveNext();
					}
				}else
					$comidas = array($_POST['comida']);
				
				foreach($comidas as $comida){
					$menu = new TMenu();
					$menu->setIdByComidaCliente($comida, $_POST['cliente']);
					$aumento = 60;
					$calorias = $menu->cliente->getCalorias() / 5;
					$mensaje = "";
					$cont = 0;
					
					$momento = new TMomento($menu->cliente->getFechaUltimaActualizacion(), $menu->cliente->getId());
					
					
					#esto me lo convierte en macros
					$carbohidratos = $calorias * $momento->actividad->getCarbohidratos() / 100;
					$proteinas = $calorias * $momento->actividad->getProteinas() / 100;
					$grasas = $calorias * $momento->actividad->getGrasas() / 100;
					
					foreach($plantilla->getItemsArray() as $el){
						$cont++;
						if (!$bandPasa){
							$menu->addAlimento($el['idAlimento'], $el['cantidad']);
							$bandPasa = false;
							
							if ($menu->getCaloriasCarbohidratos() + 30 >= $carbohidratos){
								$bandPasa = true;
								#echo "carbohidratos ".$el['nombre']." ".($menu->getCaloriasCarbohidratos()/4)." ".$carbohidratos." ";
							}
								
							if ($menu->getCaloriasProteinas() + 30 >= $proteinas){
								$bandPasa = true;
								#echo "proteinas ";
							}
							
							if ($menu->getCaloriasGrasas() + 50 >= $grasas){
								$bandPasa = true;
								#echo "grasas ";
							}
							
							//echo $menu->getCaloriasCarbohidratos()." - ".$carbohidratos."  ";
							//echo $menu->getCaloriasProteinas()." - ".$proteinas."  ";
							//echo $menu->getCaloriasGrasas()." - ".$grasas."  ";
							
							if ($bandPasa){
								#echo $el['idAlimento']."    ".$cont;
								$bandPasa = false;
								$menu->delAlimento($el['idAlimento']);
							}
						}
					}
				}
				
				echo json_encode(array("band" => true));
			break;
		}
	break;

}