<?php 
include ('components/connect.php');

include ('components/seguranca.php');

include ('functions/functions.php');


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

<?php 
   if($nivel_acesso == 1){ 

include ('components/categoria_menu.php'); 

   }
?>

<?php 
   if($nivel_acesso != 1){ 

    include ('components/slider.php'); 

   }
?>



  <!--Imoveis-->

  <div class="trending">
    <div class="container">
      <div class="wrapper">
        <div class="sectop flexitem">
          <h2><span class="circle"> </span><span>Novas Tendencias</span></h2>
        </div>

        <div class="column">
          <div class="flexwrap">
            <div class="row products big">
              <div class="item">
                <div class="offer">
                  <p>Limite da oferta</p>
                  <ul class="flexcenter">
                    <li>1</li>
                    <li>15</li>
                    <li>27</li>
                    <li>60</li>
                  </ul>
                </div>
                <div class="media">
                  <div class="image">
                    <a href="#">
                      <img src="img/2.jpg" alt="">
                    </a>
                  </div>

                  <div class="hoverable">
                    <ul>
                      <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                      <li><a href=""><i class="ri-eye-line"></i></a></li>
                      <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                    </ul>
                  </div>

                  <div class="discount circle flexcenter"><span>31%</span></div>
                </div>
                <div class="content">
                  <div class="rating">
                    <div class="stars"></div>
                    <span class="mini-text">(2,548)</span>
                  </div>
                   <h3 class="main-links"><a href="#">Happy Sailed Wamens Summer Boho Floral</a></h3>

                   <div class="price">
                      <span class="current">$129.99</span>
                      <span class="normal mini-text">$189.98</span>
                  </div>

                  <div class="stock mini-text">
                    <div class="qty">
                      <span>estoque<strong class="qty-available">107</strong></span>
                      <span>vendido<strong class="qty-available">2.400</strong></span>
                      
                    </div>
                    <div class="bar">
                      <div class="avalible"></div>
                    </div>
                  </div>
                </div>
             </div>
            </div>
            <div class="row products mini">
             <div class="item">
               
                <div class="media">
                  <div class="thumbnail object-cover">
                    <a href="#">
                      <img src="products/shoe5.jpg" alt="">
                    </a>
                  </div>

                  <div class="hoverable">
                    <ul>
                      <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                      <li><a href=""><i class="ri-eye-line"></i></a></li>
                      <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                    </ul>
                  </div>

                  <div class="discount circle flexcenter"><span>31%</span></div>
                </div>
                <div class="content">
                  
                   <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                  <div class="rating">
                    <div class="stars"></div>
                    <span class="mini-text">(2,548)</span>
                  </div>

                   <div class="price">
                      <span class="current">$129.99</span>
                      <span class="normal mini-text">$189.98</span>
                  </div>

                  <div class="mini-text">
                    <p>292 vendido</p>
                    <p>frete gratis</p>

                  </div>

                 
                </div>
             </div>
             <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="products/shoe1-1.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>
            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="products/electronic4.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>
            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="products/electronic2.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>
            </div>
            <div class="row products mini">
            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="products/electronic1.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                    <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                  <div class="rating">
                    <div class="stars"></div>
                    <span class="mini-text">(2,548)</span>
                  </div>

                    <div class="price">
                      <span class="current">$129.99</span>
                      <span class="normal mini-text">$189.98</span>
                  </div>

                  <div class="mini-text">
                    <p>292 vendido</p>
                    <p>frete gratis</p>

                  </div>
  
               </div>

            </div>
            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="products/shoe1-3.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>

            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="img/f5.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>

            <div class="item">
               
               <div class="media">
                 <div class="thumbnail object-cover">
                   <a href="#">
                     <img src="img/f7.jpg" alt="">
                   </a>
                 </div>

                 <div class="hoverable">
                   <ul>
                     <li class="active"><a href=""><i class="ri-heart-line"></i></a></li>
                     <li><a href=""><i class="ri-eye-line"></i></a></li>
                     <li><a href=""><i class="ri-shuffle-line"></i></a></li>
                   </ul>
                 </div>

                 <div class="discount circle flexcenter"><span>31%</span></div>
               </div>
               <div class="content">
                 
                  <h3 class="main-links"><a href="#">Nike Air force Black novas tendencias</a></h3>

                 <div class="rating">
                   <div class="stars"></div>
                   <span class="mini-text">(2,548)</span>
                 </div>

                  <div class="price">
                     <span class="current">$129.99</span>
                     <span class="normal mini-text">$189.98</span>
                 </div>

                 <div class="mini-text">
                   <p>292 vendido</p>
                   <p>frete gratis</p>

                 </div>

                
               </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="listings">

  <div class="sectop flexitem">
          <h2><span class="circle"> </span><span>Produtos em destaque</span></h2>

          <div class="second-links"><a href="" class="view-all"> Visualizar todos<i class="ri-arrow-right-line"></i></a></div>
        </div>


    <div class="box-container">
      <?php
      

        if (!isset($_GET['p_cat'])){
            if(!isset($_GET['cat'])){
            $per_page = 4;

            if (isset($_GET['page'])){
                $page =$_GET['page'];
            }else{
                $page = 1;

            }


            $start_from = ($page-1) * $per_page;
           
            

      $select_listings = $conn -> prepare("SELECT * FROM `produto` 
       ORDER BY date DESC LIMIT $start_from,$per_page");
       $select_listings ->execute();
       if ($select_listings ->rowCount() > 0){
        while($fetch_listings = $select_listings->fetch(PDO::FETCH_ASSOC)){

          $quantidade = $fetch_listings ['quantidade'];

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

      
          
          $verify_produto_tamanho = $conn ->prepare("SELECT * FROM `produto_quantidade_tamanho` WHERE produto_id = ?  ");   
          $verify_produto_tamanho->execute([$produto_id]);

          if($verify_produto_tamanho ->rowCount()>0){

           
            $verify_produto_activo = $conn ->prepare("SELECT * FROM `produto` WHERE id = ? AND activo = 1 ");   
            $verify_produto_activo->execute([$produto_id]);
  
  
            if($verify_produto_activo ->rowCount()>0){

              if($quantidade > 0) {


  
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
      
       }

       }else{
       echo'<p class ="empty">Nenhum produto publicado!</p>';
       }  

          

      ?>


    </div> 

  </section>


  <div class="pag">

        <center>
          <ul class="paginacao">
            
        <?php

        $select_produto = $conn ->prepare("SELECT * FROM `produto`");
        $select_produto ->execute();
        $total_records = $select_produto-> rowCount(); 

     

        $total_pages = ceil($total_records /$per_page);

        echo "
        <li><a href='listings.php?page=1'>".'Primeira pag'."</a></li>

        ";

        for($i = 1; $i<=$total_pages; $i++){

            echo "
            <li><a href='listings.php?page=".$i."'>". $i ."</a></li>
    
            ";

        };

        
        echo "
        <li><a href='listings.php?page=$total_pages'>".'Outra pag'."</a></li>

        ";



            }

            }

        ?>

          </ul>
        </center>

  </div>


    <div class="banners">
      <div class="container">
        <div class="wrapper">
          <div class="column">
            <div class="banner flexwrap">
              <div class="row">
                <div class="item get-a">
                  <div class="image">
                    <img src="banner/banner1.jpg" alt="">
                  </div>
                  <div class="text-content flexcol">
                    <h4>Brutal Sale!</h4>
                    <h3><span>Get the deal in here</span><br>Living Room Chair</h3>
                    <a href="#" class="primary-button">Loja agora</a>
                  </div>
                  <a href="#" class="over-link"></a>
                </div>
              </div>

              <div class="row">
                <div class="item get-gray">
                  <div class="image">
                    <img src="banner/banner2.jpg" alt="">
                  </div>
                  <div class="text-content flexcol">
                    <h4>Brutal Sale!</h4>
                    <h3><span>Desconto todos os dias</span><br>Office outfit</h3>
                    <a href="#" class="primary-button">Loja agora</a>
                  </div>
                  <a href="#" class="over-link"></a>
                </div>
              </div>
            </div>

            <!---- BANNERS ---->

            <div class="product-categorias flexwrap">
              <div class="row">
                <div class="item get-border">
                  <div class="image">
                    <img src="banner/procat1.jpg" alt="">
                  </div>

                  <div class="content mini-links">
                    <h4>Beauty</h4>
                    <ul class="flexcol">
                      <li><a href="#">Makeup</a></li>
                      <li><a href="#">Skin Care</a></li>
                      <li><a href="#">Hair Care</a></li>
                      <li><a href="#">Fragance</a></li>
                      <li><a href="">Foot & Hand Care</a></li>
                    </ul>

                    <div class="second-links">
                      <a href="" class="view-all">Visualizar tudo<i class="ri-arrow-right-line"></i></a>
                   </div>
                  </div>
                  
                </div>
              </div>

              <div class="row">
                <div class="item get-border">
                  <div class="image">
                    <img src="banner/procat2.jpg" alt="">
                  </div>

                  <div class="content mini-links">
                    <h4>Beauty</h4>
                    <ul class="flexcol">
                      <li><a href="#">Makeup</a></li>
                      <li><a href="#">Skin Care</a></li>
                      <li><a href="#">Hair Care</a></li>
                      <li><a href="#">Fragance</a></li>
                      <li><a href="">Foot & Hand Care</a></li>
                    </ul>

                    <div class="second-links">
                      <a href="" class="view-all">Visualizar tudo<i class="ri-arrow-right-line"></i></a>
                    </div>
                  </div>
                  
                </div>
              </div>

              
               <div class="row">
                <div class="item get-border">
                  <div class="image">
                    <img src="banner/procat3.jpg" alt="">
                  </div>

                  <div class="content mini-links">
                    <h4>Beauty</h4>
                    <ul class="flexcol">
                      <li><a href="#">Makeup</a></li>
                      <li><a href="#">Skin Care</a></li>
                      <li><a href="#">Hair Care</a></li>
                      <li><a href="#">Fragance</a></li>
                      <li><a href="">Foot & Hand Care</a></li>
                    </ul>

                    <div class="second-links">
                      <a href="" class="view-all">Visualizar tudo<i class="ri-arrow-right-line"></i></a>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>

            </div>
            </div>


             
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="newsletter">
        <div class="container">
          <div class="wrapper">
            <div class="box">
              <div class="content">
                <h3>Join Our Newsletter</h3>
                <p>Get E-mail updates about our latest shop and <strong>Special offers</strong></p>
              </div>
              <form action="" class="search">
                <span class="icon-large"><i class="ri-mai-line"></i></span>
                <input type="mail" placeholder="Seu endereco electronico" required>
                <button type="submit"> Sign up</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include ('components/footer.php'); ?>
    </footer>




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

    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>


</div>
    
</body>

</html>
