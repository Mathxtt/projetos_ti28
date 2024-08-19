<?php
include('conectadb.php');
include('topo.php');

// COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $id = $tbl[0];
    $cpf = $tbl[1];
    $nome = $tbl[2];
    $email = $tbl[3];
    $cel = $tbl[4];
    $status = $tbl[5];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $cel = $_POST['txtcel'];
    $status = $_POST['txtstatus'];

    $sql = "UPDATE tb_clientes SET cli_nome = '$nome', cli_email = '$email', cli_status = '$status' WHERE cli_id = $id";
    mysqli_query($link, $sql);

    echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='cliente-lista.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://fonts.cdnfonts.com/css/curely" rel="stylesheet">

    <title>ALTERAÇÃO DE CLIENTE</title>
</head>

<body>
    <div class="container-global">
        <!-- BOTÃO DE VOLTAR -->
        <a href="cliente-lista.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

        <form class="formulario" action="cliente-altera.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label>NOME</label>
            <input type="text" name="txtnome" value="<?= $nome ?>" requered>
            <br>
            <label>EMAIL</label>
            <input type="email" name="txtemail" placeholder="Digite seu email" value="<?= $email ?>" requered>
            <br>
            <label>TELEFONE</label>
            <input type="text" name="txtcel" placeholder="Digite seu telefone" value="<?= $cel ?>" requered>
            <br>

            <!-- SELETOR DE ATIVO E INATIVO -->
            <input type="radio" name="status" value="1" <?= $status == '1' ? "checked" : "" ?>>ATIVO
            <input type="radio" name="status" value="0" <?= $status == '0' ? "checked" : "" ?>>INATIVO
            <br>
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>
    </div>

</body>

</html>