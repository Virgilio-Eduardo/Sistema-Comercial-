<?php 
include ('components/connect.php');

include ('components/seguranca_compra.php');

include ('components/function.php');


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

    <title>Lista</title>
</head>


<body> 

<?php include ('components/user_header.php'); ?>
  <!--Imoveis-->

  <section class="mensagem">

   <div class="box-container">

   
        <div class="zona-ordens">
            <center>
                <h1 class="heading">Mensagem <span>recebidas</span></h1>

                <p class="lead">Agradecido por estar usando os nossos servicos.</p>
            </center>

            


        </div>

        <?php
            $select_mensagem = $conn ->prepare("SELECT * FROM `notificacoes_pedidos` WHERE comprador = ? ORDER BY date DESC ");
            $select_mensagem ->execute([$user_id]);

            if ($select_mensagem ->rowCount() > 0){
                while($fetch_mensagem = $select_mensagem ->fetch(PDO::FETCH_ASSOC)){

                    $produto_id = $fetch_mensagem['produto_id'];

                    $select_produto = $conn->prepare("SELECT * FROM `produto` 
                    WHERE id = ? ORDER BY date DESC ");
                    $select_produto->execute([$fetch_mensagem['produto_id']]);
                    $fetch_produto = $select_produto ->fetch(PDO::FETCH_ASSOC);

                    $img1 = $fetch_produto['img1'];

                    $mensagem = $fetch_mensagem['mensagem'];
                    $estado = $fetch_mensagem['estado'];
                    $data = $fetch_mensagem['date'];


            ?>

                    
   

        <div class="box">

        <div class="bx">
        <h3><?=$estado;?></h3>
            <div class="info">
            <img src="uploaded_files/<?=$fetch_produto['img1'];?>"  alt="">
                <p><?=$mensagem;?></p>
            </div>
            <a  <?php if($nivel_acesso == 0){ ?>  
                onclick="window.location.href='visualizar_compra.php?get_id=<?=$produto_id;?>'" <?php }?>>Visualizar detalhes</a>
        </div>


        </div>

        <?php 
                  
                }

        }else{
            echo'<p class ="empty">Nenhuma mensagem foi enviado!</p>';
        }
                    
        ?>

    </div>



   </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>
    
</body>

</html>
