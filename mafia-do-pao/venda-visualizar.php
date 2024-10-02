<?php
include("conectadb.php");
include("topo.php");

$id = $_GET['id'];
$sql = "SELECT pro.pro_id, pro.pro_nome, pro.pro_imagem, pro.pro_preco,
iv.iv_quantidade, iv.iv_valortotal, iv.iv_id, iv.iv_cod_iv FROM tb_produtos pro
JOIN tb_item_venda iv ON pro.pro_id = iv.fk_pro_id WHERE iv.iv_cod_iv = '$id';";

$retorno = mysqli_query($link, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>VENDAS</title>
</head>
<body>

<br>
    <div class="container-listaclientes">
 
    <table class="lista">
        <tr>
             <br><br>

            <th>ID</th>
            <th>NOME</th>
            <th>quantidade</th>  
            <th>VALOR</th>
            <th>IMAGEM</th>
           
 
        </tr>
 
        <?php
        while($tbl = mysqli_fetch_array($retorno)){
            ?>
            <tr>
               
                <td><?=$tbl[0]?></td>
                <td><?=$tbl[1]?></td>
                <td><?=$tbl[4]?></td>
                <td><?=$tbl[3]?></td>
                <td><img src='data:image/jpeg;base64,<?=$tbl[2]?>' width="120" height="120"></td>
                
               
            </tr>
            <?php
        }
        ?>
    </table>
 
    </div>

    
</body>
</html>