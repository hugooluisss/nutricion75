<?php
class TCliente{
	private $idCliente;
	private $nombre;
	private $sexo;
	private $email;
	private $pass;
	private $nacimiento;
	
	public function TCliente($id = ''){
		$this->setId($id);
		
		return true;
	}
	
	public function setId($id = ''){
		if ($id == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select * from cliente where idCliente = ".$id);
		
		foreach($rs->fields as $field => $val)
			switch($field){
				default:
					$this->$field = $val;
			}
		
		return true;
	}
	
	public function getId(){
		return $this->idCliente;
	}
	
	public function setNombre($val = ''){
		$this->nombre = $val;
		return true;
	}
	
	public function getNombre(){
		return $this->nombre;
	}
	
	public function setSexo($val = 'H'){
		$this->sexo = $val;
		return true;
	}
	
	public function getSexo(){
		return $this->sexo;
	}
	
	public function setEmail($val = ''){
		$this->email = $val;
		return true;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setPass($val = ''){
		$this->pass = $val;
		return true;
	}
	
	public function getPass(){
		return $this->pass;
	}
	
	public function setNacimiento($val = ''){
		$this->nacimiento = $val;
		return true;
	}
	
	public function getNacimiento(){
		return $this->nacimiento;
	}
	
	public function getPeso(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select peso, max(fecha) as ultima from momento having fecha = ultima");
		
		return $rs->fields['peso'] == ''?0:$rs->fields['peso'];
	}
	
	public function getEstatura(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		$rs = $db->Execute("select altura, max(fecha) as ultima from momento having fecha = ultima");
		
		return $rs->fields['altura'] == ''?0:$rs->fields['altura'];
	}
	
	public function guardar(){
		$db = TBase::conectaDB();
		
		if ($this->getId() == ''){
			$rs = $db->Execute("INSERT INTO cliente(email, nombre, pass) VALUES ('', '', '');");
			$this->idCliente = $db->Insert_ID();
		}
		
		if ($this->idCliente == '') return false;
		
		$rs = $db->Execute("UPDATE cliente
			SET
				nombre = '".$this->getNombre()."',
				sexo = '".$this->getSexo()."',
				email = '".$this->getEmail()."',
				pass = '".$this->getPass()."',
				nacimiento = '".$this->getNacimiento()."'
			WHERE idCliente = ".$this->getId());
			
		return $rs?true:false;
	}
	
	public function eliminar(){
		if ($this->getId() == '') return false;
		
		$db = TBase::conectaDB();
		return $db->Execute("delete from cliente where idCliente = ".$this->getId())?true:false;
	}
}
?>