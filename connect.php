<?php

$servidor='localhost';
$banco='home_db';
$usuario = 'root';
$senha = '';

try{
$conn = new PDO("mysql:host=$servidor; dbname=$banco",$usuario, $senha);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $erro) {
    echo "Falha ao se conectar com o banco!" .$erro->getMessage();
}

function create_unique_id(){
    $char =
    '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPKLSTUVWXYZ';
    $char_len =strlen($char);
    $rand_str ='';
    for ($i = 0; $i<20 ; $i++){
        $rand_str.= $char[mt_rand(0, $char_len - 1)];
    }
    return $rand_str;

}



 ?>