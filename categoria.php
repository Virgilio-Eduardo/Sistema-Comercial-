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
              
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>Lista</title>
</head>

   

<body> 

<?php include ('components/user_header.php'); ?>

<section class="page-header">
  <h2>#Chainz Shop</h2>

  <p>Tudo que voce consegue imaginar, voce pode realizar</p>
</section>

<?php include ('components/categoria_bar.php'); ?>


  <!--Imoveis-->


  <section class="listings">
    <h1 class="heading">Produtos</h1>

    <div class="box-container">

      <?php 
          if(isset($_GET['cat'])){
            $cat_id = $_GET['cat'];
        
            $pegar_cat = $conn ->prepare("SELECT * FROM `categoria`
            WHERE cat_id = '$cat_id' ");
            $pegar_cat->execute();
        
            $pegar_produto = $conn ->prepare("SELECT * FROM `produto`
            WHERE categoria_produto = '$cat_id' LIMIT 8 ");
            $pegar_produto->execute();
        
        
            if ($pegar_produto ->rowCount()>0){
              while($fetch_listings = $pegar_produto->fetch(PDO::FETCH_ASSOC)){
        
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
      <p><i class='bx bx-star'></i></p>
      <p><i class='bx bx-star'></i></p>
      <p><i class='bx bx-star'></i></p>
      <p><i class='bx bx-star'></i></p>
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
        
                }else{
                echo'<p class ="empty">Nenhum produto encontrado nesta categoria!</p>';
                }

            
            }
        ?>
     
    </div> 

  </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>
    
</body>

</html>
