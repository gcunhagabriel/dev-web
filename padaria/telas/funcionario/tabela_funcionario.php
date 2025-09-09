<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Funcionários</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>
<body>
    <form method="post">
        <label>Nome:</label><input name="filtro"/>
        <button>Filtrar</button>
    </form>
    <?php
    require_once __DIR__ . "/../../service/funcionario.service.php";
    $filtro = isset($_POST["filtro"])?$_POST["filtro"]:"";
    listarFuncionario($filtro);
    ?>
</body>
</html>