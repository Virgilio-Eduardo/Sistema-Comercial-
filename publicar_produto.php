<?php 
include ('components/connect.php');

session_start();
if (isset($_SESSION['usuarioId'] ) && isset($_SESSION['nivel_de_acesso'])){
  $user_id = $_SESSION['usuarioId']; 
  $nivel_acesso = $_SESSION['nivel_de_acesso'];
}else{
  $user_id = '';
  $nivel_acesso= '';
  $info_msg[] ='Faça login, se não tens conta, cadastra-se!';
header('location:login.php');
}


if(isset($_POST['post'])){

  $id = create_unique_id();

  $nome_produto = $_POST['nome_produto'];
  $nome_produto = filter_var($nome_produto, FILTER_SANITIZE_STRING);

  $preco = $_POST['preco'];
  $preco = filter_var($preco, FILTER_SANITIZE_STRING);
  
  $quantidade = $_POST['quantidade'];
  $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);


  $descricao = $_POST['descricao'];
  $descricao = filter_var($descricao, FILTER_SANITIZE_STRING);

  $categoria_produto = $_POST['categoria_produto'];
  $categoria_produto = filter_var($categoria_produto, FILTER_SANITIZE_STRING);

  $categoria = $_POST['categoria'];
  $categoria = filter_var($categoria, FILTER_SANITIZE_STRING);
  
  $img1 = $_FILES['img1']['name'];
  $img1 = filter_var($img1, FILTER_SANITIZE_STRING);
  $img1_ext = pathinfo($img1, PATHINFO_EXTENSION);
  $rename_img1 = create_unique_id().'.'.$img1_ext;
  $img1_tmp_name = $_FILES['img1']['tmp_name'];
  $img1_size =$_FILES['img1']['size'];
  $img1_folder = 'uploaded_files/'.$rename_img1;

  $img2 = $_FILES['img2']['name'];
  $img2 = filter_var($img2, FILTER_SANITIZE_STRING);
  $img2_ext = pathinfo($img2, PATHINFO_EXTENSION);
  $rename_img2 = create_unique_id().'.'.$img2_ext;
  $img2_tmp_name = $_FILES['img2']['tmp_name'];
  $img2_size =$_FILES['img2']['size'];
  $img2_folder = 'uploaded_files/'.$rename_img2;

$img3 = $_FILES['img3']['name'];
$img3 = filter_var($img3, FILTER_SANITIZE_STRING);
$img3_ext = pathinfo($img3, PATHINFO_EXTENSION);
$rename_img3 = create_unique_id().'.'.$img3_ext;
$img3_tmp_name = $_FILES['img3']['tmp_name'];
$img3_size =$_FILES['img3']['size'];
$img3_folder = 'uploaded_files/'.$rename_img3;

$img4 = $_FILES['img4']['name'];
$img4 = filter_var($img4, FILTER_SANITIZE_STRING);
$img4_ext = pathinfo($img4, PATHINFO_EXTENSION);
$rename_img4 = create_unique_id().'.'.$img4_ext;
$img4_tmp_name = $_FILES['img4']['tmp_name'];
$img4_size =$_FILES['img4']['size'];
$img4_folder = 'uploaded_files/'.$rename_img4;


if(!empty($img2)){
  if($img2_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 1 é muito grande';
  }else{
    move_uploaded_file($img2_tmp_name, $img2_folder);
  }
}else{
  $rename_img2 = '';
}


if(!empty($img3)){
  if($img3_size >  9000000){
    $warning_msg[] = 'tamanho de imagem 3 é muito grande';
  }else{
    move_uploaded_file($img3_tmp_name, $img3_folder);
  }
}else{
  $rename_img3 = '';
}

if(!empty($img4)){
  if($img4_size > 9000000){
    $warning_msg[] = 'tamanho de imagem 4 é muito grande';
  }else{
    move_uploaded_file($img4_tmp_name, $img4_folder);
  }
}else{
  $rename_img4 = '';
}


if($img1_size >9000000){
  $warning_msg[] = 'imagem 1 é muito grande';
}else{
  $post_produto = $conn->prepare("INSERT INTO `produto`(id, user_id, nome_produto,
     preco, quantidade, categoria_produto, categoria, descricao, img1, img2, img3, img4, activo) VALUES(?, ?, ?, ?,?,?,?,?,?,?,?,?,?)");

$post_produto->execute([$id, $user_id, $nome_produto, $preco, $quantidade, $categoria_produto, $categoria, $descricao,
$rename_img1, $rename_img2, $rename_img3, $rename_img4,1]);

  move_uploaded_file($img1_tmp_name, $img1_folder );

  $sucess_msg[] ='publicado com sucesso!';

  header('location:my_listings.php');
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

<section class="produto-form" >
    <form action="" method="POST" enctype="multipart/form-data">
    <h1 class="heading">Detalhes do <span>produto</span></h1>
    <div class="flex">
    <div class="box">
    <p>nome do produto <span>:</span></p>
      <input type="text" name="nome_produto" maxlength="50" 
      required placeholder="Digite o nome do produto" class="input" >
    </div>
     
    <div class="box">
        
      <p>preco <span>:</span></p>
      <input type="text" maxlength="15" name="preco" placeholder="Digite o preco"
       required class="input">
    </div>

    <div class="box">
        
        <p>quantidade <span>:</span></p>
        <input type="number" maxlength="15" name="quantidade" placeholder="Digite a quantidade do produto"
         required class="input">
      </div>


      <div class="box">
        
        <p>categoria produto <span>:</span></p>
        <select name="categoria_produto" class="input">
          <option >Seleciona a categoria do produto</option>
          <?php 
          $select_cat_produto = $conn ->prepare("SELECT * FROM `categoria_produto`");
          $select_cat_produto ->execute();
          while($buscar_cat_pro = $select_cat_produto ->fetch(PDO::FETCH_ASSOC)){

            $cat_prod_id =$buscar_cat_pro['cat_prod_id'];
            $cat_prod_nome =$buscar_cat_pro['cat_prod_nome'];

            echo "
            <option value='$cat_prod_id'>$cat_prod_nome </option>

            ";

          }
          ?>
          
        </select>

      </div>

      <div class="box">
        
        <p>categoria <span>:</span></p>
        <select name="categoria" class="input">
        <option >Seleciona a categoria</option>
        <?php 
          $select_cat_produto = $conn ->prepare("SELECT * FROM `categoria`");
          $select_cat_produto ->execute();
          while($buscar_cat_pro = $select_cat_produto ->fetch(PDO::FETCH_ASSOC)){

            $cat_id =$buscar_cat_pro['cat_id'];
            $cat_nome =$buscar_cat_pro['cat_nome'];

            echo "
            <option value='$cat_id'>$cat_nome </option>

            ";

          }
          ?>

        </select>

      </div>

    </div>
    
    <div class="box">
    <p>Descriçāo do produto:<span></span></p>
      <textarea name="descricao" cols="30" rows="10" 
      maxlength="1000" required placeholder="Digite a descriçāo do produto"
       class="input"></textarea>
    </div>

    <div class="flex">
      <div class="box">
        <p>imagem 01</p>
        <input type="file" name="img1" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 02</p>
        <input type="file" name="img2" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 03</p>
        <input type="file" name="img3" class="input" accept="image/*" required>

      </div>

      <div class="box">
        <p>imagem 04</p>
        <input type="file" name="img4" class="input" accept="image/*" required>

      </div>


    </div>

    <input type="submit" name="post" value="Publicar produto" class="btn">

    </form>

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
