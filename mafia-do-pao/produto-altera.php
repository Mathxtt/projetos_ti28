<?php
include("conectadb.php");
include('topo.php');

// PREENCHIMENTO DOS TEXTOS
$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nomeproduto = $tbl[1];
    $quantidade = $tbl[2];
    $unidade = $tbl[3];
    $preco = $tbl[4];
    $status = $tbl[5];
    $imagem = $tbl[6];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ALTERAÇÃO DE PRODUTO</title>
</head>
 
<body>
    <div class="container-global">
 
        <form class="formulario" action="produto-altera.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
 
        <label>NOME PRODUTO</label>
            <input type="text" name="txtproduto" placeholder="DIGITE SEU PRODUTO" value="<?=$nomeproduto?>" required>
            <br>
 
            <label>QUANTIDADE</label>
            <input type="decimal" name="txtqtd" placeholder="DIGITE A QUANTIDADE" value="<?=$quantidade?>" required>
            <br>
 
            <label>UNIDADE</label>
            <select name="txtunidade" value="<?=$unidade?>">
                <option value=""><?= strtoupper($unidade)?></option>
                <option value="kg">KG</option>
                <option value="g">G</option>
                <option value="un">UN</option>
                <option value="lt">LT</option>
            </select>
            <br>
 
            <label>PREÇO</label>
            <input type="decimal" name="txtpreco" placeholder="DIGITE O PREÇO" value="<?=$preco?>" required>
            <br>
 
            <label>IBAGEM</label>
            <img src="data:image/jpeg;base64,<?= $imagem?>"width="100px" height="100px">
            <input type="file" name="imagem" value="<?=$imagem?>" id="imagem">
            <br>
            <div class="bullets">
                <input type="radio" name="status" value="1" <?= $status == '1' ? "checked" : "" ?>>ATIVO
                <input type="radio" name="status" value="0" <?= $status == '0' ? "checked" : "" ?>>INATIVO
            </div>
            <br>
            <input type="submit" value="ALTERAR">
        </form>
        <script src="scripts/script.js"></script>
    </div>
</body>
 
</html>