<?php

session_start();

if (!isset($_SESSION['itens'])) {

    $_SESSION['itens'] = array();
}

// ADICIONA AO CARINHO

if (isset($_GET['add']) && $_GET['add'] == "carrinho") {

    $idProduto = $_GET['id'];

    if (!isset($_SESSION['itens'][$idProduto])) {

        $_SESSION['itens'][$idProduto]  = 1;
    } else {

        $_SESSION['itens'][$idProduto]  += 1;
    }
}

// EXIBIR CARRINHO

if (count($_SESSION['itens']) == 0) {
    echo 'Carrinho Está vazio <a href="index.php"> Adiconar Itens </a>';
} else {

    $conexao = new PDO('mysql:host=localhost;dbname=db_carrinho', "root", "");

    $_SESSION['dados'] = array();

    foreach ($_SESSION['itens'] as $idProduto => $qtd) {
        $select = $conexao->prepare("SELECT * FROM produto WHERE id = ?");
        $select->bindParam(1, $idProduto);
        $select->execute();
        $produtos = $select->fetchAll();
        $total = $qtd * $produtos[0]["preco"];

        echo 'Nome: ' . $produtos[0]["nome"] . '<br/>
    
         preço: R$ ' . number_format($produtos[0]["preco"], 2, ",", ".") . '</br>
         Qunatidade: ' . $qtd . '<br /> 
         Total: R$ ' . number_format($total, "2", ",", ".") . '
         <a href="remover.php?remover=carrinho&id=' . $idProduto . '" > Remover </a>
         <hr/>';

        array_push(
            $_SESSION['dados'],

            array(
                'idProduto' => $idProduto,
                'qtd'     => $qtd,
                'preco'   => $produtos[0]["preco"],
                'total'   => $total
            )
        );
    }
}
echo '<a href="finalizar.php" >Finalizar Pedido </a>';
