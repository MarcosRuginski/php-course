<?php 

require_once("config.php");

//$sql = new SQL();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

//Tras apenas um só
/*$user = new Usuario();
$user->loadById(3);
echo $user;
*/

//Carrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carerga uma lista de usuarios buscando pelo login
//$busca = Usuario::search('r');
//echo json_encode($busca);

//Carrega um usuario usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("TESTE","TESTE");
//echo $usuario;


//Insert
//$aluno = new Usuario("aluno","senhadoaluno");
//$aluno->insert();
//echo $aluno;

$usuario = new Usuario();

$usuario->loadById(6);

$usuario->update("professor","senhadoprofessor");
echo $usuario;


 ?>