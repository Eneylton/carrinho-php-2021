<?php

$banco = ('mysql:host=localhost;dbname=db_carrinho');
$user = 'root';
$pass = '';

try{

    $pdo = new PDO($banco,$user,$pass);

}catch(PDOException $ex){

    echo 'Error:' .$ex->getMessage();
}

$select = $pdo->prepare("SELECT * FROM produto");

$select->execute();

$fetch = $select->fetchAll();

foreach ($fetch as $key ) {

    echo '<p>'.$key['nome']. '-'. $key['qtd']. '- R$ '.number_format($key['preco'],2,",", "."). '<a href="carrinho.php?add=carrinho&id='.$key['id'].'" >&nbsp; Adicionar </a>  </p>' ;
    
}