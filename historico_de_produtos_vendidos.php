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

    <title>Lista</title>
</head>


<body> 

<?php include ('components/user_header.php'); ?>
  <!--Imoveis-->

  <section class="historico_de_vendas">

  <div class="box-container">

   
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

                                        
                                        $verify_itens_pedido = $conn->prepare("SELECT * FROM `produtos_pedidos` 
                                        WHERE pedido_id  = ? AND produto_id =? AND vendedor= ?  ORDER BY date DESC");
                                        $verify_itens_pedido->execute([$pagamento_id, $produto_id, $nome_loja]);

                                        $verify_mensagem = $conn->prepare("SELECT * FROM `notificacoes_pedidos` 
                                        WHERE id  = ? AND produto_id =? AND estado = 'Acaminho'   ORDER BY date DESC");
                                        $verify_mensagem->execute([$pagamento_id, $produto_id]);


                        ?>
                    <form action="" method="post">

                    <tbody>

                        <tr>
                            <input type="hidden" name="pagamento_id" value="<?= $pagamento_id;?>">
                            <input type="hidden" name="produto_id" value="<?= $produto_id;?>">
                            <input type="hidden" name="comprador" value="<?= $comprador;?>">
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
                            
                            <td ><p class="estado">Vendido</p></td>

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

        <div class="flex-btn">
                <div class="box">
                    <a href="minha_conta.php"> < Voltar</a>
                </div>

       
        </div>
      
  </div>


   </section>


<?php include ('components/footer.php'); ?>


    <script src="js/script.js"></script>
    
<?php include ('components/message.php'); ?>
    
</body>

</html>
