<?php 
if(isset($_POST['enviar_tamanho'])){
    if($user_id != '' || $nivel_acesso == 1){

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

        $tm1 = $_POST['tm1'];
        $tm1 = filter_var($tm1, FILTER_SANITIZE_STRING);

        $tm2 = $_POST['tm2'];
        $tm2 = filter_var($tm2, FILTER_SANITIZE_STRING);

        $tm3 = $_POST['tm3'];
        $tm3 = filter_var($tm3, FILTER_SANITIZE_STRING);

        $tm4 = $_POST['tm4'];
        $tm4 = filter_var($tm4, FILTER_SANITIZE_STRING);

        $tm5 = $_POST['tm5'];
        $tm5 = filter_var($tm5, FILTER_SANITIZE_STRING);

        $verify_produto = $conn ->prepare("SELECT * FROM `produto` WHERE  id = ? AND user_id =? ORDER BY date DESC");   
        $verify_produto ->execute([$produto_id, $user_id]);

        if($verify_produto ->rowCount()>0){

            $verify_produto_tamanho = $conn ->prepare("SELECT * FROM `produto_quantidade_tamanho` WHERE  produto_id = ? AND user_id =? ");   
            $verify_produto_tamanho->execute([$produto_id, $user_id]);

            if($verify_produto_tamanho ->rowCount()>0){
            

                $warning_msg[]= 'Tamanho do Produto ja foi enviado';

            }else{
                $add_produto_tamanho= $conn ->prepare("INSERT INTO `produto_quantidade_tamanho` 
                (produto_id, user_id, tm1, tm2, tm3, tm4, tm5 ) VALUES(?,?,?,?,?,?,?)");
                $add_produto_tamanho->execute([$produto_id, $user_id, $tm1, $tm2, $tm3, $tm4, $tm5 ]);
                $sucess_msg[]= 'Tamanho do Produto enviado com sucesso!';
                header('location:my_listings.php');
            
            }

        }else{
            $warning_msg[]= 'Produto nao cadastrado!';
        }


    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
     }
    
        
   }



if(isset($_POST['enviar'])){
 if($user_id != '' || $nivel_acesso == 0){
    $id = create_unique_id();

    $produto_id = $_POST['produto_id'];
    $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);
    
    $nome = $_POST['nome'];
    $nome = filter_var($nome , FILTER_SANITIZE_STRING);

    $numero = $_POST['numero'];
    $numero = filter_var($numero, FILTER_SANITIZE_STRING);

    
    $localizacao = $_POST['localizacao'];
    $localizacao = filter_var($localizacao, FILTER_SANITIZE_STRING);


    $selecionar_recebedor = $conn -> prepare("SELECT * FROM `produto` WHERE
    id = ? LIMIT 1 ");
    $selecionar_recebedor->execute([$produto_id]);
    $buscar_recebedor = $selecionar_recebedor ->fetch(PDO::FETCH_ASSOC);
    $recebedor = $buscar_recebedor['user_id'];

    $verify_detalhes_comprador = $conn -> prepare("SELECT * FROM `detalhes_comprador` 
        WHERE  enviador = ? AND localizacao = ?");
        $verify_detalhes_comprador ->execute([ $user_id, $localizacao]);
        if($verify_detalhes_comprador -> rowCount() > 0){
            $warning_msg[]= 'Detalhes ja enviados!';
        }else{
            $add_detalhes_comprador = $conn ->prepare("INSERT INTO `detalhes_comprador` 
            (id, enviador, nome, numero, localizacao, recebedor ) VALUES(?,?,?,?,?,?)");
            $add_detalhes_comprador->execute([$id, $user_id, $nome,$numero , $localizacao, $recebedor]);
            $sucess_msg[]= 'detalhes enviado com sucesso!';
            header('location:pagamento.php');
        }


 }else{
    $warning_msg[]= 'Por favor faça login primeiro!';
 }

    
}

  if(isset($_POST['carrinho'])){
    if($user_id != '' || $nivel_acesso == 0){
       $carrinho_id = create_unique_id();
   
       $produto_id = $_POST['produto_id'];
       $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);
       
       $tamanho = $_POST['tamanho'];
       $tamanho = filter_var($tamanho, FILTER_SANITIZE_STRING);

       $quantidade = $_POST['quantidade'];
       $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);

       $preco = $_POST['preco'];
       $preco = filter_var($preco, FILTER_SANITIZE_STRING);




       $select_carrinho = $conn -> prepare("SELECT * FROM `carrinho` WHERE produto_id =? AND user_id = ? ");
       $select_carrinho -> execute([$produto_id, $user_id]);

       if($select_carrinho -> rowCount() > 0){
        $add_produto_carrinho = $conn -> prepare("UPDATE `carrinho` SET  quantidade=? , tamanho=? WHERE produto_id = ?");
        $add_produto_carrinho -> execute([$quantidade, $tamanho, $produto_id]);

        $sucess_msg[]= 'O produto ja foi adicionado ao carrinho!';

       }else{
        $add_produto_carrinho = $conn -> prepare("INSERT INTO `carrinho` (id, produto_id, user_id, quantidade, tamanho, preco) VALUES(?,?,?,?,?,?)");
        $add_produto_carrinho -> execute([$carrinho_id, $produto_id, $user_id, $quantidade, $tamanho, $preco]);
     

       }
     
   
   
    }else{
       $sucess_msg[]= 'Por favor faça login primeiro!';
    }
   
       
}


     if(isset($_POST['add_carrinho'])){
        if($user_id != '' || $nivel_acesso == 0){
           $carrinho_id = create_unique_id();
       
           $produto_id = $_POST['produto_id'];
           $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);
    
    
           $select_carrinho = $conn -> prepare("SELECT * FROM `carrinho` WHERE produto_id =? AND user_id = ? ");
           $select_carrinho -> execute([$produto_id, $user_id]);

           $select_produto = $conn -> prepare("SELECT * FROM `produto` WHERE id = ? ");
           $select_produto -> execute([$produto_id]);
           $fetch_produto =$select_produto->fetch(PDO::FETCH_ASSOC);

           $preco =$fetch_produto['preco'];
    
           if($select_carrinho -> rowCount() > 0){
    
            $warning_msg[]= 'O produto ja foi adicionado ao carrinho!';
    
           }else{
            $add_produto_carrinho = $conn -> prepare("INSERT INTO `carrinho` (id, produto_id, user_id, quantidade, tamanho, preco) VALUES(?,?,?,?,?,?)");
            $add_produto_carrinho -> execute([$carrinho_id, $produto_id, $user_id, 1 , 'S', $preco]);
         
    
           }
         
       
       
        }else{
           $sucess_msg[]= 'Por favor faça login primeiro!';
        }
       
           
         }

//Carrinho-adicionar ao pagamento-pendente//

if(isset($_POST['adicionar_pagamento_pendente'])){
    if($user_id !='' || $nivel_acesso == 0){

        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);
 

        $verify_carrinho = $conn -> prepare("SELECT * FROM `carrinho` 
        WHERE  user_id = ? ");
        $verify_carrinho ->execute([$user_id]);

        if($verify_carrinho-> rowCount()>0){

            while($fetch_produto_carrinho = $verify_carrinho->fetch(PDO::FETCH_ASSOC)){

                $selecionar_vendedor = $conn -> prepare("SELECT * FROM `produto` WHERE
                id = ? LIMIT 1 ");
                $selecionar_vendedor->execute([$fetch_produto_carrinho['produto_id']]);
                $buscar_vendedor = $selecionar_vendedor ->fetch(PDO::FETCH_ASSOC);
                $produto_id =$buscar_vendedor['id'];
                $vendedor = $buscar_vendedor['user_id'];

                
                $pagamento_id = $fetch_produto_carrinho['id'];
                $produto_id = $fetch_produto_carrinho['produto_id'];
                $preco = $fetch_produto_carrinho['preco'];
                $comprador = $fetch_produto_carrinho['user_id'];
                $tamanho = $fetch_produto_carrinho['tamanho'];




                    $add_pagamento = $conn -> prepare("INSERT INTO `pagamento_pendente` (id, produto_id, comprador, preco, quantidade, tamanho, vendedor, estado) 
                    VALUES (?,?,?,?,?,?,?,?) ");
                    $add_pagamento->execute([$pagamento_id, $produto_id, $user_id, $preco, $quantidade, $tamanho, $vendedor, "pendente"]);
                
                    header('location:pagamento.php');
        
         



            }


        }else{
            $warning_msg[]= 'Nao foi possivel fazer pagamento, adiciones os produtos ao carrinho!';
            header('location:listings.php');
        }

      


    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
    }
}


    


     
 if(isset($_POST['eliminar'])){
    if ($user_id != ''|| $nivel_acesso == 0){

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

        $removed_carrinho = $conn ->prepare("DELETE FROM `carrinho` WHERE 
        produto_id = ? AND user_id = ?");
        $removed_carrinho ->execute([$produto_id, $user_id]);

       
    
    }else{
        $sucess_msg[]= 'Por favor faça login primeiro!';
    }
 }
   

 //pagamento-pendente//

  
if(isset($_POST['comprar'])){
    if($user_id !=''|| $nivel_acesso == 0){
        $pagamento_id = create_unique_id();
   
        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);
        
        $tamanho = $_POST['tamanho'];
        $tamanho = filter_var($tamanho, FILTER_SANITIZE_STRING);
 
        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);


        $selecionar_vendedor = $conn -> prepare("SELECT * FROM `produto` WHERE
        id = ? LIMIT 1 ");
        $selecionar_vendedor->execute([$produto_id]);
        $buscar_vendedor = $selecionar_vendedor ->fetch(PDO::FETCH_ASSOC);
        $vendedor = $buscar_vendedor['user_id'];
        $preco = $buscar_vendedor['preco'];

        $verify_pagamento_pendente = $conn -> prepare("SELECT * FROM `pagamento_pendente` 
        WHERE  produto_id = ? AND  comprador = ?  AND quantidade = ? AND tamanho = ? AND vendedor = ?  ");
        $verify_pagamento_pendente ->execute([$produto_id, $user_id, $quantidade, $tamanho, $vendedor ]);
      
        if($verify_pagamento_pendente -> rowCount() > 0){
        
            header('location:pagamento.php');

      
        }else{

            $add_pagamento = $conn -> prepare("INSERT INTO `pagamento_pendente` (id, produto_id, comprador, preco, quantidade, tamanho, vendedor, estado) 
            VALUES (?,?,?,?,?,?,?,?) ");
            $add_pagamento->execute([$pagamento_id, $produto_id, $user_id, $preco, $quantidade, $tamanho, $vendedor, "pendente"]);
            header('location:pagamento.php');
      
        }


    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
    }
}


if(isset($_POST['apagar'])){
    if ($user_id != '' || $nivel_acesso == 0){

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);


        $removed_pagamento = $conn ->prepare("DELETE FROM `pagamento_pendente` WHERE 
       comprador = ?");
        $removed_pagamento ->execute([$user_id]);
        header('location:listings.php');

       
    
    }else{
        $sucess_msg[]= 'Por favor faça login primeiro!';
    }
 }



//pagamento-final//

  
if(isset($_POST['pagamento_final'])){
    if($user_id !='' || $nivel_acesso == 0){

        $quantidade = $_POST['quantidade'];
        $quantidade = filter_var($quantidade, FILTER_SANITIZE_STRING);

        $verify_pagamento_pendente = $conn -> prepare("SELECT * FROM `pagamento_pendente` 
        WHERE  comprador = ? ORDER BY date DESC");
        $verify_pagamento_pendente ->execute([$user_id]);

        if($verify_pagamento_pendente-> rowCount()>0){
            while($fetch_pagamento_pendente = $verify_pagamento_pendente->fetch(PDO::FETCH_ASSOC)){
                $pagamento_id = $fetch_pagamento_pendente['id'];
                $produto_id = $fetch_pagamento_pendente['produto_id'];
                $preco_pago = $fetch_pagamento_pendente['preco']*$quantidade;
                $taxa = $preco_pago * 0.1;
                $comprador = $fetch_pagamento_pendente['comprador'];
                $vendedor = $fetch_pagamento_pendente['vendedor'];
                $tamanho = $fetch_pagamento_pendente['tamanho'];

                $verify_detalhes_comprador = $conn -> prepare("SELECT * FROM `detalhes_comprador` 
                WHERE  enviador = ?");
                $verify_detalhes_comprador ->execute([$user_id]);

                if($verify_detalhes_comprador -> rowCount() > 0){


                     $add_historico_pagamento = $conn -> prepare("INSERT INTO `historico_pagamento` (id_pagamento, produto_id, preco_pago, taxa, comprador, vendedor, quantidade, tamanho, estado) 
                    VALUES (?,?,?,?,?,?,?,?,?) ");
                    $add_historico_pagamento->execute([ $pagamento_id, $produto_id, $preco_pago, $taxa, $user_id, $vendedor, $quantidade, $tamanho, "pago"]);


                    
                    $add_pagamento_final = $conn -> prepare("INSERT INTO `pagamento_confirmado` (id , produto_id, preco_pago, taxa, comprador, vendedor, quantidade, tamanho, estado) 
                    VALUES (?,?,?,?,?,?,?,?,?) ");
                    $add_pagamento_final->execute([ $pagamento_id, $produto_id, $preco_pago, $taxa, $user_id, $vendedor, $quantidade, $tamanho, "pago"]);

                    

                    $sucess_msg[]= 'o seu pagamento foi efetuado com sucesso.';

                    
                    $removed_pagamento_pendente = $conn ->prepare("DELETE FROM `pagamento_pendente` WHERE 
                    id = ? AND comprador = ?");
                    $removed_pagamento_pendente ->execute([$pagamento_id, $user_id]);
                    header('location:listings.php');
                    
                    // Verificacao de  saldo vendedor



                    // Verificacao de saldo Admin
                    $selecionar_usuario_admin = $conn ->prepare("SELECT * FROM `users` WHERE nivel_acesso = 5");
                    $selecionar_usuario_admin ->execute();
                    $buscar_usuario_admin = $selecionar_usuario_admin ->fetch(PDO::FETCH_ASSOC);
                    $usuario_admin = $buscar_usuario_admin["id"];

                    $verificar_saldo_admin = $conn ->prepare("SELECT * FROM `saldo` WHERE vendedor = ? ");
                    $verificar_saldo_admin ->execute([$usuario_admin]);

                    if ($verificar_saldo_admin -> rowCount() > 0){
                        header("location:listings.php");
                    }else{
                        $add_saldo = $conn -> prepare("INSERT INTO `saldo` (vendedor, valor_disponivel) VALUES (?,?)");
                        $add_saldo -> execute([ $usuario_admin, 0]);
                    }

                    





        
              
                }else{
              
                 $warning_msg[]= 'Envie os seus detalhes primeiro!';
                }



            }


        }else{
            $warning_msg[]= 'Nao foi possivel fazer pagamento, por favor tente novamento!';
            header('location:listings.php');
        }

      


    }else{
        $warning_msg[]= 'Por favor faça login primeiro!';
    }
}



if(isset($_POST['apagar_pagamento_pendente_produto'])){
    if ($user_id != '' || $nivel_acesso == 0){

        $produto_id = $_POST['produto_id'];
        $produto_id = filter_var($produto_id, FILTER_SANITIZE_STRING);

 
            
            $removed_pagamento = $conn ->prepare("DELETE FROM `pagamento_pendente` WHERE 
            produto_id = ? AND comprador = ?");
            $removed_pagamento ->execute([$produto_id, $user_id]); 

    

    
    }else{
        $sucess_msg[]= 'Por favor faça login primeiro!';
    }
 }




?>
