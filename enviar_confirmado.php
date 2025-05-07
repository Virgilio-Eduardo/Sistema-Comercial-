<?php 

//enviar confirmado ao cliente //
if(isset($_POST['enviar_confirmado'])){
    if($user_id !='' || $nivel_acesso == 1){
        $notificacao_id = create_unique_id();

        $pagamento_id = $_POST['pagamento_id'];
        $pagamento_id = filter_var($pagamento_id, FILTER_SANITIZE_STRING);

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

        $comprador = $_POST['comprador'];
        $comprador = filter_var($comprador, FILTER_SANITIZE_STRING);

        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);


        $verify_pagamento_confirmado = $conn -> prepare("SELECT * FROM `pagamento_confirmado` 
        WHERE  vendedor = ? ORDER BY date DESC");
        $verify_pagamento_confirmado ->execute([$user_id]);

        if($verify_pagamento_confirmado-> rowCount()>0){
            while($fetch_pagamento_confirmado = $verify_pagamento_confirmado->fetch(PDO::FETCH_ASSOC)){
                

                $vendedor=$fetch_pagamento_confirmado['vendedor'];
                $preco_pago = $fetch_pagamento_confirmado['preco_pago'];
                $taxa = $fetch_pagamento_confirmado['taxa'];



           

                $select_vendedor = $conn -> prepare("SELECT * FROM `users` 
                WHERE  id = ? ");
                $select_vendedor ->execute([$vendedor]);
                $buscar_nome_vendedor =  $select_vendedor->fetch(PDO::FETCH_ASSOC);
                $nome_loja = $buscar_nome_vendedor ['nome_loja'];
                $endereco_da_loja = $buscar_nome_vendedor['cidade'];

           

                        
                $verify_produto_pedidos= $conn -> prepare("SELECT * FROM `produtos_pedidos` 
                WHERE   pedido_id = ? AND produto_id =? AND vendedor = ? ORDER BY date DESC ");
                $verify_produto_pedidos ->execute([$pagamento_id, $produto_id, $nome_loja]);

                if($verify_produto_pedidos->rowCount()>0){

                    $warning_msg[]= 'Este produto ja foi confirmado!';

                }else{     

    
                        $enviar_pedido =$conn -> prepare("INSERT INTO `produtos_pedidos` (pedido_id, produto_id, quantidade, vendedor,comprador) 
                        VALUES(?,?,?,?,?)");
                        $enviar_pedido ->execute([$pagamento_id, $produto_id, $quantidade,  $nome_loja, $comprador]);
                        $sucess_msg[]= 'Produto foi confirmado!';

                        $enviar_noticacao_ao_cliente =$conn -> prepare("INSERT INTO `notificacoes_pedidos` (id,produto_id , vendedor, comprador, estado, mensagem) 
                        VALUES(?,?,?,?,?,?)");
                        $enviar_noticacao_ao_cliente ->execute([$pagamento_id, $produto_id, $vendedor,  $comprador,"confirmado", "Seu pedido foi confirmado, Ja podes vir levantar"]);

                           //atualizar estoque
                           $selecionar_produto = $conn ->prepare("SELECT * FROM `produto` WHERE id = ?  ");
                           $selecionar_produto ->execute([$produto_id]);
                           $buscar_produto = $selecionar_produto ->fetch(PDO::FETCH_ASSOC);
                           $quantidade = $buscar_produto["quantidade"];

                           $nova_quantidade = $quantidade - 1;

                           $atualizar_estoque= $conn->prepare("UPDATE `produto` SET quantidade = $nova_quantidade WHERE id = ? ");
                           $atualizar_estoque->execute([$produto_id]);
   

                 

                        //atualizar saldo admin
                        $selecionar_admin = $conn -> prepare("SELECT * FROM `users` 
                        WHERE  nivel_acesso = 5 ");
                        $selecionar_admin ->execute();
                        $buscar_id_admin = $selecionar_admin->fetch(PDO::FETCH_ASSOC);

                        $id_admin = $buscar_id_admin["id"];

                        $saldo_admin = $conn-> prepare("SELECT * FROM `saldo` WHERE vendedor = ? ");
                        $saldo_admin ->execute([$id_admin]);
                        $buscar_saldo_admin = $saldo_admin->fetch(PDO::FETCH_ASSOC);
                        $saldo_atual_admin = $buscar_saldo_admin["valor_disponivel"];

                        $novo_saldo_admin = $saldo_atual_admin  + $taxa;

                        $atualizar_saldo_admin = $conn->prepare("UPDATE `saldo` SET valor_disponivel = $novo_saldo_admin WHERE vendedor =  ? ");
                        $atualizar_saldo_admin->execute([$id_admin]);

 

                }






                


            }

        }else{
            $warning_msg[]= 'Nenhum pagamento efectuado!';
        }


        

    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
        header('location:login.php');
    
    }
}

if (isset($_POST['enviar_produto_entregue_com_sucesso'])){
    if($user_id !='' || $nivel_acesso == 1){

        $notificacao_id = create_unique_id();

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

        
        $pagamento_id = $_POST['pagamento_id'];
        $pagamento_id = filter_var($pagamento_id, FILTER_SANITIZE_STRING);

        $comprador = $_POST['comprador'];
        $comprador = filter_var($comprador, FILTER_SANITIZE_STRING);
        
  
        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);

        $mensagem = "Produto entregue com sucesso";


 

        $verificar_produto_pedido  =  $conn -> prepare ("SELECT * FROM `produtos_pedidos` WHERE 
        pedido_id  = ? AND produto_id =?  ORDER BY date DESC");
        $verificar_produto_pedido -> execute([$pagamento_id, $produto_id]);
       


        while( $fetch_produto_pedido = $verificar_produto_pedido->fetch(PDO::FETCH_ASSOC)){
            $vendedor= $fetch_produto_pedido['vendedor'];

    
            if($verificar_produto_pedido -> rowCount()>0 ){
                

                    $select_vendedor = $conn -> prepare("SELECT * FROM `users` 
                    WHERE  id = ? ");
                    $select_vendedor ->execute([$vendedor]);
                    $buscar_nome_vendedor =  $select_vendedor->fetch(PDO::FETCH_ASSOC);
                


                    $verify_produto_recebido= $conn -> prepare("SELECT * FROM `produto_recebido` 
                    WHERE produto_recebido_id  = ? AND produto_id=?  ORDER BY data DESC");
                    $verify_produto_recebido ->execute([$pagamento_id, $produto_id]);

                    if($verify_produto_recebido ->rowCount()>0){

                        $warning_msg[]= 'Este produto ja foi enviado!';  
                    }else{

                        $inserir_produto_recebido =$conn -> prepare("INSERT INTO `produto_recebido` (produto_recebido_id, produto_id, quantidade, vendedor, comprador, estado) 
                        VALUES(?,?,?,?,?,?)");
                        $inserir_produto_recebido ->execute([$pagamento_id, $produto_id, $quantidade,  $vendedor, $comprador,"Entregue"]);
                        

                        $enviar_noticacao_ao_cliente =$conn -> prepare("INSERT INTO `notificacoes_pedidos` (id,produto_id , vendedor, comprador, estado, mensagem) 
                        VALUES(?,?,?,?,?,?)");
                        $enviar_noticacao_ao_cliente ->execute([$pagamento_id, $produto_id, $vendedor,  $comprador,"Entregue", $mensagem]);

                        $sucess_msg[]= 'Produto foi entregue com sucesso!';
                    }

                
            }else{
                $warning_msg[]= 'Este produto ainda nao foi confirmado!';  
            }


        }





    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
        header('location:login.php');
    }

}


//LEVANTAMENTO SALDO ADMIN//

if(isset($_POST['levantamento_saldo_admin'])){
    if($user_id !='' || $nivel_acesso == 5){

        $id_transacao = create_unique_id();
    
        $dinheiro = $_POST['dinheiro'];
        $dinheiro = filter_var($dinheiro, FILTER_SANITIZE_STRING);

        $operadora = $_POST['operadora'];
        $operadora = filter_var($operadora, FILTER_SANITIZE_STRING);

        
        $verificar_saldo = $conn ->prepare("SELECT * FROM `saldo` WHERE vendedor = ? ORDER BY data DESC ");
        $verificar_saldo ->execute([$user_id]);
        $buscar_saldo = $verificar_saldo -> fetch(PDO::FETCH_ASSOC);

        $valor_disponivel = $buscar_saldo['valor_disponivel'];
        $vendedor = $buscar_saldo['vendedor'];
                        


        if ($verificar_saldo ->rowCount() > 0){

            if ($dinheiro > $valor_disponivel){

                $warning_msg[]= 'Saldo insuficiente!';
            }else{
               
                $novo_saldo = $valor_disponivel - $dinheiro;

                $atualizar_saldo = $conn->prepare("UPDATE `saldo` SET valor_disponivel = $novo_saldo WHERE vendedor =  ? ");
                $atualizar_saldo->execute([$user_id]);

                $levantamento = $conn -> prepare("INSERT INTO `levantamento` (id_transacao, vendedor, valor, operadora) VALUES (?,?,?,?)");
                $levantamento -> execute([$id_transacao, $vendedor, $dinheiro, $operadora]);
                header('location:painel_admin.php');


            }


        }else{

            $warning_msg[]= 'Infelismento no momento nao poderas fazer nenhum levantamento!';
        }



        



    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
        header('location:login.php');
    }

}

//Enviar notificacao ao cliente que produto acabo de chegar e enviar dos na tabela produto recebido





?>