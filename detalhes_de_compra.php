<?php 
include ('components/connect.php');

include ('components/seguranca_compra.php');

include ('components/enviar_dados.php');


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="restrita/restrita.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

         
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <title>Detalhes do comprador</title>
</head>
<body>

<?php include ('components/user_header.php'); ?>


<section class="produto-form" >
<?php

$select_listings = $conn -> prepare("SELECT * FROM `produto`
 ORDER BY date DESC  LIMIT 1 ");
 $select_listings ->execute();
 if ($select_listings ->rowCount() > 0){
  while($fetch_listings = $select_listings->fetch(PDO::FETCH_ASSOC)){

    $produto_id = $fetch_listings['id'];

?>

    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="produto_id" value = "<?=$produto_id;?>">

    <h1 class="heading">Detalhes do <span>comprador</span></h1>

      
    <div class="box">
    <p>nome completo <span>:</span></p>
      <input type="text" name="nome" maxlength="50" 
      required placeholder="Digite o seu nome completo " class="input" >
    </div>
    
    <div class="flex">
    <div class="box">
    <p>numero de telefone <span>:</span></p>
      <input type="number" name="numero" maxlength="11" 
      required placeholder="Digite o seu numero de telefone " class="input" >

    </div>

    <div class="box">
        
        <p>localizacao <span>:</span></p>
         <select name="localizacao" id=""  class="input">
          <option value="quelimane">Quelimane</option>
          <option value="beira">Beira</option>
          <option value="nampula">Nampula</option>
          <option value="maputo">Maputo</option>
          <option value="tete">Tete</option>
         </select>
    </div>
     
 
    </div>
    


    <input type="submit" name="enviar" value="enviar" class="btn">

    </form>
    <?php 

}

}else{
echo'<p class ="empty">Nenhum produto publicado!</p>';
}  
?>

</section>
<?php include ('components/message.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>

    <?php include ('components/message.php'); ?>

     
</body>
</html>