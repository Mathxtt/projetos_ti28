<?php
include('conectadb.php');

// COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($retorno)) {
    $login = $tbl[1];
    $emal = $tbl[2];
    $senha = $tbl[3];
    $status = $tbl[4];
}
// BORA FAZER O UPDATE??

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $senha = $_POST['txtsenha'];
    $emai = $_POST['txtemail'];
    $status = $_POST['status'];

    $sql = "UPDATE tb_usuario SET usu_senha = '$senha', usu_status = '$status' WHERE usu_id = $id";

    mysqli_query($link, $sql);

    echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO');</script>";
    echo "<script>window.location.href='usuario-lista.php';</script>";
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

    <title>ALTERAÇÃO DE USUARIO</title>
</head>

<body>
    <div class="container-global">
        <!-- BOTÃO DE VOLTAR -->
        <a href="usuario-lista.php"><img src="icons/Navigation-left-01-256.png" width="25" height="25"></a>

        <form class="formulario" action="usuario-altera.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label>LOGIN</label>
            <input type="text" name="txtlogin" value="<?= $login ?>" required>
            <br>
            <label>SENHA</label>
            <input type="password" name="txtsenha" placeholder="Digite sua senha" value="<?= $senha ?>" required>
            <br>
            <label>EMAIL</label>
            <input type="text" name="txtemail" placeholder="Digite seu Email" value="<?= $email ?>" required>
            <br>

            <!-- SELETOR DE ATIVO E INATIVO -->
            <input type="radio" name="status" value="1" <?= $status == '1' ? "checkrd" : "" ?>>ATIVO
            <br>
            <input type="radio" name="status" value="0" <?= $status == '0' ? "checkrd" : "" ?>>INATIVO
            <br>
            <input type="submit" value="CONFIRMAR">
        </form>

    </div>

</body>

</html>