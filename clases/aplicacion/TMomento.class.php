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
	private $idFrecuencia;
	private $idObjetivo;
	public $actividad;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	* @param int $id identificador del objeto
	*/
	public function TMomento($id = '', $cliente = ''){
		$this->cliente = new TCliente($cliente);
		$this->actividad = new TActividad(0);
		$this->setId($id, $cliente);
		
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
		if ($fecha == '') $fecha = date("Y-m-d");
		if ($cliente == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from momento where fecha = '".$fecha."' and idCliente = ".$cliente);
		
		if ($rs->EOF) return false;
		foreach($rs->fields as $key => $val){
			switch($key){
				case 'idCliente':
					$this->cliente = new TCliente($val);
				break;
				case 'idActividad':
					$this->actividad = new TActividad($val);
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
	* Establece el identificador de la frecuencia
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setFrecuencia($val = ""){
		$this->idFrecuencia = $val;
		
		return true;
	}
	
	/**
	* Retorna el identificador de la frecuencia
	*
	* @autor Hugo
	* @access public
	* @return integer Texto
	*/
	
	public function getFrecuencia(){
		return $this->idFrecuencia;
	}
	
	/**
	* Establece el objetivo
	*
	* @autor Hugo
	* @access public
	* @param int $val Valor a asignar
	* @return boolean True si se realizó sin problemas
	*/
	
	public function setObjetivo($val = ""){
		$this->idObjetivo = $val;
		
		return true;
	}
	
	/**
	* Retorna el id del objetivo
	*
	* @autor Hugo
	* @access public
	* @return integer Identificador
	*/
	
	public function getObjetivo(){
		return $this->idObjetivo;
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
		if ($this->getFrecuencia() == '') return false;
		if ($this->getObjetivo() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from momento where fecha = '".$this->getFecha()."' and idCliente = ".$this->cliente->getId());
		
		if ($rs->EOF){
			$rs = $db->Execute("INSERT INTO momento(fecha, idCliente, idFrecuencia, idObjetivo, idActividad) VALUES(now(), ".$this->cliente->getId().", ".$this->getFrecuencia().", ".$this->getObjetivo().", 0);");
			if (!$rs) return false;
			
			$this->setFecha($this->getFecha());
		}
		
		$rs = $db->Execute("UPDATE momento
			SET
				altura = ".$this->getAltura().",
				peso = ".$this->getPeso().",
				idFrecuencia = ".$this->getFrecuencia().",
				idObjetivo = ".$this->getObjetivo().",
				idActividad = ".($this->actividad->getId() == ''?0:$this->actividad->getId())."
			WHERE fecha = '".$this->getFecha()."' and idCliente = ".$this->cliente->getId());
			
		return $rs?true:false;
	}
	
	/**
	* Retorna el valor del indice de masa corporal
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getIMC(){
		$peso = $this->getPeso();
		$altura = $this->getAltura() / 100;
		
		if ($peso == '' or $altura == '')
			return 0;
		else{
			$imc = $peso / ($altura * $altura);
			return round($imc, 2); //D11
		}
	}
	
	/**
	* Retorna el porcentaje de grasa corporal estimada
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	
	public function getPGCE(){
		$imc = $this->getIMC();
		$edad = $this->cliente->getEdad(); //D7
		$iSexo = $this->cliente->getSexo() == 'M'?0:1; //D8

		$PGCE = -44.988 + 0.503 * $edad + 10.689 * $iSexo + 3.172 * $imc - 0.026 * $imc * $imc + 0.181 * $imc * $iSexo - 0.02 * $imc * $edad - 0.005 * $imc * $imc * $iSexo + 0.00021 * $imc * $imc * $edad;
		
		return round($PGCE, 2);

	}
	
	/**
	* Retorna el MBR
	*
	* @autor Hugo
	* @access public
	* @return float valor
	*/
	public function getMBR(){
		if ($this->cliente->getSexo == 'H')
			return 1 * $this->getPeso() * 24;
		else
			return 0.9 * $this->getPeso() * 24;
	}
	
	/**
	* Retorna el nivel de magro
	*
	* @autor Hugo
	* @access public
	* @return array valor
	*/
	public function getObesidad(){
		if ($this->cliente->getId() == '') return false;
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select * from obesidad where sexo = '".$this->cliente->getSexo()."' and porcentaje >= ".$this->getPGCE());	
		
		return $rs->fields;
	}
	
	/**
	* Cálculo de calorías
	*
	* @autor Hugo
	* @access public
	* @return array valor
	*/
	public function getCalorias(){
		if ($this->cliente->getId() == '') return false;
		$db = TBase::conectaDB();
		
		$mbr = $this->getMBR() == ''?0:$this->getMBR();
		
		$rs = $db->Execute("select b.indice from frecuencia b where b.idFrecuencia = ".$this->getFrecuencia()."");
		$indice = $rs->fields['indice'] == ''?0:$rs->fields['indice'];
		
		$rs = $db->Execute("select * from objetivo where idObjetivo = ".$this->getObjetivo());
		$caloriasObjetivo = $rs->fields['tipo'] * $rs->fields['calorias'];
		
		return $mbr * $indice + $caloriasObjetivo;
	}
}