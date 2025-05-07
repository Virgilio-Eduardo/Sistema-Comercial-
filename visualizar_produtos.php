<?php 
include ('../components/connect.php');

include ('../components/seguranca_compra.php');

include ('enviar_dados/apagar.php');


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../restrita/admin_style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />

                 
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <title>Painel</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>


<section class="my-listings">
  <h1 class="heading">Produtos <span>publicados</span></h1>

  <div class="box-container">
   <?php

   $select_listing = $conn->prepare("SELECT * FROM `produto`
    ORDER BY date DESC ");
    $select_listing->execute();

    if ($select_listing->rowCount() > 0){
      while($fetch_listing = $select_listing->fetch(PDO::FETCH_ASSOC)){
        

        
      $selecionar_tamanho= $conn -> prepare("SELECT * FROM `produto_quantidade_tamanho`
       WHERE produto_id = ? ");
      $selecionar_tamanho->execute([$fetch_listing['id']]);
      $buscar_tamanho = $selecionar_tamanho->fetch(PDO::FETCH_ASSOC);

      $tm1 = $buscar_tamanho['tm1'];
      $tm2 = $buscar_tamanho['tm2'];
      $tm3 = $buscar_tamanho['tm3'];
      $tm4 = $buscar_tamanho['tm4'];
      $tm5 = $buscar_tamanho['tm5'];

          
     $listing_id = $fetch_listing['id']; 

     $activo = $fetch_listing['activo'];

     if(!empty($fetch_listing['img2'])){
      $img2 = 1;
     } else{
      $img2 = 0;
     }

     if(!empty($fetch_listing['img3'])){
      $img3 = 1;
     } else{
      $img3 = 0;
     }

     if(!empty($fetch_listing['img4'])){
      $img4 = 1;
     } else{
      $img4 = 0;
     }

  

     $total_img =(1 + $img2 + $img3 + $img4 );


     $selecionar_users = $conn ->prepare("SELECT * FROM `users` WHERE id = ? ");
     $selecionar_users ->execute([$fetch_listing['user_id']]);
     $buscar_users = $selecionar_users->fetch(PDO::FETCH_ASSOC);


   ?>

   <form action="" method="POST" class="box">
    <input type="hidden" name="produto_id" value="<?= $listing_id;?>">

    <div class="users">

          <h3><?= substr($buscar_users['nome'], 0, 1);?></h3>
           <div>
             <p><?=$buscar_users['nome_loja'];?></p>
             <span><?=$fetch_listing['date'];?></span>

           </div>

        
    </div>
    <div class="thumb">
      <p><i class="far fa-image"></i><span><?= $total_img; ?></span></p>
      <img src="../uploaded_files/<?=$fetch_listing['img1'];?>" <?php if($nivel_acesso == 1){ ?>  onclick="window.location.href='update_produto.php?get_id=<?=$listing_id;?>'" <?php }?>  alt="">
    
    </div>

    <div class="ratting">
      <i class='bx bx-star'></i>
      <i class='bx bx-star'></i>
      <i class='bx bx-star'></i>
      <i class='bx bx-star'></i>
      <i class='bx bx-star-half'></i>
  
    </div>

    <div class="name"><?= $fetch_listing['nome_produto'];?></div>

    <div class="price"><i class="fas fa-indian
    -rupee-sign"><span>$</span></i><?= number_format($fetch_listing['preco']);?><span>mtcs</span></div>

    <div class="quantidade"><p>quantidade : <span><?= $fetch_listing['quantidade'];?></span></p></div>

    <div class="info_tamanho">
      <?php
      if ($selecionar_tamanho ->rowCount() > 0){

      ?>
      <p class = "tamanhos">Tamanhos :<span><?= $tm1?></span>  <span><?= $tm2?></span>  <span><?= $tm3?></span>  <span><?= $tm4?></span> <span><?= $tm5?></span></p>
  
     
    <?php } else{ ?>

      <p class="inf_tm">O produto esta indisponivel</p>

    <?php }?>
  

    
      
    </div>



    <div class="flex-btn">
    <a href="add_tamanho_produto.php?add_tamanho=<?=$listing_id;?>" class="btn">add </a>
     <?php   

      ?>

      <input type="submit" <?php if ($activo == 1) {?> value="inactivar" <?php }else{?> value="Activar"<?php }?> class="btn" name ="inactivar" onclick="return confirm('Deseja inactivar está publicação?');"  >

    </div>

   </form>
 
   <?php 
  }

  

}else{
  echo'<p class="empty">Nenhuma publicação encontrada</p>';
} 

   
   ?>

  </div>

</section>
<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>