<?php 
include ('../components/connect.php');

include ('../components/seguranca_compra.php');

include ('enviar_dados/apagar.php');


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
    <title>Visualizar clientes</title>
</head>
<body>

<?php include ('../components/admin_header.php'); ?>

<section class="historico_de_vendas">

<div class="box-container">

 
      <div class="zona-ordens">


          <hr>

          <div class="table-responsive" >
              <table class ="table">
                  <thead>
                      <tr>
                          <th>On:</th>
                          <th>Cliente:</th>
                          <th>Cidade:</th>
                          <th>Numero:</th>
                          <th>Email</th>
                          <th>Nivel</th>
                          <th>></th>
                      </tr>
                  </thead>  
                  <?php
                    $selecionar_users = $conn->prepare("SELECT * FROM `users` WHERE nivel_acesso = 0
                     ");
                    $selecionar_users->execute();



                    if($selecionar_users ->rowCount()>0){
                        while($fetch_usuarios = $selecionar_users ->fetch(PDO::FETCH_ASSOC)){

                            $usuario_id = $fetch_usuarios['id'];
                            $nome_loja = $fetch_usuarios['nome_loja'];
                            $nome = $fetch_usuarios['nome'];
                            $cidade = $fetch_usuarios['cidade'];
                            $number = $fetch_usuarios['number'];
                            $email = $fetch_usuarios['email'];
                            $nivel = $fetch_usuarios['nivel_acesso'];
                            $img = $fetch_usuarios['img'];



                      ?>
                  <form action="" method="post">

                  <tbody>

                      <tr>
                      <input type="hidden" name="usuario_id" value="<?= $usuario_id;?>">                    

                          <td data-label="On">#</td>
                          <td data-label="Nome"><?php echo $nome;?>
                          </td>
                          <td data-label="Cidade "><?php echo $cidade;?></td>
                          <td data-label="Numero"><?php echo $number;?></td>
                          <td data-label="Email"><?php echo $email;?></td>
                          <td data-label="Nivel"><?php echo $nivel;?></td>               
                          <td data-label=">"> <p class="estado"><button class="confi"><a 
                          <?php if($nivel_acesso == 5){ ?> href='editar_perfil_usuario.php?edit=<?=$usuario_id;?>' <?php }?>
                          >Editar</a></button>
                           <?php if($nivel_acesso == 5){ ?> <button class="confirmar" name="apagar_vendedor">Apagar</button><?php }?></td>

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
                    <a href="visualizar_vendedores.php"> < Voltar</a>
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