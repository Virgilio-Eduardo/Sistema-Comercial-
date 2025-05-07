<?php 
 $produto_id = $_POST['produto_id'];
 $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

$verify_produto= $conn->prepare('SELECT * FROM `produto` WHERE id = ? AND activo = 0 ');
$verify_produto->execute([$produto_id]);

if($verify_produto->rowCount()>0){
    $verify_produto= $conn->prepare('SELECT * FROM `produto` WHERE id = ? AND activo = 0 ');
    $verify_produto->execute([$produto_id]);

    $warning_msg[]= 'Produto nao disponivel!';
    header('location:listings.php');
}


?>