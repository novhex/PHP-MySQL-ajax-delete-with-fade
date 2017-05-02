<?php

class DB {

	private $db_object = NULL;
	private $host = 'localhost';
	private $db_name = 'ajaxdb';
	private $username='root';
	private $pass='';

	public function __construct(){
		
		$this->initConnection();
	}


	private function initConnection(){

		$this->db_object = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->pass);
	}

	public function getConnection(){

		return $this->db_object;
	}

}