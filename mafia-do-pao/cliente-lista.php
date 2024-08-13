<?php
include('conectadb.php');
include('topo.php');

// CONSUTA CLIENTES CADASTRADOS
$sql = "SELECT * FROM tb_clientes WHERE cli_status = '1'";

$retorno = mysqli_query($link, $sql);
$status = '1';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
    <title>LISTA CLIENTES</title>
</head>

<body>
    <a href="backoffice.php" class="btnsair"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-listaclientes">

        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?= $status == '1' ? "checked" : "" ?>>Ativos
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?= $status == '0' ? "checked" : "" ?>>Inativos
            <br>
        </form>
        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">

            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td>
                    <td><?= $tbl[2] ?></td>
                    <td><?= $tbl[3] ?></td>
                    <td><?= $tbl[4] ?></td>
                    <td><?= $tbl[5] ?></td>

                    <td><a href="cliente-altera.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR"></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>
</body>

</html>