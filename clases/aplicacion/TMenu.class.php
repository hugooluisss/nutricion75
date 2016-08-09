<?php
/**
* TPlantilla
* Una actividad
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TMenu{
	private $items;
	private $idMenu;
	public $cliente;
	private $idComida;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	*/
	public function TMenu($idMenu){
		$this->cliente = new TCliente;
		$this->setId($idMenu);
		
		return true;
	}
	
	/**
	* Carga los datos del objeto
	*
	* @autor Hugo
	* @access public
	* @param int $menu Identificador del menú
	* @return boolean True si se realizó sin problemas
	*/
	public function setId($menu = ''){
		if ($menu == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from menu where idMenu = ".$menu);
		
		if ($rs->EOF) return false;
		foreach($rs->fields as $key => $val){
			switch($key){
				case 'idCliente':
					$this->cliente = new TCliente($val);
				break;
				default:
					$this->$key = $val;
			}
		}
		
		$this->getItems();
		
		return true;
	}
	
	/**
	* Retorna el identificador
	*
	* @autor Hugo
	* @access public
	* @return integer Identificador del menú
	*/
	
	public function getId(){
		return $this->idMenu;
	}
	
	/**
	* Carga los datos del objeto en base a la comida y al cliente
	*
	* @autor Hugo
	* @access public
	* @param int $comida identificador de la comida
	* @param int $cliente identificador del objeto
	* @return boolean True si se realizó sin problemas
	*/
	public function setIdByComidaCliente($comida = '', $cliente = ''){
		if ($comida == '') return false;
		if ($cliente == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select idMenu from menu where idComida = ".$comida." and idCliente = ".$cliente);
		
		if ($rs->EOF){
			$this->idComida = $comida;
			$this->cliente = new TCliente($cliente);
			
			return $this->crear();
		}
		
		return $this->setId($rs->fields['idMenu']);
	}
	
	/**
	* Carga la lista de alimentos
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	public function getItems(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from menualimento where idMenu = ".$this->getId());
		$this->items = array();
		
		while(!$rs->EOF){
			$obj = new TAlimento($rs->fields['idAlimento']);
			$obj->cantidad = $rs->fields['cantidad'];
			
			array_push($this->items, $obj);
			$rs->moveNext();
		}
		
		return true;
	}
	
	/**
	* Agrega un alimento a la lista
	*
	* @autor Hugo
	* @access public
	* @param int $alimento identificador de la comida
	* @param float $cantidad Cantidad
	* @return boolean True si se realizó sin problemas
	*/
	public function addAlimento($alimento = '', $cantidad = 1){
		if ($alimento == '') return false;
		
		if ($this->getId() == '')
			if (!$this->crear()) return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("insert into menualimento(idMenu, idAlimento, cantidad) values (".$this->getId().", ".$alimento.", ".$cantidad.")");
		
		return $rs?true:false;
	}
	
	/**
	* Eliminar un alimento a la lista
	*
	* @autor Hugo
	* @access public
	* @param int $alimento identificador de la comida
	* @return boolean True si se realizó sin problemas
	*/
	public function delAlimento($alimento = ''){
		if ($alimento == '') return false;
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from menualimento where idMenu = ".$this->getId()." and idAlimento = ".$alimento);
		
		return $rs?true:false;
	}
	
	/**
	* Crea el maestro del menú
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	public function crear(){
		if ($this->cliente->getId() == '') return false;
		if ($this->idComida == '') return false;
			
		$db = TBase::conectaDB();
		$rs = $db->Execute("select idMenu from menu where idCliente = ".$this->cliente->getId()." and idComida = ".$this->idComida);
		
		if ($rs->EOF){
			$rs = $db->Execute("insert into menu (idCliente, idComida, ultimaActualizacion) value (".$this->cliente->getId().", ".$this->idComida.", '".date("Y-m-d H:i:s")."')");
			
			$this->idMenu = $db->Insert_ID();
		}else{
			$this->setId($rs->fields['idMenu']);
		}
		
		return $rs?true:false;
	}
	
	/**
	* Retorna los items
	*
	* @autor Hugo
	* @access public
	* @return array Items del menu
	*/
	
	public function getItemsArray(){
		$datos = array();
		foreach($this->items as $el){
			array_push($datos, array(
				"nombre" => $el->getNombre(),
				"idAlimento" => $el->getId(),
				"carbohidratos" => $el->getCarbohidratos(),
				"proteinas" => $el->getGrasas(),
				"fibra" => $el->getFibra(),
				"cantidad" => $el->cantidad
			));
		}
		
		return $datos;
	}
};
?>