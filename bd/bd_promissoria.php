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
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_compra, promissoria.data_vencimento, status.nome AS status
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              LEFT JOIN status ON promissoria.status = status.id
              WHERE cliente.cod = :codigo");
    $query->bindParam(":codigo", $codigoCliente);
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}


function cadastraPromissoria($valor, $descricao, $cod_cliente) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO promissoria (valor, descricao, data_compra, data_vencimento, cod_cliente, status) VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), ?, 2)");
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
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, cliente.cod AS 'cod_cliente', promissoria.descricao, promissoria.valor, promissoria.data_compra, promissoria.data_vencimento, promissoria.status FROM promissoria INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod WHERE promissoria.cod = :cod");
    $query->bindParam(':cod', $cod_promissoria, PDO::PARAM_INT);
    $query->execute();
    $promissoria = $query->fetch(PDO::FETCH_ASSOC);
    return $promissoria;
}
function editarPromissoria($codigo, $valor, $descricao, $cod_cliente, $status, $data_vencimento)
{
    $conexao = conecta_bd();
    $query = $conexao->prepare("UPDATE promissoria SET cod_cliente = :cod_cliente, descricao = :descricao, valor = :valor, status = :status, data_vencimento = :data_vencimento WHERE cod = :cod");
    $query->bindParam(':cod', $codigo, PDO::PARAM_INT);
    $query->bindParam(':cod_cliente', $cod_cliente, PDO::PARAM_INT);
    $query->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $query->bindParam(':valor', $valor, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':data_vencimento', $data_vencimento, PDO::PARAM_STR);
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

function listaPromissoriaNaoPagas() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, cliente.nome AS cliente_nome
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status IS NULL OR promissoria.status = 2");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaPromissoriaPagas() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, cliente.nome AS cliente_nome
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status IS NULL OR promissoria.status = 1");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaPromissoriaVencidas() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, cliente.nome AS cliente_nome
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status IS NULL OR promissoria.status = 3");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaPromissoriaPagas1() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, promissoria.status
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status = 1");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaPromissoriaVencidas1() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, promissoria.status
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status = 3");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaPromissoriaNaoPagas1() {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT promissoria.cod, cliente.nome, promissoria.descricao, promissoria.valor, promissoria.data_vencimento, promissoria.status
              FROM promissoria
              INNER JOIN cliente ON promissoria.cod_cliente = cliente.cod
              WHERE promissoria.status = 2");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}


?>