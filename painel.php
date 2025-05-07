<?php 

include ('components/connect.php');

include ('components/seguranca_compra.php');


include ('components/enviar_dados.php');

include ('components/enviar_confirmado.php');

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

    <title>Painel</title>
</head>

   

<body> 

<div class="site page_single">


<?php include ('components/menu_escondido.php'); ?>

<?php include ('components/user_header.php'); ?>


<?php
  include ('components/bar_pesquisar.php');
 
?>


<section class="dashboard">
  <div class="box-container">
   <div class="box">
    <?php
    $select_user = $conn-> prepare("SELECT * FROM `users` WHERE id = ?
    LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    ?>

    <h3>Bem-Vindo</h3>
    <p><?= $fetch_user['nome'];?></p>
    <a href="atualizar_dados.php" class="btn">Atualizar</a>
   </div>

   <div class="box">
      <h3>Publicar produto</h3>
      <p>Coloque um produto a venda</p>
      <a href="publicar_produto.php" class="btn">Publicar</a>
   </div>

   <div class="box">
      <?php 
      $count_produto = $conn -> prepare("SELECT * FROM `produto`
      WHERE user_id = ?");
      $count_produto ->execute([$user_id]);
      $buscar_total_produto = $count_produto->rowCount();

      ?>

      <h3><?=$buscar_total_produto;?></h3>
      <p>Produto publicados</p>
      <a href="my_listings.php" class="btn">Visualizar</a>

   </div>

   <div class="box">
      <?php 

      ?>

      <h3>Insights</h3>
      <p>Visualizar</p>
      <a href="my_listings.php" class="btn">Visualizar</a>

   </div>



   <div class="box">

    <h3>0</h3>
    <p>mensagens recebidas</p>
    <a href="mensagens.php" class="btn">Visualizar</a>

   </div>

   <div class="box">


    <h3>Conta</h3>
    <p>Compras recebidas</p>
    <a href="minha_conta.php" class="btn">Visualizar</a>

   </div>
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
