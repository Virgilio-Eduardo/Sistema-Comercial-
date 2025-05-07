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
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>Levantamento</title>
</head>


<body> 

<?php include ('components/user_header.php'); ?>
  <!--Imoveis-->

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

        <input type="submit" name="levantamento" value="Levantamento" class="btn">
    

    </form>
  </div>


   </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>
    
</body>

</html>
