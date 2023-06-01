<?php 
require_once("conecta_bd.php");

function listaPromissoria() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, status.nome as status
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              LEFT JOIN status ON promissoria.status = status.id");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}
function listaPromissoriaCliente($codigoCliente) {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_compra, promissoria.data_vencimento FROM promissoria, cliente WHERE promissoria.cod_cliente = cliente.cod AND cliente.cod = :codigo;");
    $query->bindParam(":codigo", $codigoCliente);
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function cadastraPromissoria($valor, $descricao,$data_compra,$data_vencimento,$cod_cliente) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO promissoria (valor, descricao, data_compra, data_vencimento, cod_cliente) VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), ?)");
    $query->bindParam(1, $valor);
    $query->bindParam(2, $descricao);
    $query->bindParam(3, $cod_cliente);
    $retorno = $query->execute();

    if ($retorno) {
        return 1;
    } else {
        return 0;
    }
}

function buscaPromissoria($cod_promissoria){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome,cliente.cod AS 'cod_cliente', promissoria.descricao, promissoria.valor, promissoria.data_compra,promissoria.data_vencimento FROM promissoria INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod WHERE promissoria.cod = :cod");
    $query->bindParam(':cod', $cod_promissoria, PDO::PARAM_INT);
    $query->execute();
    $promissoria = $query->fetch(PDO::FETCH_ASSOC);
    return $promissoria;
}
function editarPromissoria($codigo, $nome, $descricao, $valor)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("UPDATE promissoria SET cod_cliente = :cod_cliente, descricao = :descricao, valor = :valor WHERE cod = :cod");
    $query->bindParam(':cod', $codigo, PDO::PARAM_INT);
    $query->bindParam(':cod_cliente', $nome, PDO::PARAM_INT);
    $query->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $query->execute();
    return $query->rowCount();
}
function removerPromissora($codigo){
    $conexao = conecta_bd();
    $query = $conexao->prepare("DELETE FROM promissoria WHERE cod = :cod");
    $query->bindParam(':cod', $codigo, PDO::PARAM_INT);
    $query->execute();
    return $query->rowCount();
}
?>