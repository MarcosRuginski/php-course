<?php 

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function __construct($login = "" , $senha = ""){
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	}
////////////////////////////////////////////////////

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($idusuario){
		$this->idusuario = $idusuario;
	}

////////////////////////////////////////////////////

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}

////////////////////////////////////////////////////

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}

////////////////////////////////////////////////////

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

////////////////////////////////////////////////////

	public function loadById($id){

		$sql = new SQL();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
			':ID'=>$id
		));

		if(count($result))
		{
			$row = $result[0];
			$this->setData($result[0]);
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

	public static function getList(){
		$sql = new SQL();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){
		$sql = new SQL();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH'=>"%".$login."%"
		));
	}

	public function login($login, $password){
		$sql = new SQL();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
			':LOGIN'=>$login,
			':PASSWORD'=>$password
		));

		if(count($result)){
			$row = $result[0];
			$this->setData($result[0]);

		}else{
			throw new Exception("Login e/ou senha inválidos");
		}
	}

	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}


	public function insert(){
		$sql = new SQL();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha()
		));

		$result2 = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = LAST_INSERT_ID()");
 
	    if(count($result2)>0){
	        $this->setData($result2[0]);
	    }

	}

	public function update($login ,  $password ){
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new SQL();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN , dessenha = :SENHA WHERE idusuario = :ID",array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));		
	}

}



 ?>