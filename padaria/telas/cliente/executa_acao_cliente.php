<?php
  include("../../service/cliente.service.php");
  $acao = $_POST['acao'];
  $nome = isset($_POST['nome'])?$_POST['nome']:null;
  $telefone = isset($_POST['telefone'])?$_POST['telefone']:null;
  $id = isset($_POST['id'])?$_POST['id']:null;
  if($acao=="cadastrar") {
    cadastrarCliente($nome, $telefone);
    echo "Cadastrado com sucesso";
  }
  else if($acao=="alterar") {
    alterarCliente($id, $nome, $telefone);
    echo "Alterado com sucesso";
  }
  else if($acao=="remover") {
    removerCliente($id);
    echo "Removido com sucesso";
  }
  else {
    echo "Ação inválida";
  }
?>