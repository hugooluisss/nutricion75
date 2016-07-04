<?php
/**
* TSuscripcion
* Para el control de la publicidad de los abogados
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TSuscripcion{
	private $idSuscripcion;
	public $paquete;
	private $idCliente;
	private $registro;
	private $inicio;
	private $fin;
	private $codigo;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TSuscripcion($id = ''){
		$this->paquete = new TPaquete;
		$this->setId($id);
		
		return true;
	}
	
	/**
	* Carga los datos del objeto
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	* @return boolean True si se realizó sin problemas
	*/
	public function setId($id = ''){
		if ($id == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from suscripcion where idSuscripcion = ".$id);
		
		if ($rs->EOF) return false;
		
		foreach($rs->fields as $key => $val){
			if ($key == 'idPaquete')
				$this->paquete = new TPAquete($val);
			else
				$this->$key = $val;
		}
		
		return true;
	}
	
	/**
	* Retorna el identificador
	*
	* @autor Hugo
	* @access public
	* @return integer Identificador
	*/
	
	public function getId(){
		return $this->idSuscripcion;
	}

	/**
	* Establece el paquete
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setPaquete($val = ''){
		$this->paquete = new TPaquete($val);
		return true;
	}
	
	/**
	* Establece el cliente
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCliente($val = 0){
		$this->cliente = $val;
		return true;
	}
	
	/**
	* Retorna el cliente
	*
	* @autor Hugo
	* @access public
	* @return int Identificador
	*/
	
	public function getCliente(){
		return $this->cliente;
	}
	
	/**
	* Establece la fecha de inicio
	*
	* @autor Hugo
	* @access public
	* @param date $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setInicio($val = ''){
		$this->inicio = $val;
		return true;
	}
	
	/**
	* Retorna la fecha de inicio
	*
	* @autor Hugo
	* @access public
	* @return date Fecha
	*/
	
	public function getInicio(){
		if ($this->inicio == '') return date("Y-m-d");
		
		return $this->inicio;
	}
	
	/**
	* Establece la fecha de fin
	*
	* @autor Hugo
	* @access public
	* @param date $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFin($val = ''){
		$this->fin = $val;
		return true;
	}
	
	/**
	* Retorna la fecha de fin
	*
	* @autor Hugo
	* @access public
	* @return date Fecha
	*/
	
	public function getFin($recalcular = false){
		if ($this->paquete->getId() == '') return false;
		
		if ($this->fin == '' or $recalcular == true)
			return $this->paquete->getTermina($this->getInicio());
		
		return $this->fin;
	}
	
	/**
	* Establece el codigo de la compra
	*
	* @autor Hugo
	* @access public
	* @param date $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCodigo($val = ''){
		$this->codigo = $val;
		return true;
	}
	
	/**
	* Retorna el código de la compra
	*
	* @autor Hugo
	* @access public
	* @return date Fecha
	*/
	
	public function getCodigo(){
		return $this->codigo;
	}
	
	/**
	* Guarda los datos en la base de datos, si no existe un identificador entonces crea el objeto
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		if ($this->getCliente() == '') return false;
		if ($this->paquete->getId() == '') return false;
		if ($this->getInicio() == '') return false;
		
		if ($this->getFin() == '') return false;
		
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO suscripcion(idCliente, idPaquete, registro) VALUES(".$this->getCliente().", ".$this->paquete->getId().", now());");
			if (!$rs) return false;
			
			$this->idSuscripcion = $db->Insert_ID();
		}		
		
		if ($this->idSuscripcion == '')
			return false;
			
		$rs = $db->Execute("UPDATE suscripcion
			SET
				inicio = '".$this->getInicio()."',
				fin = '".$this->getFin(true)."',
				codigo = '".$this->getCodigo()."'
			WHERE idSuscripcion = ".$this->getId());
			
		return $rs?true:false;
	}
	
	/**
	* Elimina el objeto de la base de datos
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function eliminar(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("delete from suscripcion where idSuscripcion = ".$this->getId());
		
		return $rs?true:false;
	}
}