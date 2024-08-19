<?php
include("conectadb.php");
include('topo.php');

// A PAGINA CARREGOU... O QUE ELA VAI TRAZER?

// PESQUISA NO BANCO TODOS OS PRODUTOS DO BANCO
$sql = "SELECT * FROM tb_produtos";
$retorno = mysqli_query($link, $sql);

// FUNÇÃO APÓS CLICK DO RADIO ATIVO E INATIVO
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT * FROM tb_produtos WHERE pro_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM tb_produtos WHERE pro_status = '0'";
        $retorno = mysqli_query($link, $sql);
    }
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">
    <title>PRODUTOS LISTA</title>
</head>

<body>
    <a href="backoffice.php" class="btnsair"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

    <div class="container-listaproduto">

        <!-- LISTAR ATIVOS E INATIVOS -->
        <form action="produto-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()"
                <?= $status == '1' ? "checked" : "" ?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()"
                <?= $status == '0' ? "checked" : "" ?>>INATIVOS
            <br>
        </form>

        <!-- LISTAR A TABELA DE USUARIOS -->
        <table class="lista">

            <tr>
                <th>NOME PRODUTO</th>
                <th>QUANTIDADE</th>
                <th>UNIDADE</th>
                <th>PREÇO</th>
                <th>STATUS</th>
                <th>IMAGEM</th>
                <th>ALTERAR</th>
            </tr>

            <!-- O CHORO É LIVRE! CHOLA MAIS -->
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl[1] ?></td> <!-- COLETA O NOME DO PRODUTO -->
                    <td><?= $tbl[2] ?></td> <!-- COLETA O QTD PRODUTO -->
                    <td><?= $tbl[3] ?></td> <!-- COLETA A UNIDADE -->
                    <td><?= $tbl[4] ?></td> <!-- COLETA O PREÇO -->
                    <td><?= $tbl[5] == '1'?"ATIVO":"INATIVO" ?></td> <!-- COLETA O STATUS -->
                    <td><img src='data:image/jpeg;base64,<?= $tbl[6]?>' width="150" height="150"></td> <!-- COLETA A IMAGEM -->

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