<?php 
include ('../components/connect.php');

include ('../components/seguranca_compra.php');


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
    <title>Mensagens</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>

<section class="mensagem_admin">
  

</section>



<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>