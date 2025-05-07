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
     <link href="restrita/listings.css" rel="stylesheet"> 
     
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

<section class="comprar-form" >
<?php
$select_produto = $conn -> prepare("SELECT * FROM `produto` WHERE id = ? LIMIT 1 ");
$select_produto ->execute([$get_id]);

if($select_produto -> rowCount() > 0 ){
    while($fetch_produto = $select_produto ->fetch(PDO::FETCH_ASSOC)){
      $produto_id = $fetch_produto['id'];
      $preco = $fetch_produto['preco'];

      $select_user = $conn-> prepare("SELECT * FROM `users` WHERE 
      id = ? LIMIT 1");
      $select_user->execute([$fetch_produto['user_id']]);
      $fetch_user = $select_user ->fetch(PDO::FETCH_ASSOC);

      $select_saved = $conn-> prepare("SELECT * FROM `carrinho` WHERE 
      produto_id = ? AND user_id = ?");
      $select_saved->execute([$produto_id, $user_id]);

      $select_tamanho_produto = $conn ->prepare("SELECT * FROM `produto_quantidade_tamanho`
      WHERE produto_id = ? ");
      $select_tamanho_produto ->execute([$get_id]);
      
      while($buscar_tamanho = $select_tamanho_produto ->fetch(PDO::FETCH_ASSOC)){

          $tm1 = $buscar_tamanho['tm1'];
          $tm2 = $buscar_tamanho['tm2'];
          $tm3 = $buscar_tamanho['tm3'];
          $tm4 = $buscar_tamanho['tm4'];
          $tm5 = $buscar_tamanho['tm5'];
  

?>


   
        <div class="single-pro-image">
          <img src="uploaded_files/<?=$fetch_produto['img1'];?>" 
          alt="" class= "swiper-slide" id="MainImg" width="100%">
          
          <div class="small-img-group">

          <div class="small-img-col">
            <img src="uploaded_files/<?=$fetch_produto['img1'];?>" class="small_img" alt="" width="100%" >
            
            </div>

            <div class="small-img-col">
            <img src="uploaded_files/<?=$fetch_produto['img2'];?>" class="small_img" alt="" width="100%" >
            </div>

            <div class="small-img-col">
            <img src="uploaded_files/<?=$fetch_produto['img3'];?>" class="small_img" alt="" width="100%" >
            </div>

            <div class="small-img-col">
            <img src="uploaded_files/<?=$fetch_produto['img4'];?>" class="small_img" alt="" width="100%" >
            </div>


          </div>

  
      </div>

        
    <form action="" method="POST">
              <input type="hidden" name="produto_id" value = "<?=$produto_id;?>">
              <input type="hidden" name="preco" value = "<?=$preco;?>">
            <?php
              $select_produto_cat = $conn -> prepare("SELECT * FROM `produto` WHERE  categoria_produto = 1 ");
              $select_produto_cat->execute();

              if ($select_produto_cat ->rowCount()>0){
            ?>
            <div class="single-pro-details">
              <h6>Home/ <?=$fetch_produto['nome_produto'];?></h6>
              <h4 class="nome"><?=$fetch_produto['nome_produto'];?></h4>
              <p class="preco">$<?=number_format($fetch_produto['preco']);?> mtcs</p>
              <select name="tamanho" id="">
                <option value="<?=$tm1;?>" >Selecionar tamanho</option>        
                <option value='<?=$tm1;?>'><?=$tm1;?></option>
                <option value='<?=$tm2;?>'><?=$tm2;?> </option>
                <option value='<?=$tm3;?>'><?=$tm3;?> </option>
                <option value='<?=$tm4;?>'><?=$tm4;?></option>
                <option value='<?=$tm5;?>'><?=$tm5;?> </option>
         
              </select>

              <!--

                   <div class="tamanhos">
                <p class="tmnh">Tamanhos</p>
                <div class="variant">
                  <div class="tm">
                    <p>
                      <input type="radio" name="tamanho" id ="t1">
                      <label for="t1" class="circle"><span>S</span></label>
                    </p>
                    <p>
                    <input type="radio" name="tamanho" id ="t2">
                      <label for="t2" class="circle"><span>M</span></label>
                    </p>
                    <p>
                    <input type="radio" name="tamanho" id ="t3">
                      <label for="t3" class="circle"><span>P</span></label>
                    </p>
                    <p>
                    <input type="radio" name="tamanho" id ="t4">
                      <label for="t4" class="circle"><span>X</span></label>
                    </p>
                    <p>
                    <input type="radio" name="tamanho" id ="t5">
                      <label for="t5" class="circle"><span>XL</span></label>
                    </p>
                    

                  </div>
                </div>
              </div> -->

              <div class="actions">
              <div class="qtv">
                  <span onclick="decrement()">-</span>
                  <input type="text" value="1" id="quantidade" name="quantidade" readonly>
                  <span onclick="increment()">+</span>
                </div>
              </div>

              <!-- <input type="number" name="quantidade" value="1"  class="quantidade">-->

              <?php 
              }
              ?>

              
             <div class="flex-btn">

                <button type="submit" name="carrinho" class="save"><i class="fas fa-heart"></i> <span>adicionar</span></button>

                <input type="submit" value="comprar" name="comprar" class="btn">
              </div>
            </div>

            <h4 >Descricao</h4>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati
               mollitia voluptatum quasi! Saepe tenetur, quo cumque unde in natus obcaecati odio, error corporis, 
               eveniet quam nihil minus eaque molestias ratione!</span>

    </form>


<?php
    }

        }

        }else{
        echo '<p clas="empty"> produto nao  encontrado</p>';

        }

      

?>

</section>



<section class="listings">
    <h1 class="heading">Produtos <span>relacionados</span></h1>

    <div class="box-container">
      <?php
      $verificar_produt = $conn -> prepare("SELECT * FROM `produto` WHERE id = ? ");
      $verificar_produt ->execute([$get_id]);
      if ($verificar_produt ->rowCount()> 0){
        while($buscar_produt = $verificar_produt->fetch(PDO::FETCH_ASSOC)){

          $categoria_produto  = $buscar_produt['categoria_produto'];         
          $categoria = $buscar_produt['categoria'];    
      
      $select_listings = $conn -> prepare("SELECT * FROM `produto` WHERE categoria_produto = ? AND categoria = ?
       ORDER BY date DESC LIMIT 4");
       $select_listings ->execute([$categoria_produto, $categoria]);
       if ($select_listings ->rowCount() > 0){
        while($fetch_listings = $select_listings->fetch(PDO::FETCH_ASSOC)){

          $produto_id = $fetch_listings['id'];


          $select_users = $conn-> prepare("SELECT * FROM `users` WHERE id = ?");
          $select_users->execute([$fetch_listings['user_id']]);
          $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

          if(!empty($fetch_listings['img2'])){
            $count_img2 = 1;
          }else{
            $count_img2  = 0;
          }

          if(!empty($fetch_listings['img3'])){
            $count_img3 = 1;
          }else{
            $count_img3  = 0;
          }

          if(!empty($fetch_listings['img4'])){
            $count_img4 = 1;
          }else{
            $count_img4  = 0;
          }


          $total_img = (1 + $count_img2 + $count_img3 +
           $count_img4 );

          $select_saved = $conn->prepare("SELECT * FROM `carrinho` 
          WHERE produto_id = ? AND user_id = ?");
          $select_saved->execute([$produto_id, $user_id]);

      
          
          $verify_produto_tamanho = $conn ->prepare("SELECT * FROM `produto_quantidade_tamanho` WHERE produto_id = ? ");   
          $verify_produto_tamanho->execute([$produto_id]);

          if($verify_produto_tamanho ->rowCount()>0){

            $verify_produto_activo = $conn ->prepare("SELECT * FROM `produto` WHERE id = ? AND activo = 1 ");   
            $verify_produto_activo->execute([$produto_id]);
  
  
            if($verify_produto_activo ->rowCount()>0){

  
      ?>

      <form action="" method="POST">
    
        <input type="hidden" name="produto_id" value="<?= $produto_id;?>">


        <div class="thumb">
          <p class="total-img"><i clasd="fas fa-image"></i><span><?= $total_img;?></span></p>
          
        
            <p  class="sale">Sale</p>
        
          <?php  if ($select_saved->rowCount() > 0){?>

          <button type="submit" name="save" class="save"><i class="fas fa-heart"></i></button>

          <?php }else{?>
          <button type="submit" name="save" class="save"><i class="far fa-heart"></i></button>

          <?php }?>
          <img src="uploaded_files/<?=$fetch_listings['img1'];?>" 
          <?php if($nivel_acesso == 0){ ?>  onclick="window.location.href='comprar.php?get_id=<?=$produto_id;?>'" <?php }?> alt="">
          

        </div>

        <div class="ratting">
          <p><i class='bx bxs-star'></i></p>
          <p><i class='bx bxs-star'></i></p>
          <p><i class='bx bxs-star'></i></p>
          <p><i class='bx bxs-star'></i></p>
          <i class='bx bxs-star-half'></i>
          </div>
        
          <div class="box">
            <p class="nome"><?=$fetch_listings['nome_produto'];?></p>
            
          </div>

          <div class="bx">
          <p class="preco"><span>$</span><?=number_format($fetch_listings['preco']);?></p>
          <?php if($nivel_acesso == 0){ ?>
          <button type="submit" name="add_carrinho" class="btncart"><i class="bx bx-shopping-bag add-cart"></i></button>
          <?php }?>
          </div>

      
      </form>

      <?php 
    }

      }
      
       }

       }else{
       echo'<p class ="empty">Nenhum produto publicado!</p>';
       }  

      }

      }

      ?>


    </div> 

  </section>



    <script>

      var MainImg =document.getElementById("MainImg");
      var smallimg =document.getElementsByClassName("small_img");

      smallimg[0].onclick =function(){
        MainImg.src =smallimg[0].src;
      }

      smallimg[1].onclick =function(){
        MainImg.src =smallimg[1].src;
      }

      smallimg[2].onclick =function(){
        MainImg.src =smallimg[2].src;
      }

      smallimg[3].onclick =function(){
        MainImg.src =smallimg[3].src;
      }

    </script>


  <script>
    function decrement() {
      var quantidadeInput =document.getElementById('quantidade');
      var quantidade = parseInt (quantidadeInput.value, 10);

      if (quantidade > 1){
        quantidadeInput.value =quantidade - 1;
      }
    }

    function increment(){
      var quantidadeInput =document.getElementById('quantidade');
      var quantidade = parseInt (quantidadeInput.value, 10);

      quantidadeInput.value =quantidade + 1;

    }

  </script>





 






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
