<?php
session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $user_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
  $info_msg[] ='Faça login, se não tens conta, cadastra-se!';
header('location:login.php');
}

  if (isset($_GET['add_tamanho'])){
    $get_id = $_GET['add_tamanho'];
  
  }else{
    $get_id = '';
    header('location:login.php');
  }

?>