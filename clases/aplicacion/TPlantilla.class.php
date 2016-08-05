<?php
/**
* TPlantilla
* Una actividad
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
		$rs = $db->Execute("select * from plantilla");
		$this->items = array();
		while(!$rs->EOF){
			$el = new TAlimento($rs->fields['idAlimento']);
			$el->cantidad = $rs->fields['cantidad'];
			
			push_array($this->items, $el);
			$rs->moveNext();
		}
		
		return true;
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
			$db->Execute("insert into plantilla(idAlimento, cantidad) values (".$alimento.", ".$cantidad.")");
		else
			$db->Execute("update plantilla set cantidad = ".$cantidad." where idAlimento = ".$alimento);
			
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
		
		return true;
	}
}