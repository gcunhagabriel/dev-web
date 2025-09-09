<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Tabela de Clientes</title>
</head>
<body>
    <form method="post">
        <label>Nome:</label><input name="filtro"/>
        <button>Filtrar</button>
    </form>
    <?php
    require_once __DIR__ . "/../../service/cliente.service.php";
    $filtro = isset($_POST["filtro"])?$_POST["filtro"]:"";
    listarCliente($filtro);
    ?>
</body>
</html>