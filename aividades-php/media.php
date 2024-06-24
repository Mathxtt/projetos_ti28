<?php

// $alunonota1 = 10;
// $alunonota2 = 8;
// $alunonota3 = 6;


// USANDO METODO GET PARA COLETA DE NOTAS
// PARA COLETAR DADOS USANDO GET [seuscript.php?suavariavel=seuvalor&outravariavel=outrovalor]
$n1 = $_GET['n1'];
$n2 = $_GET['n2'];
$n3 = $_GET['n3'];
$nome = $_GET['nome'];

echo("Nota 1: " . $n1 . "<br>" . "Nota 2: " . $n2 . "<br>" . "Nota 3: " . $n3 . "<br>");
echo("<br>");
echo("NOTA FINAL: ");
$Nfinal = ($n1 + $n2 + $n3) / 3;
echo("<br>");
echo("<br>");

if ($Nfinal >= 7)
{
    echo("APROVADO!");
}
else if ($Nfinal == 6)
{
    echo("RECUPERAÇÃO!");
}
else if ($Nfinal < 6)
{
    echo("REPROVADO!");
}
else
{
    echo("ERRO!");
}

echo("<br>");
echo("- - -");
echo("<br>");


// MODO HARD

echo("<br>");
$valor = (342 / 100) * 12;
echo("12% DE 342 = " . $valor."%");

?>