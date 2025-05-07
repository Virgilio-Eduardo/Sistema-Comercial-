<?php 
include ('components/connect.php');

include ('components/seguranca_compra.php');


include ('components/enviar_dados.php');




if (isset($_POST['delete'])){

  $delete_id = $_POST['produto_id'];
  $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

  $verify_delete= $conn->prepare('SELECT * FROM `produto` WHERE id = ? ');
  $verify_delete->execute([$delete_id]);

  if ($verify_delete ->rowCount() > 0){
    $select_images = $conn ->prepare('SELECT * FROM `produto` 
    WHERE id = ? LIMIT 1');
    $select_images ->execute([$delete_id]);
    $fetch_image = $select_images ->fetch(PDO::FETCH_ASSOC);
    $delete_img1 = $fetch_image['img1'];
    $delete_img2 = $fetch_image['img2'];
    $delete_img3 = $fetch_image['img3'];
    $delete_img4 = $fetch_image['img4'];
  

    unlink('uploaded_files/'.$delete_img1);

    unlink('uploaded_files/'.$delete_img2);

    unlink('uploaded_files/'.$delete_img3);

    unlink('uploaded_files/'.$delete_img4);




    $delete_listing = $conn->prepare('DELETE FROM `produto` 
    WHERE id = ? ');
    $delete_listing->execute([$delete_id]);

    $delete_carrinho_produto = $conn->prepare('DELETE FROM `carrinho` 
    WHERE  produto_id = ?');
    $delete_carrinho_produto->execute([$delete_id]);

    
    $sucess_msg[] = 'Publicação apagada';



  }else{
    $warning_msg[] ='Publicação já deletado';
  }


}


if (isset($_POST['inactivar'])){
  if($user_id !='' || $nivel_acesso==1){

  $inactivar = $_POST['produto_id'];
  $inactivar = filter_var($inactivar, FILTER_SANITIZE_STRING);

  $verify_produto= $conn->prepare('SELECT * FROM `produto` WHERE id = ? AND user_id =? ');
  $verify_produto->execute([$inactivar, $user_id]);

  if ($verify_produto->rowCount() > 0){

    $verify_activo= $conn->prepare('SELECT * FROM `produto` WHERE id = ? AND user_id =? AND activo = 1 ');
    $verify_activo->execute([$inactivar, $user_id]);

    if($verify_activo->rowCount()>0){
      
    $update_activo = $conn -> prepare ("UPDATE `produto` SET
    activo = ? WHERE id = ?");
    $update_activo -> execute([0, $inactivar]);    
     $sucess_msg[] = 'Publicação inactivo';

    }else{

      $update_activo = $conn -> prepare ("UPDATE `produto` SET
      activo = ? WHERE id = ?");
      $update_activo -> execute([1, $inactivar]);    
       $sucess_msg[] = 'Publicação inactivo';

    }



  }else{

  }

  
}else{

}

}


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

      <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>

                 
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>Lista</title>
</head>

   

<body> 

<div class="site page_single">


<?php include ('components/menu_escondido.php'); ?>

<?php include ('components/user_header.php'); ?>


<?php
  include ('components/bar_pesquisar.php');
 
?>

<section class="my-listings">
  <h1 class="heading">Meus <span>produtos</span></h1>

  <div class="box-container">
   <?php

   $select_listing = $conn->prepare("SELECT * FROM `produto`
    WHERE user_id = ? ORDER BY date DESC ");
    $select_listing->execute([$user_id]);

    if ($select_listing->rowCount() > 0){
      while($fetch_listing = $select_listing->fetch(PDO::FETCH_ASSOC)){
        
       $selecionar_tamanho= $conn -> prepare("SELECT * FROM `produto_quantidade_tamanho`
        WHERE produto_id = ? AND user_id = ?");
       $selecionar_tamanho->execute([$fetch_listing['id'], $user_id]);
       $buscar_tamanho = $selecionar_tamanho->fetch(PDO::FETCH_ASSOC);

       if($selecionar_tamanho->rowCount()> 0){
       
       $tm1 = $buscar_tamanho['tm1'];
       $tm2 = $buscar_tamanho['tm2'];
       $tm3 = $buscar_tamanho['tm3'];
       $tm4 = $buscar_tamanho['tm4'];
       $tm5 = $buscar_tamanho['tm5'];

       }
        


          
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

   ?>

   <form action="" method="POST" class="box">
    <input type="hidden" name="produto_id" value="<?= $listing_id;?>">
    <div class="thumb">
      <p><i class="far fa-image"></i><span><?= $total_img; ?></span></p>
      <img src="uploaded_files/<?=$fetch_listing['img1'];?>" <?php if($nivel_acesso == 1){ ?>  onclick="window.location.href='update_produto.php?get_id=<?=$listing_id;?>'" <?php }?>  alt="">
    
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

      <p class="inf_tm">O produto esta indisponivel, por favor adicione os tamanhos do produto!</p>

    <?php }?>
  

    
      
    </div>



    <div class="flex-btn">
    <a href="add_tamanho_produto.php?add_tamanho=<?=$listing_id;?>" class="btn">add tamanhos</a>
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




<div class="menu-bottom desktop-hide">
  <div class="container">
    <div class="wrapper">
      <nav>
        <ul class="flexitem">
          <li>
            <a href="#">
              <i class="ri-bar-chart-line">T</i>
              <span>Tendencias</span>
            </a>
          </li>

          <li>
            <a href="#">
              <i class="ri-user-6-line">C</i>
              <span>Conta</span>
            </a>
          </li>

          <li>
            <a href="#0">
              <i class="ri-shopping-cart-line">T</i>
              <span>Carrinho</span>
              <div class="fly-item">
                <span class="item-number">0</span>
              </div>
            </a>
          </li>

          <li>
            <a href="#0" class="t-search" >
              <i class="ri-bar-search-line">P</i>
              <span>Pesquisar</span>
            </a>
          </li>

          <li>
            <a href="#" >
              <i class="ri-bar-search-line">M</i>
              <span>Mensagem</span>
              <div class="fly-item">
                <span class="item-number">0</span>
              </div>
            </a>
          </li>

          
        </ul>
      </nav>
    </div>
  </div>
</div>

<div class="search-bottom desktop-hide">
  <div class="container">
    <div class="wrapper">
    <form action="" class="search">
      <a href="#0" class="t-close search-close flexcenter">x<i class="ri-close-line"></i></a>
      <span class="icon-large"><i class="ri-search-line"></i></span>
      <input type="search" placeholder="Digite o nome do produto" required>
      <button type="submit"> Pesquisar</button>
    </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>

<?php include ('components/footer.php'); ?>


</div>
    
</body>

</html>
