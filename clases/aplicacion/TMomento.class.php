<?php
/**
* TMomento
* Para llevar el control del avance del cliente en su peso
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TMomento{
	public $cliente;
	private $fecha;
	private $altura;
	private $peso;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TMomento($id = ''){
		$this->cliente = new TCliente;
		$this->setId($id);
		
		return true;
	}
	
	/**
	* Carga los datos del objeto
	*
	* @autor Hugo
	* @access public
	* @param date $fecha Dia en el que se lleva a cabo el registro
	* @param int $cliente identificador del objeto
	* @return boolean True si se realizó sin problemas
	*/
	public function setId($fecha = '', $cliente = ''){
		if ($fecha == '') date("Y-m-d");
		if ($cliente == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from momento where fecha = '".$fecha."' and idCliente = ".$cliente);
		
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
		
		return true;
	}

	/**
	* Establece la altura en cm
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setAltura($val = ""){
		$this->altura = $val;
		
		return true;
	}
	
	/**
	* Retorna la altura en cm
	*
	* @autor Hugo
	* @access public
	* @return integer Texto
	*/
	
	public function getAltura(){
		return $this->altura;
	}
	
	/**
	* Establece el peso en kg
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setPeso($val = ""){
		$this->peso = $val;
		
		return true;
	}
	
	/**
	* Retorna el peso en kg
	*
	* @autor Hugo
	* @access public
	* @return integer Texto
	*/
	
	public function getPeso(){
		return $this->peso;
	}
	
	/**
	* Establece el fecha
	*
	* @autor Hugo
	* @access public
	* @param date $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFecha($val = ""){
		$this->fecha = $val;
		
		return true;
	}
	
	/**
	* Retorna la fecha en la que fue registrada la información
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getFecha(){
		return $this->fecha == ''?date("Y-m-d"):$this->fecha;
	}
	
	/**
	* Guarda los datos en la base de datos, si no existe un identificador entonces crea el objeto
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		if ($this->cliente->getId() == '') return false;
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from momento where fecha = '".$this->getFecha()."' and idCliente = ".$this->cliente->getId());
		
		if ($rs->EOF){
			$rs = $db->Execute("INSERT INTO momento(fecha, idCliente) VALUES(now(), ".$this->cliente->getId().");");
			if (!$rs) return false;
			
			$this->setFecha($this->getFecha());
		}
		
		$rs = $db->Execute("UPDATE momento
			SET
				altura = ".$this->getAltura().",
				peso = ".$this->getPeso()."
			WHERE fecha = '".$this->getFecha()."' and idCliente = ".$this->cliente->getId());
			
		return $rs?true:false;
	}
}