<?php 
include ('components/connect.php');

include ('components/seguranca.php');


if (isset($_POST['submit'])){
   

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);

  $password = sha1($_POST['password']);
  $password = filter_var($password, FILTER_SANITIZE_STRING);

  $verify_user = $conn ->prepare("SELECT * FROM `users` WHERE email= ?
        AND password = ? LIMIT 1");
        $verify_user->execute([$email, $password]);
        

        if($verify_user->rowCount() > 0){
          $row = $verify_user->fetch(PDO::FETCH_ASSOC);
        //Define os valores atribuidos na sessao do usuario

        
        if($row['nivel_acesso'] == 0 ){
          $_SESSION['usuarioId'] 		= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:listings.php');
        }

        
        if($row['nivel_acesso'] == 1 ){
          $_SESSION['usuarioId'] 			= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:listings.php');
        }

        if($row['nivel_acesso'] == 5 ){
          $_SESSION['usuarioId'] 			= $row['id'];
          $_SESSION['usuarioNumero'] 		= $row['numero'];
          $_SESSION['usuarioSenha'] 		= $row['senha'];
          $_SESSION['nivel_de_acesso'] 		= $row['nivel_acesso'];
          header('location:admin/painel_admin.php');
        }



          
        }else{
          $warning_msg[] ='incorreto email ou password!';
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



<section class="form-container">
  <form action="" method="POST">
    <h3 >Login</h3>

    <i></i><input type="email" name="email" required maxlength="50" 
    placeholder="Digite seu email" class="box">

    <i></i><input type="password" name="password" required maxlength="15" 
    placeholder="Digite sua senha" class="box">


    <p>Voce ja tem uma conta? <a href="cadastrar.php">Cadastrar-se agora</a></p>


    <input type="submit" value="Submeter" name="submit" class="btn">

  
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
