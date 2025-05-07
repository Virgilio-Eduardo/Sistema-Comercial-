<?php 
include ('components/connect.php');

include ('components/seguranca.php');

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
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">-->

    <title>Lista</title>
</head>

   

<body> 

<?php include ('components/user_header.php'); ?>
  <!--Imoveis-->

  <section class="carrinho">
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
                      


                  </div>
                </td>
                <td>
                <div class="qtv">
                  <span onclick="alterarQuantidade(-1)">-</span>
                  <input type="text" value="<?php echo number_format($pro_qty);?>" id="quantidade" readonly>
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

          <aside class="resumo_total">
            
            <div class="form">
              <div class="box">
                  <header class=cabeca>Resumo da compra</header>
                    <div class="info">
                      <div><span>Sub-total</span><span id ="subtotal"><?php echo number_format($total);?></span></div>
                      
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
                      <span class="total-preco" id="total">$<?php echo number_format($total);?></span>
                    </footer>
              </div>
            


              <input type="submit" class="btn" name="adicionar_pagamento_pendente" value="Comprar">

             </div>
          </aside>
      

    </form> 
    
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

  </section>

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
  
<?php include ('components/footer.php'); ?>



    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>
    
</body>

</html>
