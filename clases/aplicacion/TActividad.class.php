<?php
/**
* TActividad
* Una actividad
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TActividad{
	private $idActividad;
	private $idTipo;
	private $nombre;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TActividad($id = ''){
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
	public function setId($id = ''){
		if ($id == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from actividad where idActividad = ".$id);
		
		if ($rs->EOF) return false;
		
		foreach($rs->fields as $key => $val){
			switch($key){
				default:
					$this->$key = $val;
			}
		}
		
		return true;
	}
	
	/**
	* Retorna el Identificador
	*
	* @autor Hugo
	* @access public
	* @return int valor
	*/
	
	public function getId(){
		return $this->idActividad;
	}

	/**
	* Establece el nombre
	*
	* @autor Hugo
	* @access public
	* @param string $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setNombre($val = ""){
		$this->nombre = $val;
		
		return true;
	}
	
	/**
	* Retorna el nombre
	*
	* @autor Hugo
	* @access public
	* @return text Texto
	*/
	
	public function getNombre(){
		return $this->nombre;
	}
	
	/**
	* Establece el tipo
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setTipo($val = ''){
		$this->idTipo = $val;
		
		return true;
	}
	
	/**
	* Retorna el identificador del tipo
	*
	* @autor Hugo
	* @access public
	* @return int valor
	*/
	
	public function getTipo(){
		return $this->idTipo;
	}
	
	/**
	* Guarda los datos en la base de datos, si no existe un identificador entonces crea el objeto
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		if ($this->getTipo() == '') return false;
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO actividad(idTipo) VALUES(".$this->getTipo().");");
			if (!$rs) return false;
			
			$this->idActividad = $db->Insert_ID();
		}
		
		if ($this->idActividad == '') return false;
		
		$rs = $db->Execute("UPDATE actividad
			SET
				nombre = '".$this->getNombre()."',
				idTipo = ".$this->getTipo()."
			WHERE idActividad = ".$this->getId());
			
		return $rs?true:false;
	}
	
	/**
	* Elimina el registro de la bd
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function eliminar(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		return $db->Execute("delete from actividad where idActividad = ".$this->getId())?true:false;
	}

}