<?php
global $objModulo;
switch($objModulo->getId()){
	case 'cpagos':
		switch($objModulo->getAction()){
			case 'cobroTarjeta':
				require('librerias/conekta/Conekta.php');
				
				$paquete = new TPaquete(2);
				$cliente = new TCliente($_POST['cliente']);
				try{
					Conekta::setApiKey("key_wsX2br3BKSoCSsLsdM8Y5Q");
					Conekta::setLocale('es');
					
					$charge = Conekta_Charge::create(array(
							'description'=> 'Suscripción del usuario ' + $cliente->getNombre() + $paquete->getPrecio(),
							'amount'=> $paquete->getPrecio() * 100,
							'currency'=> "MXN",
							'card'=> $_POST['token'],
							'details'=> array(
								'name'=> $cliente->getNombre(),
								'phone'=> '0105155555',
								'email'=> $cliente->getEmail(),
								'line_items'=> array(
									array(
										'name'=> $paquete->getNombre(),
										'description'=> $paquete->getDescripcion(),
										'unit_price'=> $paquete->getPrecio() * 100,
										'quantity'=> 1,
										'sku'=> $paquete->getId(),
										'type'=> 'suscripcion'
									)
								),
								'billing_address'=> array(
									'street1'=> $_POST['calle'],
									'street2'=> $_POST['colonia'],
									'street3'=> null,
									'city'=> $_POST['ciudad'],
									'state'=> $_POST['estado'],
									'zip'=> $_POST['codigoPostal'],
									'country'=> 'Mexico',
									'email'=> $cliente->getEmail()
								),
								'shipment'=> array(
									'carrier'=> 'estafeta',
									'service'=> 'international',
									'price'=> 0.00,
									'address'=> array(
										'street1'=> '.',
										'street2'=> null,
										'street3'=> null,
										'city'=> '.',
										'state'=> '.',
										'zip'=> '.',
										'country'=> 'Mexico'
									)
								)
							)
						)
					);
					
					if ($charge->status == 'paid'){
						$obj = new TSuscripcion();
						
						$obj->setCliente($_POST['cliente']);
						$obj->setPaquete($paquete->getId());
						$obj->setInicio(date("Y-m-d"));
						
						if($obj->guardar())
							$result = (array("band" => true, "id" => $obj->getId()));
						else
							$result = (array("band" => false));
					}else
						$result = array("band" => false, "mensaje" => "El pago fue rechazado");
					
				}catch(Exception $e){
					$result = array("band" => false, "mensaje" => $e->getMessage());
				}
				
				echo json_encode($result);
			break;
			case 'cobroOXXO':
				require('librerias/conekta/Conekta.php');
				
				$paquete = new TPaquete(2);
				$cliente = new TCliente($_POST['cliente']);
				
				try{
					Conekta::setApiKey("key_wsX2br3BKSoCSsLsdM8Y5Q");
					Conekta::setLocale('es');
					$charge = Conekta_Charge::create(array(
						'description'=> 'Suscripción del usuario ' + $cliente->getNombre() + $paquete->getPrecio(),
						'amount'=> $paquete->getPrecio() * 100,
						'currency'=> "MXN",
						'reference_id'=> json_encode(array("cliente" => $cliente->getId(), "fecha" => date("Y-m-d H:i:s"))),
						'cash'=> array(
							'type'=>'oxxo'
						),
						'details'=> array(
							'name'=> $cliente->getNombre(),
							'phone'=> '0105155555',
							'email'=> $cliente->getEmail(),
							'line_items'=> array(
								array(
									'name'=> $paquete->getNombre(),
									'description'=> $paquete->getDescripcion(),
									'unit_price'=> $paquete->getPrecio() * 100,
									'quantity'=> 1,
									'sku'=> $paquete->getId(),
									'type'=> 'suscripcion'
								)
							),
							'billing_address'=> array(
								'street1'=> "Sin especificar",
								'street2'=> "Sin especificar",
								'street3'=> "Sin especificar",
								'city'=> "Sin especificar",
								'state'=> "Sin especificar",
								'zip'=> "12345",
								'country'=> 'Mexico',
								'email'=> $cliente->getEmail()
							)
						)
					));
					$result = (array("band" => true, "barcode" => $charge->payment_method->barcode_url));
					
					$datos = array();
					$datos['cliente.nombre'] = $cliente->getNombre();
					$datos['cliente.correo'] = $cliente->getEmail();
					$datos['barcode'] = $charge->payment_method->barcode_url;
					
					$email = new TMail();
					$email->setTema(utf8_decode("Código OXXO generado"));
					$email->setDestino($cliente->getEmail(), utf8_decode($cliente->getNombre()));
					
					$email->setBodyHTML(utf8_decode($email->construyeMail(file_get_contents("repositorio/mail/oxxo.txt"), $datos)));
						
					$email->send();
				}catch(Exception $e){
					$result = array("band" => false, "mensaje" => $e->getMessage());
				}
				
				echo json_encode($result);
			break;
			case 'cobroSPEI':
				require('librerias/conekta/Conekta.php');
				
				$paquete = new TPaquete(2);
				$cliente = new TCliente($_POST['cliente']);
				
				try{
					Conekta::setApiKey("key_wsX2br3BKSoCSsLsdM8Y5Q");
					Conekta::setLocale('es');
					$charge = Conekta_Charge::create(array(
						'description'=> 'Suscripción del usuario ' + $cliente->getNombre() + $paquete->getPrecio(),
						'amount'=> $paquete->getPrecio() * 100,
						'currency'=> "MXN",
						'reference_id'=> json_encode(array("cliente" => $cliente->getId(), "fecha" => date("Y-m-d H:i:s"))),
						'bank'=> array(
							'type'=> 'spei'
						),
						'details'=> array(
							'name'=> $cliente->getNombre(),
							'phone'=> '0105155555',
							'email'=> $cliente->getEmail(),
							'line_items'=> array(
								array(
									'name'=> $paquete->getNombre(),
									'description'=> $paquete->getDescripcion(),
									'unit_price'=> $paquete->getPrecio() * 100,
									'quantity'=> 1,
									'sku'=> $paquete->getId(),
									'type'=> 'suscripcion'
								)
							),
							'billing_address'=> array(
								'street1'=> "Sin especificar",
								'street2'=> "Sin especificar",
								'street3'=> "Sin especificar",
								'city'=> "Sin especificar",
								'state'=> "Sin especificar",
								'zip'=> "12345",
								'country'=> 'Mexico',
								'email'=> $cliente->getEmail()
							)
						)
					));
					
					$result = (array("band" => true, "clabe" => $charge->payment_method->clabe));
					
					$datos = array();
					$datos['cliente.nombre'] = $cliente->getNombre();
					$datos['cliente.correo'] = $cliente->getEmail();
					$datos['clabe'] = $charge->payment_method->clabe;
					
					$email = new TMail();
					$email->setTema("Clabe de pago SPEI generada");
					$email->setDestino($cliente->getEmail(), utf8_decode($cliente->getNombre()));
					
					$email->setBodyHTML(utf8_decode($email->construyeMail(file_get_contents("repositorio/mail/spei.txt"), $datos)));
						
					$email->send();
				}catch(Exception $e){
					$result = array("band" => false, "mensaje" => $e->getMessage());
				}
				
				echo json_encode($result);
			break;
			case 'webhooks':
				$body = @file_get_contents('php://input');
				$data = json_decode($body);
				http_response_code(200); // Return 200 OK
				
				$filename = "webhooks.txt";//esta es la ubicación local
				$handle = fopen($filename, 'a+');
				
				switch($data->data->object->payment_method->object){
					case 'card_payment':
					break;
					case 'oxxo': case 'cash_payment':
						$datos = json_decode($data->data->object->reference_id);
						$paquete = new TPaquete(2);
						
						$obj = new TSuscripcion();
						$cliente = new TCliente($datos->cliente);
						
						$obj->setCliente($cliente->getId());
						$obj->setPaquete($paquete->getId());
						$obj->setInicio(date("Y-m-d"));
						
						if($obj->guardar()){
							$datos = array();
							$datos['cliente.nombre'] = $cliente->getNombre();
							$datos['cliente.correo'] = $cliente->getEmail();
							$datos['momento'] = date("Y-m-d");
							
							$email = new TMail();
							$email->setTema("Recibimos su pago");
							$email->setDestino($cliente->getEmail(), utf8_decode($cliente->getNombre()));
							
							$email->setBodyHTML(utf8_decode($email->construyeMail(file_get_contents("repositorio/mail/pagoRecibido.txt"), $datos)));
								
							$email->send();
						}else
							fwrite($handle, date("Y-m-d H:i:s ---- ")."Error al guardar ".$datos->cliente.PHP_EOL);
					break;
					case 'bank_transfer_payment': case 'spei':
						$datos = json_decode($data->data->object->reference_id);
						$paquete = new TPaquete(2);
						
						$obj = new TSuscripcion();
						$cliente = new TCliente($datos->cliente);
						$obj->setCliente($cliente->getId());
						$obj->setPaquete($paquete->getId());
						$obj->setInicio(date("Y-m-d"));
						
						if($obj->guardar()){
							$datos = array();
							$datos['cliente.nombre'] = $cliente->getNombre();
							$datos['cliente.correo'] = $cliente->getEmail();
							$datos['momento'] = date("Y-m-d");
							
							$email = new TMail();
							$email->setTema("Recibimos su pago");
							$email->setDestino($cliente->getEmail(), utf8_decode($cliente->getNombre()));
							
							$email->setBodyHTML(utf8_decode($email->construyeMail(file_get_contents("repositorio/mail/pagoRecibido.txt"), $datos)));
								
							$email->send();
						}
					break;
					default:
						fwrite($handle, date("Y-m-d H:i:s ---- ")."Esta es una prueba ".print_r($data->data->object->payment_method->object, true).PHP_EOL);
				}
				
				fwrite($handle, date("Y-m-d H:i:s ---- ").print_r($data, true).PHP_EOL);

				fclose($handle);
				
			break;
		}
	break;
}
?>