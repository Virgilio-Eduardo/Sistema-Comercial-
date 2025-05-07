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
    <title>Painel</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>


<section class="produto-form" >

    <form action="" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="produto_id" value="<?=$produto_id;?>">
    <h1 class="heading">Adicionar <span>categorias</span></h1>
    
    <div class="box">
        <p>Nome de produto</p>
        <input type="text" name="tm1" class="input" maxlength="50" placeholder="Digite nome de produto"  >
    </div>
    
   
    <div class="flex">

    <div class="box">
    <p>Descriçāo do produto:<span></span></p>
      <textarea name="descricao" cols="30" rows="10" 
      maxlength="1000" required placeholder="Digite a descriçāo do produto"
       class="input"></textarea>
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

    <input type="submit" name="enviar_tamanho" value="enviar" class="btn">

    </form>

</section>


<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>