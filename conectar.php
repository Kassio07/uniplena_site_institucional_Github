<?php
//Conexao
$host = "";
$user = "";
$pass = "";
$banco = "";
//$conex = mysql_connect($host,$user,$pass);
//$bd = mysql_select_db($banco);

//picsFuncs
include("picsFuncs.php");
$pics = new PICS();
$base = "https://www.uniplenagraduacao/locacao-de-salas-de-aula/";

//UTM LEAD por GET
if(isset($_GET['utmlead'])){
  //Atualiza / Cria o Cookie
  setcookie("uniplena_utmlead", $_GET['utmlead'], time()+30*24*60*60);
  //Define as variáveis
  $utmlead = $_GET['utmlead'];
  $linkUTM = "?utmlead=".$utmlead;
}
//UTM por Cookie
elseif(isset($_COOKIE['uniplena_utmlead'])){
  //Define as variáveis
  $utmlead = $_COOKIE['uniplena_utmlead'];
  $linkUTM = "?utmlead=".$utmlead;
}
//Sem UTM
else{
  $utmlead = "";
  $linkUTM = "";
}
?>