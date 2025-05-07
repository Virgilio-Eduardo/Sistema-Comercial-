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

<section class="painel_admin">
  <div class="box-container">
    <div class="box">
      <?php 
      $verificar_saldo_admin =$conn ->prepare("SELECT * FROM `saldo` WHERE vendedor = ? ORDER BY data DESC ");
      $verificar_saldo_admin -> execute([$user_id]);
      $buscar_saldo_admin = $verificar_saldo_admin ->fetch(PDO::FETCH_ASSOC);
      
      $saldo= $buscar_saldo_admin["valor_disponivel"];

      ?>
    <i><img src="../img/crescimento.png" alt=""></i>
      <div class="info">
        <p class="saldo">Saldo</p>
        <span>$<?= $saldo;?></span>
      </div>
      <p><span class="percentagem">+55%</span><span class="desc">Disponivel</span></p>
    </div>

    <div class="box">
    <?php 
      $selecionar_cliente = $conn -> prepare("SELECT * FROM `users` WHERE nivel_acesso = 1");
      $selecionar_cliente ->execute();
      $buscar_cliente =$selecionar_cliente ->rowCount();
      ?>
    <i><img src="../img/cliente.png" alt=""></i>
      <div class="info">
        <p class="saldo">Clientes</p>
        <span><?=$buscar_cliente;?></span>
      </div>
      <p><span class="percentagem">+3%</span><span class="desc">somente hoje</span></p>
    </div>

    <div class="box">
      <?php 
      $selecionar_usuario = $conn -> prepare("SELECT * FROM `users` ");
      $selecionar_usuario ->execute();
      $buscar_usuario =$selecionar_usuario ->rowCount();
      ?>
      <i><img src="../img/cliente.png" alt=""></i>
      <div class="info">
        <p class="saldo">Usuaris de hoje</p>
        <span><?=$buscar_usuario;?></span>
      </div>
      <p><span class="percentagem">+34%</span><span class="desc">online</span></p>
    </div>

    <div class="box">
    <?php 
      $selecionar_vendas = $conn -> prepare("SELECT * FROM `produto_recebido` ");
      $selecionar_vendas ->execute();
      $buscar_vendas =$selecionar_vendas ->rowCount();
      ?>
      
    <i><img src="../img/carrinho.png" alt=""></i>
      <div class="info">
        <p class="saldo">Vendas</p>
        <span>$4,000</span>
      </div>
      <p><span class="percentagem">+2%</span><span class="desc">vendas somente de ontem</span></p>
    </div>
  </div>

</section>

<section class="historico_de_vendas">
  <div class="box-container">
    
  <div class="zona-ordens">

  <hr>

  <div class="table-responsive" >
    <table class ="table">
        <thead class="bar">
            <tr>
                <th>On:</th>                  
                <th>Preco pago:</th>
                <th>Produto:</th>
                <th>Quantidade:</th>
                <th>Tamanho</th>
                <th>Data:</th>
                <th>estado do produto ></th>
                            
            </tr>
        </thead>  
        <?php
          $verificar_produto_pago = $conn->prepare("SELECT * FROM `pagamento_confirmado` ORDER BY date DESC
           ");
          $verificar_produto_pago->execute();



          if($verificar_produto_pago ->rowCount()>0){
              while($fetch_produto = $verificar_produto_pago ->fetch(PDO::FETCH_ASSOC)){

                $id_pagamento = $fetch_produto['id'];
                $produto_id = $fetch_produto['produto_id'];
                $preco = $fetch_produto['preco_pago'];
                $quantidade = $fetch_produto['quantidade'];
                $tamanho= $fetch_produto['tamanho'];
                $comprador = $fetch_produto['comprador'];
                $vendedor = $fetch_produto['vendedor'];
                $data = $fetch_produto['date'];


                $selecionar_produto = $conn->prepare("SELECT * FROM `produto`
                WHERE id = ?  ORDER BY date DESC
                ");
               $selecionar_produto->execute([$produto_id]);
               $buscar_produto_img =  $selecionar_produto->fetch(PDO::FETCH_ASSOC);



           $verificar_produto_pendente = $conn->prepare("SELECT * FROM `produtos_pedidos`
           WHERE pedido_id = ? AND produto_id = ? AND quantidade = ? ORDER BY date DESC
           ");
          $verificar_produto_pendente->execute([$id_pagamento, $produto_id, $quantidade]);

          $select_vendedor = $conn -> prepare("SELECT * FROM `users` 
          WHERE  id = ? ");
          $select_vendedor ->execute([$vendedor]);
          $buscar_nome_vendedor =  $select_vendedor->fetch(PDO::FETCH_ASSOC);
          $nome_loja = $buscar_nome_vendedor ['nome_loja'];

          if ($verificar_produto_pendente -> rowCount() >0){
        
            ?>
          
        <?php
         }else{  ?>
         

            <form action="" method="post">

            <tbody>

                <tr>
                <input type="hidden" name="produto_id" value="<?= $produto_id;?>">

                    <td data-label="On">#</td>
                    <td data-label="Nome da loja"><p ><?php echo $preco;?></p></td>
                    <td data-label="Perfil"><img src="../uploaded_files/<?=$buscar_produto_img['img1'];?>"  alt=""></td>
                    <td data-label="Nome"><?php echo $quantidade;?>
                    </td>
                    <td data-label="Cidade "><?php echo $tamanho;?></td>
                    <td data-label="Numero"><?php echo $data;?></td>            
                    <td data-label=">"> <p class="pendente">Pendente</p>
                    </td>

                </tr>

            </tbody>

            </form>



         <?php 

            }
            
            }

            }
         
         
         ?>
                                    
    

    </table>

 </div>


</div>
  </div>
</section>



<?php include ('../components/footer_admin.php'); ?>

<script src="../js/admin.js"></script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
<?php include ('../components/message.php'); ?>
    
</body>
</html>