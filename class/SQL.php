<?php 

class SQL extends PDO {

	private $conexao;

	public function __construct(){

		$this->conexao = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

	}

	private function setParams($statement , $parametros = array() ){

		foreach ($parametros as $key => $value) {
			
			$this->setParam($statement, $key, $value);

		}

	}

	private function setParam($statement , $key , $value){

		$statement->bindParam($key , $value);

	}

	public function query($rawQuery, $parametros = array() ){

		$stmt = $this->conexao->prepare($rawQuery);	

		$this->setParams($stmt , $parametros);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery , $params = array() ) :array
	{

		$stmt = $this->query($rawQuery , $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>