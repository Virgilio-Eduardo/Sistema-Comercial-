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


  <section class="visulizar_comprar">
    <?php 
    $selecionar_produto_confirmado = $conn ->prepare("SELECT * FROM `pagamento_confirmado` WHERE produto_id = ? ");
    $selecionar_produto_confirmado -> execute([$get_id]);
    while ($buscar_produto_confirmado = $selecionar_produto_confirmado -> fetch(PDO::FETCH_ASSOC)){
        $pagamento_id = $buscar_produto_confirmado["id"];
        $produto_id = $buscar_produto_confirmado["produto_id"];
        $preco_pago = $buscar_produto_confirmado["preco_pago"];
        $quantidade = $buscar_produto_confirmado["quantidade"];
        $data = $buscar_produto_confirmado["date"];


        $selecionar_produto = $conn ->prepare("SELECT * FROM `produto` WHERE id = ? ");
        $selecionar_produto -> execute([$produto_id]);
        $buscar_produto = $selecionar_produto -> fetch(PDO::FETCH_ASSOC);

        $img = $buscar_produto["img1"];
        $preco = $buscar_produto["preco"];
        $nome_produto = $buscar_produto["nome_produto"];


        $selecionar_detalhes_comprador = $conn ->prepare("SELECT * FROM
         `detalhes_comprador` WHERE enviador = ? ");
        $selecionar_detalhes_comprador-> execute([$user_id]);
        $buscar_detalhes_comprador= $selecionar_detalhes_comprador->fetch(PDO::FETCH_ASSOC);

        $nome_comprador= $buscar_detalhes_comprador["nome"];
        $numero= $buscar_detalhes_comprador["numero"];
        $localizacao= $buscar_detalhes_comprador["localizacao"];


    ?>
    <div class="box-container">
        <div class="mensagem">
            <h3>Status: <span>Confirmado</span></h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae dolorem 
                deleniti pariatur animi sed. Ad sapiente ipsam dicta iste iure ut dolores eum
                 deserunt minus. Vitae quia assumenda inventore ipsa.</p>
        </div>

        <div class="detalhes">
            <div class="produto">
               
                <div class="info">
                  <img src="uploaded_files/<?=$img;?>" alt="">
                   <div class="b">
                   <p class="nome_produto"><?=$nome_produto;?> <span><?=$quantidade;?>x</span></p>
                   <p class="tamanho">Tamanho:<span><?=$buscar_produto_confirmado["tamanho"];?></span></p>
                    <p class="preco"><?=number_format($preco);?>mtcs</p>
                    <a href="#">Devolusao/rebolso</a>
                   </div>
                </div>

                <div class="inf">
                    <p>Total</p>    
                    <p><?=number_format($preco_pago);?>mtcs</p>           
                </div>
                

            </div>

            <div class="detalhes_cliente">
              <h3>Informacoes do pedido</h3>
                <div class="endereco">
                    <p class ="end">Endereco</p>
                    <div class="loc">
                        <p class ="nome"><?=$nome_comprador;?></p>
                        <p class ="numero"><?=$localizacao;?></p>
                        <p class ="numero"><?=$numero;?></p>
                        <p></p>
                    </div>
                </div>

                <div class="endereco">
                    <p class ="end">ID do pedido</p>
                    <div class="loc">
                    <p class ="numero"><?=$pagamento_id;?>  <span>Copiar</span></p>
                    </div>
                </div>

                <div class="endereco">
                    <p class ="end">Pedido feito</p>
                    <div class="loc">
                    <p class ="numero"><?=$data;?></p>
                    </div>
                </div>
               
                <div class="endereco">
                    <p  class ="end">Forma de pagamento</p>
                    <div class="loc">
                    <p class ="numero">Emola</p>
                    </div>
                    
                </div>

                <hr>

                <div class="endereco">
                <a href="" class="message"><i class="bx bx-message"></i>Entrar em contacto com o venderdor ></a>
                </div>

                <div class="endereco">
                <button><a href="">Escrever um comentario</a></button>
                </div>


            </div>
        </div>
    </div>

    <?php 
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
