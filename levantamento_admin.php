<?php 
include ('../components/connect.php');

include ('../components/seguranca_compra.php');

include ('../components/enviar_confirmado.php');


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
    <title>Levantamento</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>

<section class="levantamento">
  
  
  <div class="box-container">
    <form action="" method="POST" class="">
    <h1 class="heading"><span>Lenvantamento</span></h1>
    
        <div class="flex">
            <div class="box">
            <p>Montante <span>:</span></p>
            <input type="value" name="dinheiro" id="" placeholder="Digite o motante" class="input">
            </div>

            <div class="box">
                <p>Servico <span>:</span></p>
                <select name="operadora" id="" class="input">
                    <option value="E-mola">E-mola</option>
                    <option value="M-pesa">M-pesa</option>
                </select>
            </div>
        </div>

        <?php if($nivel_acesso == 5){ ?> <input type="submit" name="levantamento_saldo_admin" value="Levantamento" class="btn"> <?php }?>
    

    </form>
  </div>


   </section>



<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>