<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];



// include ("header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>HOME PRINCIPAL</title>
</head>

<body>
    <div class="container-home">
        <div class="topo">
             <?php
                if($nomeusuario != null){
                ?>
                <li class="perfil"><label>Bem Vindo <?= strtoupper($nomeusuario) ?></label></li>
            <?php
                }
                else{
                    echo("<script>window.alert('USUARIO NÃO LOGADO');
                    window.location.href='login.php';</script>");
                }
                ?> 
            <a href="logout.php"><img src='icons/Exit-02-WF-256.png' width="45" height="45"></a>
        </div>

        <!-- BOTÕES DE MENU -->
        <div class="menu">
            <a href="usuario-cadastro.php"><span class="tooltiptext">CADASTRAR USUARIO</span><img src="./icons/user-add.png"></a>
            <a href="usuario-lista.php"><span class="tooltiptext">LISTAR USUARIOS</span><img src="./icons/user-find.png"></a>
            <a href="produto-cadastra.php"><span class="tooltiptext">CADASTRAR PRODUTO</span><img src="./icons/box.png"></a>
            <a href="produto-lista.php"><span class="tooltiptext">LISTAR PRODUTOS</span><img src="./icons/gantt.png"></a>
            <a href="cliente-cadastro.php"><span class="tooltiptext">CADASTRAR CLIENTE</span><img src="./icons/customer.png"></a>
            <a href="cliente-lista.php"><span class="tooltiptext">LISTAR CLIENTE</span><img src="./icons/people.png"></a>
            <a href="vendas.php"><span class="tooltiptext">vendas</span><img src="./icons/shopping-cart-02.png"></a>

        </div>
    </div>

</body>

</html>