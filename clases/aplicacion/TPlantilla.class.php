<?php
/**
* TPlantilla
* La plantilla del menú por defecto
* @package aplicacion
* @autor Hugo Santiago hugooluisss@gmail.com
**/
class TPlantilla{
	private $items;
	
	/**
	* Constructor de la clase
	*
	* @autor Hugo
	* @access public
	*/
	public function TPlantilla(){
		$this->getData();
		return true;
	}
	
	/**
	* Retorna el Identificador
	*
	* @autor Hugo
	* @access public
	* @return int valor
	*/
	
	public function getData(){
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from plantilla order by posicion;");
		$this->items = array();
		while(!$rs->EOF){
			$el = new TAlimento($rs->fields['idAlimento']);
			$el->cantidad = $rs->fields['cantidad'];
			
			array_push($this->items, $el);
			$rs->moveNext();
		}
		
		return true;
	}
	
	/*
	* Define la posicion del alimento
	*
	* @autor Hugo
	* @access public
	* @return boolean true si lo hizo
	*/
	
	private function nextPosicion(){
		$db = TBase::conectaDB();
		
		$rs = $db->Execute("select max(posicion) as posicion from plantilla");
		return $rs->EOF?1:($rs->fields['posicion']+1);
	}
	
	/**
	* Agrega un alimento a la lista
	*
	* @autor Hugo
	* @access public
	* @param int $alimento Identificador del alimento
	* @param int $cantidad cantidad
	* @return boolean true si lo hizo
	*/
	
	public function agregar($alimento = '', $cantidad = 1){
		if ($alimento == '') return false;
		if ($cantidad == 0) return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from plantilla where idAlimento = ".$alimento);
		if ($rs->EOF)
			$db->Execute("insert into plantilla(idAlimento, cantidad, posicion) values (".$alimento.", ".$cantidad.", ".$this->nextPosicion().")");
		else
			$db->Execute("update plantilla set cantidad = ".$cantidad." where idAlimento = ".$alimento);
		
		$this->getData();
		
		return true;
	}
	
	/**
	* Elimina un alimento de la lista
	*
	* @autor Hugo
	* @access public
	* @param int $alimento Identificador del alimento
	* @return boolean true si lo hizo
	*/
	
	public function eliminar($alimento){
		if ($alimento == '') return false;
		
		$db = TBase::conectaDB();
		$db->Execute("delete from plantilla where idAlimento = ".$alimento);
		
		$this->getData();
		
		return true;
	}
	
	/**
	* Establece la posicion
	*
	* @autor Hugo
	* @access public
	* @param int $posicion posición en la lista
	* @return boolean true si lo hizo
	*/
	
	public function setPosicion($alimento = '', $posicion = 0){
		if ($alimento == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from posicion where posicion = ".$posicion);
		if (!$rs->EOF){
			$db->Execute("update plantilla set posicion = posicion + 1 where posicion >= ".$posicion);
		}
		
		$db->Execute("update plantilla set posicion = ".$posicion." where idAlimento = ".$alimento);
		
		$this->getData();
		
		return true;
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
}