<?php
    require_once __DIR__ . "/../model/funcionario.class.php";
    function cadastrarFuncionario($nome, $salario, $telefone) {
        $funcionario = new Funcionario(null, $nome, $salario, $telefone);
        $funcionario->cadastrar();

    }

    function pegaFuncionarioPeloId($id) {
        return Funcionario::pegaPorId($id);
    }

    function alterarFuncionario($id, $novoNome, $novoSalario, $novoTelefone) {
        $funcionario = Funcionario::pegaPorId($id);
        if ($funcionario) {
            $funcionario->nome = $novoNome;
            $funcionario->salario = $novoSalario;
            $funcionario->telefone = $novoTelefone;
            $funcionario->alterar();
        }
    }

    function removerFuncionario($id) {
        $funcionario = Funcionario::pegaPorId($id);
        if ($funcionario) {
             $funcionario->remover();
        }
    }

    function listarFuncionario($filtroNome) {
        $funcionarios = Funcionario::listar($filtroNome);
        echo "<table><thead><tr><th>Nome</th><th>Salário</th><th>Telefone</th>";
        echo "<th>Ação 1</th>";//NOVA LINHA
        echo "<th>Ação 2</th>";//NOVA LINHA
        echo "</tr></thead><tbody>";
        foreach($funcionarios as $funcionario) {
            echo "<tr><td>".$funcionario->nome."</td>";
            echo "<td>R$ ".$funcionario->salario."</td>";
            echo "<td>".$funcionario->telefone."</td>";
            echo "<td><a href='http://localhost/dev-web/padaria/telas/funcionario/cadastro_funcionario.php?id=".$funcionario->id."'><button type='submit'>Alterar</button></a></td>";
            echo "<td><form action='executa_acao_funcionario.php' method='post' class='remover'><input type='hidden' name='acao' value='remover'><input type='hidden' name='id' value='".$funcionario->id."'><button type='submit'>Remover</button></form></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

    function listarTodosFuncionarios() {
        return Funcionario::listar("");
    }
?>