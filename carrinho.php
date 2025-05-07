<?php 
include ('components/connect.php');

include ('components/seguranca_compra.php');

include ('components/function.php');


include ('components/enviar_dados.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="restrita/listings.css" rel="stylesheet"> 
     
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

<div class="single-cart">
  <div class="container">
    <div class="wrapper">
       <div class="breadcrumb">
          <ul class="flexitem">
          <li><a href="#">Home</a></li>
          <li>Carrinho</li>
          </ul>
        </div>
      <div class="page-title">
      
           <h4>Carrinho</h4>
        
      </div>

      <div class="products one cart">
        <div class="flexwrap">
          <form action="" class="form-cart">
            <div class="item">
              <table id="cart-table">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>preco</th>
                    <th>qty</th>
                    <th>subtotal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="flexitem">
                       <div class="thumbnail object-cover">
                          <a href="#"><img src="img/f1 (3).jpg" alt=""></a>
                        </div> 
                        
                        <div class="content">
                          <strong><a href="#">Camisa</a></strong>
                          <p>tamanho: M</p>
                        </div>
                    </td>
                    <td>2.000mt</td>
                    <td>
                      <div class="qty-control flexitem">
                        <button class="minus">-</button>
                        <input type="text" value="2" min="1">
                        <button class="plus">+</button>
                      </div>
                    </td>
                    <td>4.000mt</td>
                    <td><a href="#" class="item-remove"><i class="ri-close-line">x</i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>

          <div class="cart-summary styled">
            <div class="item">


                <div class="shipping-rate collapse">
                  <div class="has-child expand">
                  <div class="nome-cart">
                  <a href="#" class="icon-small">
                    - Estimate Shipping and Tax
                  </a>
                  </div>
                 

                <div class="cart-total">
                <table>
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>2.000mt</td>
                    </tr>
                    <tr>
                      <th>Disconto</th>
                      <td>-85mt</td>
                    </tr>
                    <tr>
                      <th>Shipping <span class="mini-text">(flat)</span></th>
                      <td>10mt</td>
                    </tr>
                    <tr class="grand-total">
                      <th>TOTAL</th>
                      <td><strong>3.000mt</strong></td>
                    </tr>
                  </tbody>
                </table>
                <button class="secundary-button">Pagamento</button>
              </div>
                  </div>
                  </div>              
                </div>

            </div>
          </div>
        
        </div>
      </div>

    </div>
  </div>
</div>



<!--<section class="carrinho">
    <h1 class="heading">Carrinho</h1>

   
    <button class="sair">
    <a class="sair" href="listings.php">voltar </a>
    </button>
  

    <form method="post" action="" class="box-container">
      
      <?php
        $total =0;

        $select_carrinho = $conn->prepare("SELECT * FROM `carrinho` 
        WHERE user_id = ?");
        $select_carrinho->execute([$user_id]);

        if($select_carrinho ->rowCount() > 0){
            while($fetch_carrinho = $select_carrinho ->fetch(PDO::FETCH_ASSOC)){

              $pro_qty = $fetch_carrinho['quantidade'];

              $tamanho = $fetch_carrinho['tamanho'];

                $select_produto = $conn -> prepare("SELECT * FROM `produto` WHERE id = ?
                ORDER BY date DESC ");
                $select_produto->execute([$fetch_carrinho['produto_id']]);

                if($select_produto-> rowCount()> 0){
                    while($fetch_produto = $select_produto->fetch(PDO::FETCH_ASSOC)){

                        $produto_id = $fetch_produto['id'];
                        $preco = $fetch_produto['preco'];
                        $quantidade = $fetch_produto["quantidade"];
                        $sub_total  = $fetch_produto['preco']*$pro_qty;
                        $total += $sub_total;

     
      ?>
      <div class="content">
      <input type="hidden" name="produto_id" value="<?= $produto_id;?>">

        <table>
          <thead>
            <tr>
              <th>Produto</th>
              <th>Quantidade</th>
             
            </tr>
          </thead>
          <tbody class="carrinhoproduto">
           <div class="pro">
                <td>

                
                  <div class="produto">
                  
                        <img src="uploaded_files/<?=$fetch_produto['img1'];?>"  onclick="window.location.href='comprar.php?get_id=<?=$produto_id;?>'" alt="">
                        <div class="info">
                        <div class="nome"><?=$fetch_produto['nome_produto'];?></div>
                        <p class="preco" id ="preco">$<?php echo number_format($preco);?> mtcs</p>
                        <p class="cor">tamanho:<span><?php echo $tamanho;?></span></p>
                        <p class="cor"><span><?php echo $quantidade;?> Disponiveis</span></p>
                      


                  </div>
                </td>
                <td>
                <div class="qtv">
                  <span onclick="alterarQuantidade(-1)">-</span>
                  <input type="text" value="<?php echo number_format($pro_qty);?>" id="quantidade" name="quantidade" readonly>
                  <span onclick="alterarQuantidade(1)">+</span>
                </div>
                </td>
                <td>
                  <button class="remove" name="eliminar"><i class="bx bx-x"></i></button>
                </td>
           </div>
          </tbody>
        </table>

      </div>

      

       <?php 

        }
        } else{
        echo'<p class ="empty">Nenhum produto publicado!</p>';
        } 


        }


        }else{
        echo'<p class ="empty">Nenhum produto adicionado ao carrinho!</p>';
        }  
       ?>

          <aside class="resumo_total">
            
            <div class="form">
              <div class="box">
                  <header class=cabeca>Resumo da compra</header>
                    <div class="info">
                      <div><span>Sub-total</span><span id ="subtotal"><?php echo number_format($total);?>mts</span></div>
                      
                      <div><span>Frete</span><span>Gratuito</span></div>
                      <div>
                        <button>
                          Adicionar cupom de  desconto
                          <i class="bx bx-right-arrow-alt"></i>
                        </button>
                      </div>
                    </div>
                    <footer class="footer">
                      <span>Total</span>
                      <span class="total-preco" id="total"><?php echo number_format($total);?>mts</span>
                    </footer>
              </div>
            


              <input type="submit" class="btn" name="adicionar_pagamento_pendente" value="Comprar">

             </div>
          </aside>
      

    </form> 
    
  </div>

  </section> -->

  <script>
    function alterarQuantidade(valor) {
      var quantidadeInput =document.getElementById('quantidade');
      var quantidade = parseInt (quantidadeInput.value, 10);
      var precoSpan =document.getElementById('subtotal');
      var precoTotal =document.getElementById('total');
     

      quantidade += valor;


      if (quantidade < 1){
        quantidade = 1;
      }

      quantidadeInput.value =quantidade;
      precoSpan.textContent = parseFloat(quantidade * <?= $preco ?>).toFixed(2);
      precoTotal.textContent = parseFloat(quantidade * <?= $preco ?>).toFixed(2);
         
    }


  </script>

 






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

