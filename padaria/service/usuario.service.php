<?php
    require_once __DIR__ . "/../model/usuario.class.php";
    function cadastrarUsuario($nome, $email, $senha) {
        $usuario = new Usuario(null, $nome, $email, $senha);
        $usuario->cadastrar();

    }

    function pegaUsuarioPeloId($id) {
        return Usuario::pegaPorId($id);
    }

    function alterarUsuario($id, $novoNome, $novoEmail, $novaSenha) {
        $usuario = Usuario::pegaPorId($id);
        if ($usuario) {
            $usuario->nome = $novoNome;
            $usuario->email = $novoEmail;
            $usuario->senha = $novaSenha;
            $usuario->alterar();
        }
    }

    function removerUsuario($id) {
        $usuario = Usuario::pegaPorId($id);
        if ($usuario) {
             $usuario->remover();
        }
    }

    function listarUsuario($filtroNome) {
        $usuarios = Usuario::listar($filtroNome);
        echo "<table><thead><tr><th>Nome</th><th>E-mail</th><th>Senha</th>";
        echo "<th>Ação 1</th>";//NOVA LINHA
        echo "<th>Ação 2</th>";//NOVA LINHA
        echo "</tr></thead><tbody>";
        foreach($usuarios as $usuario) {
            echo "<tr><td>".$usuario->nome."</td>";
            echo "<td>".$usuario->email."</td>";
            echo "<td>".$usuario->senha."</td>";
            echo "<td><a href='http://localhost/dev-web/padaria/telas/usuario/cadastro_usuario.php?id=".$usuario->id."'><button type='submit'>Alterar</button></a></td>";
            echo "<td><form action='executa_acao_usuario.php' method='post' class='remover'><input type='hidden' name='acao' value='remover'><input type='hidden' name='id' value='".$usuario->id."'><button type='submit'>Remover</button></form></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";

    }

    function listarTodosUsuarios() {
        return Usuario::listar("");
    }
?>