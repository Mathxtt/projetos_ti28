<?php
 
include('conectadb.php');
include('topo.php');
 
//vamo cadastra o produto
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $codigo = $_POST['txtcodigo'];
    $desconto = $_POST['txtdesconto'];
    $tipo_desconto = $_POST['txttipo'];
    $validade = $_POST['txtvalidade'];
   
 
 
// verifica se cupom existe
$sql = "SELECT COUNT(id) FROM tb_cupons WHERE codigo = '$codigo'";
 
$retorno = mysqli_query($link, $sql);
$contagem = mysqli_fetch_array($retorno)[0];
 
 
if($contagem == 0){
 
    $sql = "INSERT INTO tb_cupons(codigo,desconto,tipo_desconto,validade,usado)
    VALUES ('$codigo',$desconto,'$tipo_desconto','$validade','1')";
echo $sql;
    $retorno = mysqli_query($link, $sql);
 
    echo"<script>window.alert('CUPOM CADASTRADO!');</script>";
    echo"<script>window.location.href='lista-cupom.php';</script>";
}
else{
    echo"<script>window.alert('CUPOM JA EXISTENTE MEU BOM!!');</script>";
}
 
};
?>
 
 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Cadastra Cupom</title>
</head>
<body>
<br>
    <div class="container-global">
    <form class="formulario" action="cupom-lista.php" method="post" enctype="multipart/form-data">
    <label>Codigo</label>
            <input type="varchar" name="txtcodigo" placeholder="Digite o Codigo" required>
        <br>
        <label>Desconto</label>
            <input type="decimal" name="txtdesconto" placeholder="Digite Desconto" required>
        <br>
            <label>Tipo de Cupom</label>
            <select name="txttipo">
                <option value="porcentagem">Porcentagem</option>
                <option value="fixo">Fixo</option>
             </select>
        <br>
        <label>Validade</label>
            <input type="date" name="txtvalidade" placeholder="Validade" required>
        <br>
       
 
        <input type="submit" value="CADASTRAR CUPOM">
    </form>
 
 
    </div>
   
</body>
</html>