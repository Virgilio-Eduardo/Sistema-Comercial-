<?php 
include ('../components/connect.php');

include ('../components/seguranca_compra.php');

include ('enviar_dados/submeter.php');


if (isset($_POST['submit'])){

  if($user_id !='' || $nivel_acesso == 5){
   
      $id = create_unique_id();

      
      $nome_loja = $_POST['nome_loja'];
      $nome_loja = filter_var($nome_loja, FILTER_SANITIZE_STRING);

      $nome = $_POST['nome'];
      $nome = filter_var($nome, FILTER_SANITIZE_STRING);

      $number = $_POST['number'];
      $number = filter_var($number, FILTER_SANITIZE_STRING);

      $cidade = $_POST['cidade'];
      $cidade = filter_var($cidade, FILTER_SANITIZE_STRING);

      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);

      $password = sha1($_POST['password']);
      $password = filter_var($password, FILTER_SANITIZE_STRING);

      $c_password = sha1($_POST['c_password']);
      $c_password = filter_var($c_password, FILTER_SANITIZE_STRING);

      $nivel_acesso = ($_POST['nivel_acesso']);
      $nivel_acesso = filter_var($nivel_acesso, FILTER_SANITIZE_STRING);

      $img = $_FILES['img']['name'];
      $img = filter_var($img, FILTER_SANITIZE_STRING);
      $img_ext = pathinfo($img, PATHINFO_EXTENSION);
      $rename_img = create_unique_id().'.'.$img_ext;
      $img_tmp_name = $_FILES['img']['tmp_name'];
      $img_size =$_FILES['img']['size'];
      $img_folder = '../uploaded_files/'.$rename_img;

      if(!empty($img)){
        if($img_size > 9000000){
          $warning_msg[] = 'tamanho de imagem 1 é muito grande';
        }else{
          move_uploaded_file($img_tmp_name, $img_folder);
        }
      }else{
        $rename_img = '';
      }
      


      

      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
      $select_email->execute([$email]);

      if ($select_email->rowCount() > 0){
        $warning_msg[]='email ja recebido!';
      }else{
        if($password != $c_password){
          $warning_msg[] ='Password não combinam!';

        }else{
                  
              $insert_user = $conn ->prepare("INSERT INTO `users`(id, nome_loja, nome, cidade, number,
              email, password, nivel_acesso, img) VALUES(?,?,?,?,?,?,?,?,?)");
              $insert_user->execute([$id, $nome_loja, $nome,$cidade, $number, $email, $c_password, $nivel_acesso, $rename_img]);
      
              if($insert_user){
              $verify_user = $conn ->prepare("SELECT * FROM `users` WHERE email= ?
              AND password = ? LIMIT 1");
              $verify_user->execute([$email, $c_password]);
              $row = $verify_user->fetch(PDO::FETCH_ASSOC);
      
              if($verify_user->rowCount() > 0){
                
                $sucess_msg[] ='Cadastrado com sucesso';
              
              }else{
                $error_msg[] ='Algo deu errado!';
              }
      
              }
        

        }

      }

        
  }else{
    $warning_msg[]= 'Por favor faça login primeiro!';
  }

}

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
    <title>Cadastrar</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>

<section class="form-container">
  <form action="" method="POST" enctype="multipart/form-data">
    <h3 >Cadastrar</h3>

    <i></i><input type="text" name="nome_loja" required maxlength="50" 
    placeholder="Digite nome da sua agencia" class="box">

    <i></i><input type="text" name="nome" required maxlength="50" 
    placeholder="Digite seu nome completo" class="box">

    
    <i></i><input type="text" name="cidade" required maxlength="25" 
    placeholder="Digite sua cidade" class="box">


    <i></i><input type="tel" name="number" required min="0" max="99999999999" maxlength="11" 
    placeholder="Digite seu numero" class="box">

    <i></i><input type="email" name="email" required maxlength="50" 
    placeholder="Digite seu email" class="box">

    <i></i><input type="password" name="password" required maxlength="15" 
    placeholder="Digite sua senha" class="box">

    <i></i><input type="password" name="c_password" required maxlength="15" 
    placeholder="Digite sua senha novamente" class="box">

            <select name="nivel_acesso" id="" class="box">
                <option value="1">Vendedor</option>
                <option value="0">Cliente</option>
           
              </select>

              <input type="file" name="img" class="box" accept="image/*" required>

    <p>Voce ja tem uma conta? <a href="login.php">login agora</a></p>


    <input type="submit" value="Submeter" name="submit" class="btn">

  
  </form>

</section>



<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>