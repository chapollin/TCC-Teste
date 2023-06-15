<?php
session_start();
$valor = $_POST["valor"];
$descricao = $_POST["descricao"];
$cod_cliente = $_POST["cod_cliente"];

require_once ("../bd/bd_promissoria.php");

$dados = cadastraPromissoria($valor, $descricao,$cod_cliente);
if($dados == 1){
	$_SESSION['texto_sucesso'] = 'Promissoria cadastrada com sucesso.';
	unset($_SESSION['texto_erro']);
	header ("Location:promissoria.php");
}else{
	$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
	header ("Location:promissoria.php");
}


?>