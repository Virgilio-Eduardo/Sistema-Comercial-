<?php 
include ('components/connect.php');

include ('components/seguranca_compra.php');


include ('components/function.php');


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

<section class="produto-form" >
    <?php 
    $select_produto = $conn ->prepare ("SELECT * FROM `produto` 
    WHERE id = ? LIMIT 1");
    $select_produto-> execute([$get_id1]);
    if ($select_produto-> rowCount() > 0){
        while($fetch_produto = $select_produto -> fetch (PDO::FETCH_ASSOC)){
        
        $produto_id  = $fetch_produto['id'];
    
    ?> 
    <form action="" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="produto_id" value="<?=$produto_id;?>">
    <h1 class="heading">Tamanhos do <span>produto</span></h1>
    
    <div class="box">
        <p>tamanho 01</p>
        <input type="text" name="tm1" class="input" maxlength="50" placeholder="Digite o tamanho 1"  >
    </div>
    
   
    <div class="flex">

    <div class="box">
        <p>tamanho 02</p>
        <input type="text" name="tm2" class="input" maxlength="50"  placeholder="Digite o tamanho 2" >
    </div>
    
    <div class="box">
        <p>tamanho 03</p>
        <input type="text" name="tm3" class="input" maxlength="50"  placeholder="Digite o tamanho 3"  >
    </div>
    
    <div class="box">
        <p>tamanho 04</p>
        <input type="text" name="tm4" class="input" maxlength="50"  placeholder="Digite o tamanho 4" >
    </div>
    
    <div class="box">
        <p>tamanho 05</p>
        <input type="text" name="tm5" class="input" maxlength="50" placeholder="Digite o tamanho 5" >
    </div>
    
    </div>

    <input type="submit" name="enviar_tamanho" value="enviar" class="btn">

    </form>

    <?php
   }
  }else{
   echo '<p class="empty">produto não foi encontrado!</p>';
  }
  
  ?>

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
