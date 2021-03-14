<?php

session_start();

foreach ($_SESSION['dados'] as $produtos) {
    $conexao = new PDO('mysql:host=localhost;dbname=db_carrinho', "root", "");

    $insert = $conexao->prepare("INSERT INTO pedidos () VALUES (NULL,?,?,?,?)");

    $insert->bindParam(1,$produtos['idProduto']);
    $insert->bindParam(2,$produtos['qtd']);
    $insert->bindParam(3,$produtos['preco']);
    $insert->bindParam(4,$produtos['total']);
    $insert->execute();
}