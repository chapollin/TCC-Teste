<?php 

require_once("conecta_bd.php");

function checaCliente($email) {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * 
              FROM cliente
              WHERE email= ?");

    $query->bindParam(1, $email);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}

function listaClienteOrdemAlfabetica(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM cliente ORDER BY nome");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function editarPerfilCliente($codigo, $nome, $cpf, $email, $endereco, $numero, $bairro, $cidade, $telefone) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM cliente WHERE cod = ?");
    $query->bindParam(1, $codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if (count($retorno) > 0) {
        $query = $conexao->prepare("UPDATE cliente SET nome = ?, cpf = ?, email = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, telefone = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $cpf);
        $query->bindParam(3, $email);
        $query->bindParam(4, $endereco);
        $query->bindParam(5, $numero);
        $query->bindParam(6, $bairro);
        $query->bindParam(7, $cidade);
        $query->bindParam(8, $telefone);
        $query->bindParam(9, $codigo);
        $retorno = $query->execute(); // retorno boolean padrão TRUE
        if ($retorno) {
            return 1;
        } else {
            return 0;
        }
    }
}
function cadastraCliente($nome, $cpf,  $email, $endereco, $numero, $bairro, $cidade, $telefone) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO cliente (nome, cpf, email, endereco, numero, bairro, cidade, telefone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bindParam(1, $nome);
    $query->bindParam(2, $cpf);
    $query->bindParam(3, $email);
    $query->bindParam(4, $endereco);
    $query->bindParam(5, $numero);
    $query->bindParam(6, $bairro);
    $query->bindParam(7, $cidade);
    $query->bindParam(8, $telefone);
    $retorno = $query->execute();

    if ($retorno) {
        return 1;
    } else {
        return 0;
    }
}
function buscaClienteeditar($codigo) {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM cliente WHERE cod = ?");
    $query->bindParam(1, $codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    return $retorno;
}
function buscaCliente($email) {
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT * FROM cliente WHERE email = ?");
    $query->bindParam(1, $email);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    return $retorno;
}
function removeCliente($codigo){
    $conexao = conecta_bd();
    $query = $conexao->prepare("DELETE FROM cliente WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    return $query->rowCount();
}
function editarCliente($codigo, $nome, $cpf, $email, $endereco, $numero, $bairro, $cidade, $telefone) {
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM cliente WHERE cod = ?");
    $query->bindParam(1, $codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if (count($retorno) > 0) {
        $query = $conexao->prepare("UPDATE cliente SET nome = ?, cpf = ?, email = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, telefone = ? WHERE cod = ?");
        $query->bindParam(1, $nome);
        $query->bindParam(2, $cpf);
        $query->bindParam(3, $email);
        $query->bindParam(4, $endereco);
        $query->bindParam(5, $numero);
        $query->bindParam(6, $bairro);
        $query->bindParam(7, $cidade);
        $query->bindParam(8, $telefone);
        $query->bindParam(9, $codigo);
        $retorno = $query->execute(); // retorno boolean padrão TRUE
        if ($retorno) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>