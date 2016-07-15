<?php
/**
* TAlimento
* Alimento en una proporcion de 200g
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TAlimento{
	private $idAlmento;
	private $nombre;
	private $carbohidratos;
	private $proteinas;
	private $grasas;
	private $fibra;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TAlimento($id = ''){
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
		$rs = $db->Execute("select * from alimento where idAlimento = ".$id);
		
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
		return $this->idAlimento;
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
	* Establece la cantidad de carbohidratos
	*
	* @autor Hugo
	* @access public
	* @param float $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setCarbohidratos($val = 0){
		$this->carbohidratos = $val;
		
		return true;
	}
	
	/**
	* Retorna la cantidad de carbohidratos
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getCarbohidratos(){
		return $this->carbohidratos;
	}
	
	/**
	* Establece la cantidad de proteinas
	*
	* @autor Hugo
	* @access public
	* @param float $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setProteinas($val = 0){
		$this->proteinas = $val;
		
		return true;
	}
	
	/**
	* Retorna la cantidad de proteinas
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getProteinas(){
		return $this->proteinas;
	}
	
	/**
	* Establece la cantidad de grasas
	*
	* @autor Hugo
	* @access public
	* @param float $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setGrasas($val = 0){
		$this->grasas = $val;
		
		return true;
	}
	
	/**
	* Retorna la cantidad de grasas
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getGrasas(){
		return $this->grasas;
	}
	
	/**
	* Establece la cantidad de fibra
	*
	* @autor Hugo
	* @access public
	* @param float $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFibra($val = 0){
		$this->fibra = $val;
		
		return true;
	}
	
	/**
	* Retorna la cantidad de fibra
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getFibra(){
		return $this->fibra;
	}
	
	/**
	* Guarda los datos en la base de datos, si no existe un identificador entonces crea el objeto
	*
	* @autor Hugo
	* @access public
	* @return boolean True si se realizó sin problemas
	*/
	
	public function guardar(){
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO alimento(nombre) VALUES('');");
			if (!$rs) return false;
			
			$this->idAlimento = $db->Insert_ID();
		}
		
		if ($this->idAlimento == '') return false;
		
		$rs = $db->Execute("UPDATE alimento
			SET
				nombre = '".$this->getNombre()."',
				carbohidratos = ".$this->getCarbohidratos().",
				proteinas = ".$this->getProteinas().",
				grasas = ".$this->getGrasas().",
				fibra = ".$this->getFibra()."
			WHERE idAlimento = ".$this->getId());
			
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
		return $db->Execute("delete from alimento where idAlimento = ".$this->getId())?true:false;
	}

}