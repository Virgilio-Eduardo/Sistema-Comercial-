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

      <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>

                 
  <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>Conta</title>
</head>

   

<body> 

<div class="site page_single">

<?php include ('components/menu_escondido.php'); ?>

<?php include ('components/user_header.php'); ?>


<?php
  include ('components/bar_pesquisar.php');
 
?>


<section class="minha_conta">

<div class="box-container">
   <div class="perfil">
          <center>
          <img src="img/IMG_20211024_191839_478.jpg" alt="">
          <p class="nome">Chainz Delicate</p>
          </center>
          <i class="linha"></i>
          <hr>
      
          <div class="info">
              <a href="my_listings.php"><i class="fa fa-list"></i> Meus produtos</a>
              <a href="levantamento.php">$ Levantamento</a>
              <a href="historico_de_produtos_vendidos.php"><i class="fa fa-list"></i> historico de vendas</a>
              <a href="atualizar_dados.php"><i class="fa fa-user"></i>mudar senha</a>
              <a  href="components/user_logout.php" onclick="return
              confirm('Deseja sair dessa conta?');"><i class="fa fa-sign-out"></i>sair</a>
          </div>

    </div>

 
      <div class="zona-ordens">
          <center>
              <h1 class="heading">Produtos <span>solicitados</span></h1>

              <p class="lead">Se o produto estiver disponivel, confirme.</p>
          </center>

          <hr>

          <div class="table-responsive" >
              <table class ="table">
                  <thead>
                      <tr>
                          <th>On:</th>
                          <th>Preco pago:</th>
                          <th>Produto:</th>
                          <th>Quantidade:</th>
                          <th>Tamanho</th>
                          <th>Data:</th>
                          <th>estado:</th>
                          <th>enderco de entrega:</th>
                          <th>></th>
                      </tr>
                  </thead>  
                  <?php
                              $select_pagamento = $conn->prepare("SELECT * FROM `pagamento_confirmado` 
                              WHERE vendedor = ? ORDER BY date DESC ");
                              $select_pagamento->execute([$user_id]);



                              if($select_pagamento ->rowCount()>0){
                                  while($fetch_pagamento = $select_pagamento ->fetch(PDO::FETCH_ASSOC)){

                                      $select_produto = $conn->prepare("SELECT * FROM `produto` 
                                      WHERE id = ? ORDER BY date DESC ");
                                      $select_produto->execute([$fetch_pagamento['produto_id']]);
                                      $fetch_produto = $select_produto ->fetch(PDO::FETCH_ASSOC);

                                      $select_comprador = $conn->prepare("SELECT * FROM `detalhes_comprador` 
                                      WHERE enviador = ? ");
                                      $select_comprador->execute([$fetch_pagamento['comprador']]);
                                      $fetch_comprador = $select_comprador ->fetch(PDO::FETCH_ASSOC);

                                      $nome_comprador =$fetch_comprador['nome'];
                                      $numero_comprador =$fetch_comprador['numero'];
                                      $endereco_comprador =$fetch_comprador['localizacao'];

                                      $pagamento_id =$fetch_pagamento['id'];
                                      $produto_id = $fetch_pagamento['produto_id'];

                                      $preco_pago =$fetch_pagamento['preco_pago'];
                                      $quantidade =$fetch_pagamento['quantidade'];
                                      $vendedor = $fetch_pagamento['vendedor'];
                                      $tamanho =$fetch_pagamento['tamanho'];
                                      $estado =$fetch_pagamento['estado'];
                                      $data =$fetch_pagamento['date'];
                                      $produto_id =$fetch_pagamento['produto_id'];
                                      $img1 = $fetch_produto['img1'];

                                      $comprador = $fetch_pagamento['comprador'];

                                                              
                                      $select_vendedor = $conn -> prepare("SELECT * FROM `users` 
                                      WHERE  id = ? ");
                                      $select_vendedor ->execute([$vendedor]);
                                      $buscar_nome_vendedor =  $select_vendedor->fetch(PDO::FETCH_ASSOC);
                                      $nome_loja = $buscar_nome_vendedor ['nome_loja'];

                                      
                                      $verify_itens_pedido = $conn->prepare("SELECT * FROM `produto_recebido` 
                                      WHERE produto_recebido_id  = ? AND produto_id=? AND vendedor= ?  ORDER BY data DESC");
                                      $verify_itens_pedido->execute([$pagamento_id, $produto_id, $nome_loja]);

                                      $verify_mensagem = $conn->prepare("SELECT * FROM `notificacoes_pedidos` 
                                      WHERE id  = ? AND produto_id =? AND estado ='confirmado'   ORDER BY date DESC");
                                      $verify_mensagem->execute([$pagamento_id, $produto_id]);


                      ?>
                  <form action="" method="post">

                  <tbody>

                      <tr>
                          <input type="hidden" name="pagamento_id" value="<?= $pagamento_id;?>">
                          <input type="hidden" name="produto_id" value="<?= $produto_id;?>">
                          <input type="hidden" name="comprador" value="<?= $comprador;?>">
                          <input type="hidden" name="vendedor_id" value="<?= $vendedor;?>">
                          <input type="hidden" name="quantidade" value="<?= $quantidade;?>">

                          <td data-label="On">#</td>
                          <td data-label="Preco pago">$<?php echo $preco_pago;?></td>
                          <td data-label="Produto"><img src="uploaded_files/<?=$fetch_produto['img1'];?>"  alt="">
                          </td>
                          <td data-label="Quantidade"><?php echo $quantidade;?></td>
                          <td data-label="Tamanho"><?php echo $tamanho;?></td>
                          <td data-label="Data"><?php echo $data;?></td>
                          <td data-label="Estado"><p class="estado">{<?php echo $estado;?>}</p></td>
                          <td data-label="endereco de entrega"><p class="nome"><?php echo $nome_comprador;?></p>
                          <p class="numero"><?php echo $numero_comprador;?></p> <p class="endereco"><?php echo $endereco_comprador;?></p></td>

                          <?php if ($verify_itens_pedido->rowCount()>0){?> <td ><p class="estado">Produto entregue com sucesso</p></td>

                              
                           <?php } elseif($verify_mensagem->rowCount()>0){?><td data-label=">">
                               <button class="confirmar" name="enviar_produto_entregue_com_sucesso"> Entregue</button></td>

                          <?php }else{?><td data-label=">">
                              
                              <button class="confi" name="enviar_confirmado">Confirmar</button>
                              <button class="confirmar" name="enviar_produto_entregue_com_sucesso"> Entregue</button></td>
                              
                              <?php }?>
                      </tr>

                  </tbody>
                  </form>
                    
                  <?php 
                          }

                      }
                                              
                      ?>

              </table>
           </div>


      </div>
    
</div>


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

    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>


</div>
    
</body>

</html>
