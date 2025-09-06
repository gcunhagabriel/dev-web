<?php
    include("../../model/produto.class.php");
    function cadastrarProduto($nome, $preco) {
        $produto = new Produto(null, $nome, $preco);
        $produto->cadastrar();

    }

    function pegaProdutoPeloId($id) {
        return Produto::pegaPorId($id);
    }

    function alterarProduto($id, $novoNome, $novoPreco) {
        $produto = Produto::pegaPorId($id);
        if ($produto) {
            $produto->nome = $novoNome;
            $produto->preco = $novoPreco;
            $produto->alterar();
        }
    }

    function removerProduto($id) {
        $produto = Produto::pegaPorId($id);
        if ($produto) {
             $produto->remover();
        }
    }

    function listarProduto($filtroNome) {
        $produtos = Produto::listar($filtroNome);
        echo "<table><thead><tr><th>Nome</th><th>Preço</th>";
        echo "<th>Ações</th>";//NOVA LINHA
        echo "</tr></thead><tbody>";
        foreach($produtos as $produto) {
            echo "<tr><td>".$produto->nome."</td>";
            echo "<td>".$produto->preco."</td>";
            echo "<td><a href='http://localhost/dev-web/padaria/telas/produto/cadastro_produto.php?id=".$produto->id."'><button type='submit'>Alterar</button></a></td>";
            echo "<td><form action='executa_acao_produto.php' method='post'><input type='hidden' name='acao' value='remover'><input type='hidden' name='id' value='".$produto->id."'><button type='submit'>Remover</button></form></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

    function listarTodosProdutos() {
        return Produto::listar("");
    }
?>