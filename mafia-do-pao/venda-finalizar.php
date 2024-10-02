<?php
    include ("conectadb.php");
    include ("topo.php");
 
    //coletar dados post
 
$tipo_cupom = ""; //inicia a variavel caso não tenha cupom
 
//verifica a data de validade do cupom
$data_atual = date('Y-m-d');
$data_validade = '2000-01-01'; //inicia a variavel caso não tenha cupom (coloquei ano)
$desconto =""; //inicia a variavel caso não tenha cupom
 
 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idcliente = ($_POST['nomecliente']);
        $codigo = ($_POST['codigo']);
        //echo $codigo;
 
 
         #usado para fazer o total
         $total =0; //inicializando a variavel
         $valortotal = "SELECT SUM(iv_valortotal) FROM tb_item_venda WHERE iv_status =1";
         $retornovalortotal = mysqli_query($link, $valortotal);
 
         while($tblvalortotal = mysqli_fetch_array($retornovalortotal)){
             $total = $tblvalortotal[0];
         }
 
 
        #PESQUISA O CUPOM
        $sqlcupom ="SELECT * FROM tb_cupons WHERE codigo = '$codigo'";
        $retornocupom = mysqli_query($link, $sqlcupom);
        while ($tblcupom = mysqli_fetch_array($retornocupom)) {
            $desconto = $tblcupom[2];
            $tipo_cupom = $tblcupom[3];
            $data_validade = $tblcupom[4];
        }
 
    #ADD CUPOM
 
    if(strtotime($data_validade) >= strtotime($data_atual)) {
        //verifica se o cupom ja foi usado pelo cliente
        $sqlclientecupom ="SELECT COUNT(fk_cli_id) FROM tb_venda WHERE cupom = '$desconto'";
        $retornoclientecupom = mysqli_query($link, $sqlclientecupom);
        while ($tblclientecupom = mysqli_fetch_array($retornoclientecupom)) {
            $clientecupom = $tblclientecupom[0];
        }
         
    if($clientecupom < 1 and $idcliente != 1){ //idcliente 1 = vazio}
        echo 'cliente ok';
        //verifica  o tipo de desconto
        if($tipo_cupom == 'fixo'){
            $total -=$desconto;
        }
        else if ($tipo_cupom == 'porcentagem'){
            $total -= (($desconto*$total)/100);
        }else{
            $total = $total;
        }
    }
}else{
    $total = $total; //não precisa mas por precaução né
}
 
if($total < 0) {
    $total = 0;
}
                   
 
        #pesquisar os itens da compra
        $sql = "SELECT * FROM tb_item_venda WHERE iv_status = 1";
 
        #usado para fazer remção de itens no inventario
        $retornoproduto = mysqli_query($link, $sql);
 
       
 
 
#usando para finalização da venda
$retornocarrinho = mysqli_query($link, $sql);
$usuario = $_SESSION['idusuario'];
 
///////////////// realizar correção de verificação de item do inventario
 
 
 
#remoção de itens do inventario
while ($tblitem = mysqli_fetch_array($retornoproduto)){
    $produto_id = $tblitem[4];
    $quantidade_item = $tblitem[2];
 
    //consulta para obter a quantidade atual do produto
    $sqlproduto = "SELECT pro_quantidade FROM tb_produtos WHERE pro_id = $produto_id";
    $retornoproduto_info = mysqli_query($link, $sqlproduto);
 
    //atualização da quantidade de produtos
    if($row = mysqli_fetch_array($retornoproduto_info)){
        $quantidade_produto = $row[0];
        $nova_quantidade = $quantidade_produto - $quantidade_item;
        $sql_update_produto = "UPDATE tb_produtos SET pro_quantidade = $nova_quantidade WHERE pro_id = $produto_id";
        $resultado_update_produto = mysqli_query($link, $sql_update_produto);
    }
 
}
 
$data = date("Y-m-d H:i:s");
 
$tbl = mysqli_fetch_array($retornocarrinho);
 
$sqlvenda = "INSERT INTO tb_venda(ven_datavenda, ven_totalvenda, fk_iv_cod_iv, fk_cli_id, fk_usu_id, cupom) VALUES('$data', $total, '$tbl[3]', $idcliente, $usuario, '$codigo')";
mysqli_query($link, $sqlvenda);
 
 
 #TROCAR O STATUS DA VENDA PARA FECHADO
 $sqlfechavenda ="UPDATE tb_item_venda SET iv_status=0 WHERE iv_status=1";
 mysqli_query($link, $sqlfechavenda);
 
 header("Location: venda-lista.php");
 
 
 
 
}
 
?>