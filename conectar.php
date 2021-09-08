<?php
session_start();
$servidor='localhost'; //ip do servidor php
$usuario = 'postgres';   //usuario mysql
$senha = 'postgres'; //senha mysql
$porta = '5432'; //senha mysql
$bancoDados = 'unico';  //nome do banco do dados



//Aqui criamos a conexão utilizando o servidor, usuario e senha,
//caso dê erro, retorna um erro ao usuário.
$conexao=pg_connect ("host=$servidor port=5432 dbname=$bancoDados user=$usuario password=$senha");

if (!$conexao) {
  die('Não foi possível conectar ao MySQL' . mysql_error());
}
?>

 
