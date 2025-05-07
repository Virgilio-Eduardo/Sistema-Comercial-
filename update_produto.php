<?php 
include ('components/connect.php');

include ('components/seguranca.php');

if (isset($_GET['get_id'])){
  $get_id = $_GET['get_id'];

}else{
  $get_id = '';
  header('location:home.php');
}

if(isset($_POST['update'])){

  $update_id =$_POST['property_id'];
  $update_id = filter_var($update_id, FILTER_SANITIZE_STRING);
  
  $nome_produto = $_POST['nome_produto'];
  $nome_produto = filter_var($nome_produto, FILTER_SANITIZE_STRING);

  $preco = $_POST['preco'];
  $preco = filter_var($preco, FILTER_SANITIZE_STRING);

  
  $quantidade = $_POST['quantidade'];
  $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);


  $descricao = $_POST['descricao'];
  $descricao = filter_var($descricao, FILTER_SANITIZE_STRING);
  
  

  $old_img1 = $_POST['old_img1'];
  $old_img1 = filter_var($old_img1, FILTER_SANITIZE_STRING);
  $img1 = $_FILES['img1']['name'];
  $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
  $img1_ext = pathinfo($img1, PATHINFO_EXTENSION);
  $rename_img1 = create_unique_id().'.'.$img1_ext;
  $img1_tmp_name = $_FILES['img1']['tmp_name'];
  $img1_size =$_FILES['img1']['size'];
  $img1_folder = 'uploaded_files/'.$rename_img1;


  $old_img2 = $_POST['old_img2'];
  $old_img2 = filter_var($old_img2, FILTER_SANITIZE_STRING);
  $img2 = $_FILES['img2']['name'];
  $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
  $img2_ext = pathinfo($img2, PATHINFO_EXTENSION);
  $rename_img2 = create_unique_id().'.'.$img2_ext;
  $img2_tmp_name = $_FILES['img2']['tmp_name'];
  $img2_size =$_FILES['img2']['size'];
  $img2_folder = 'uploaded_files/'.$rename_img2;


$old_img3 = $_POST['old_img3'];
 $old_img3 = filter_var($old_img3, FILTER_SANITIZE_STRING);
$img3 = $_FILES['img3']['name'];
$img3 = filter_var($img3, FILTER_SANITIZE_STRING);
$img3_ext = pathinfo($img3, PATHINFO_EXTENSION);
$rename_img3 = create_unique_id().'.'.$img3_ext;
$img3_tmp_name = $_FILES['img3']['tmp_name'];
$img3_size =$_FILES['img3']['size'];
$img3_folder = 'uploaded_files/'.$rename_img3;


$old_img4 = $_POST['old_img4'];
$old_img4 = filter_var($old_img4, FILTER_SANITIZE_STRING);
$img4 = $_FILES['img4']['name'];
$img4 = filter_var($img4, FILTER_SANITIZE_STRING);
$img4_ext = pathinfo($img4, PATHINFO_EXTENSION);
$rename_img4 = create_unique_id().'.'.$img4_ext;
$img4_tmp_name = $_FILES['img4']['tmp_name'];
$img4_size =$_FILES['img4']['size'];
$img4_folder = 'uploaded_files/'.$rename_img4;



if(!empty($img1)){
  if($img1_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 1 é muito grande';
  }else{ 
    
    $update_img1 = $conn->prepare ("UPDATE `produto` SET
     img1 = ? WHERE id = ?");
    $update_img1 ->execute([$rename_img1, $update_id]);
     move_uploaded_file($img1_tmp_name, $img1_folder);
     if($old_img1 != ''){
      unlink('uploaded_files/'.$old_img1);
     }
  }
}

if(!empty($img2)){
  if($img2_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 1 é muito grande';
  }else{
     
    $update_img2 = $conn -> prepare ("UPDATE `produto` SET
     img2 = ? WHERE id = ?");
     $update_img2 -> execute([$rename_img2, $update_id]);
     move_uploaded_file($img2_tmp_name, $img2_folder);
     if($old_img2 != ''){
      unlink('uploaded_files/'.$old_img2);
     }
  }
} 


if(!empty($img3)){
  if($img3_size >  9000000){
    $warning_msg[] = 'tamanho de imagem 3 é muito grande';
  }else{
    
    $update_img3 = $conn -> prepare ("UPDATE `produto` SET
     img3 = ? WHERE id = ?");
     $update_img3 -> execute([$rename_img3, $update_id]);
     move_uploaded_file($img3_tmp_name, $img3_folder);
     if($old_img3 != ''){
      unlink('uploaded_files/'.$old_img3);
     }
  }
}

if(!empty($img4)){
  if($img4_size >  9000000){
    $warning_msg[] = 'tamanho de imagem 4 é muito grande';
  }else{
      
    $update_img4 = $conn -> prepare ("UPDATE `produto` SET
     img4 = ? WHERE id = ?");
     $update_img4 -> execute([$rename_img4, $update_id]);
     move_uploaded_file($img4_tmp_name, $img4_folder);
     if($old_img4 != ''){
      unlink('uploaded_files/'.$old_img4);
     }
  }
}



$update_listing = $conn ->prepare("UPDATE `produto` SET nome_produto =?, 
preco = ?, quantidade = ?, descricao =? WHERE id = ? ");

$update_listing->execute([ $nome_produto, $preco, $quantidade, $descricao,
$update_id]);

$sucess_msg[] = 'Publicação atualizada';

}

if(isset($_POST['delete_img2'])){
  $old_img2 = $_POST['old_img2'];
  $old_img2 = filter_var($old_img2, FILTER_SANITIZE_STRING);
  $update_img2= $conn -> prepare ("UPDATE `property` SET
     img2 = ? WHERE id = ?");
     $update_img2 -> execute(['', $get_id]);
     if($old_img2 != ''){
      unlink('uploaded_files/'.$old_img2);
     }
     $sucess_msg[] = 'imagem 02 apagada!';

}

if(isset($_POST['delete_img3'])){
  $old_img3 = $_POST['old_img3'];
  $old_img3 = filter_var($old_img3, FILTER_SANITIZE_STRING);
  $update_img3= $conn -> prepare ("UPDATE `property` SET
     img3 = ? WHERE id = ?");
     $update_img3 -> execute(['', $get_id]);
     if($old_img3 != ''){
      unlink('uploaded_files/'.$old_img3);
     }
     $sucess_msg[] = 'imagem 03 apagada!';

}

if(isset($_POST['delete_img4'])){
  $old_img4 = $_POST['old_img4'];
  $old_img4 = filter_var($old_img4, FILTER_SANITIZE_STRING);
  $update_img4= $conn -> prepare ("UPDATE `property` SET
     img4 = ? WHERE id = ?");
     $update_img4 -> execute(['', $get_id]);
     if($old_img4 != ''){
      unlink('uploaded_files/'.$old_img4);
     }
     $sucess_msg[] = 'imagem 04 apagada!';

}

if(isset($_POST['delete_img5'])){
  $old_img5 = $_POST['old_img5'];
  $old_img5 = filter_var($old_img5, FILTER_SANITIZE_STRING);
  $update_img5= $conn -> prepare ("UPDATE `property` SET
     img5 = ? WHERE id = ?");
     $update_img5 -> execute(['', $get_id]);
     if($old_img5 != ''){
      unlink('uploaded_files/'.$old_img5);
     }
     $sucess_msg[] = 'imagem 05 apagada!';

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



<section class="produto-form">

  <?php 
   $select_property = $conn ->prepare ("SELECT * FROM `produto` 
   WHERE id = ? LIMIT 1");
   $select_property-> execute([$get_id]);
   if ($select_property-> rowCount() > 0){
    while($fetch_property = $select_property -> fetch (PDO::FETCH_ASSOC)){
    
      $produto_id  = $fetch_property['id'];
   
  ?> 


  <form action=""  method="POST" enctype="multipart/form-data">
    <h3>Detalhes do produto</h3>
    <input type="hidden" name="property_id" value="<?=$produto_id;?>">
    <input type="hidden" name="old_img1" value="<?=$fetch_property['img1'];?>">
    <input type="hidden" name="old_img2" value="<?=$fetch_property['img2'];?>">
    <input type="hidden" name="old_img3" value="<?=$fetch_property['img3'];?>">
    <input type="hidden" name="old_img4" value="<?=$fetch_property['img4'];?>">
  
    <div class="flex">
    <div class="box">
    <p>nome do produto <span>:</span></p>
      <input type="text" name="nome_produto" maxlength="50" 
      required placeholder="Digite o nome do produto" class="input"  value="<?=$fetch_property['nome_produto'];?>">
    </div>
     
    <div class="box">
        
      <p>preco <span>:</span></p>
      <input type="text" maxlength="15" name="preco" placeholder="Digite o preco"
       required class="input" value="<?=$fetch_property['preco'];?>">
    </div>

    <div class="box">
        
        <p>quantidade <span>:</span></p>
        <input type="number" maxlength="15" name="quantidade" placeholder="Digite a quantidade do produto"
         required class="input" value="<?=$fetch_property['quantidade'];?>">
      </div>



    <div class="box">
    <p>Descriçāo do produto:<span></span></p>
      <textarea name="descricao" cols="30" rows="10" 
      maxlength="1000" required placeholder="Digite a descriçāo do produto" 
       class="input"><?= $fetch_property['descricao'];?></textarea>
    </div>



    <div class="flex">
      
    <div class="box">
      
      <img src="uploaded_files/<?= $fetch_property['img1'];?>" alt="">
      <p>imagem 01 atualizar</p>
      <input type="file" name="img1" class="input" accept="image/*"  >

    </div>

      <div class="box">
        <?php
        if(!empty($fetch_property['img2'])){       
        ?>
        <img src="uploaded_files/<?= $fetch_property['img2'];?>" alt="">
        <input type="submit" name="delete_img2" class="btn" value="Apagar imagem 02"
        onclick="return confirm ('Apagar imagem 02?');">
        <?php  }; ?>
        <p>imagem 02 atualizar</p>
        
        <input type="file" name="img2" class="input" accept="image/*"  >

      </div>

      <div class="box">
      <?php
        if(!empty($fetch_property['img3'])){       
        ?>
        <img src="uploaded_files/<?= $fetch_property['img3'];?>" alt="">
        <input type="submit" name="delete_img3" class="btn" value="Apagar imagem 03"
        onclick="return confirm ('Apagar imagem 03?');">
        <?php  }; ?>
        <p>imagem 03 atualizar</p>
        
        <input type="file" name="img3" class="input" accept="image/*"  >

      </div>

      <div class="box">
      <?php
        if(!empty($fetch_property['img4'])){       
        ?>
        <img src="uploaded_files/<?= $fetch_property['img4'];?>" alt="">
        <input type="submit" name="delete_img4" class="btn" value="Apagar imagem 04"
        onclick="return confirm ('Apagar imagem 04?');">
        <?php  }; ?>
        <p>imagem 04 atualizar</p>
        
        <input type="file" name="img4" class="input" accept="image/*"  >

      </div>

    </div>

    <input type="submit" name="update" value="Atualizar imovel" class="btn">


  </form>

  <?php
   }
  }else{
   echo '<p class="empty">imovel não foi encontrado!</p>';
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
