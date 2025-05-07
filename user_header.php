<header class="header">

    <div class="flex">
      
    <div  class="menu_principal desktop-hide">=<i class="ri-menu-2-line"></i></div>
    
        <div class="box">
                 
                  <nav class=mobile-hide>
                  <div class="logo"> <a href="#" class="circle"><span>.Showprite</span></a></div>

                        <ul class="meno_hidden" >

                        <?php if(  $nivel_acesso == 1){ ?>
                          
                          <li><a href="painel.php">painel</a></li>
                          <?php 
                                $select_items =$conn -> prepare("SELECT * FROM `pagamento_confirmado` WHERE  vendedor = ?");
                                $select_items ->execute([$user_id]);

                                  $buscar_total_venda = $select_items-> rowCount();   
                            
                                                  
                            ?>

                          <li><a href="my_listings.php">meus produtos</a></li>
                        <li><a href="minha_conta.php">
                           <div class="fly-item">
                              <span class="item-number"><?php if($select_items ->rowCount()>0){?> <h3 class="items"><?=$buscar_total_venda;?></h3> <?php } ?></span>
                            </div>
                         pedidos
                           
                        </a></li>
                          <li><a href="listings.php">loja</a></li>

                          <?php }else { ?></li>
                        
                            <li><a href="listings.php">loja</a></li>
                        <li><a href="conta_cliente.php">Conta</a></li>
                        <li><a href="home.php">Contactar-nos</a></li>

                      <?php } ?></li>


                    </ul>

              </nav>
        </div>

<div class="box-icon">
  <ul>
  <li><a href="#">P<i class="bx bx-search"></i></a></li>
            <li><a href="notificacao_cliente.php"><i class="bx bx-message"></i>M</a></li>

    

       
                <li ><a href="#">U<i class="bx bx-user"></i></a>
                  <ul>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="cadastrar.php">Cadastrar</a></li>
                            
                            <?php if( $user_id !=''){ ?>
                      <li><a href="atualizar_dados.php">Atualizar perfil</a></li>
                      <li><a href="components/user_logout.php" onclick="return
                        confirm('Deseja sair dessa conta?');">Sair</a>
                      <?php } ?></li>
                  </ul>
                </li>
          

            <?php 
                $select_item =$conn -> prepare("SELECT * FROM `carrinho` WHERE  user_id = ?");
                $select_item ->execute([$user_id]);
            
                $buscar_total_items = $select_item-> rowCount();
            
            
            ?>

            <?php if($nivel_acesso == 0){ ?>
              <li>
              <a href="carrinho.php">
             
             <i class="bx bx-cart">
             <div class="fly-item">
            <span class="item-number"><?php if($select_item ->rowCount()>0){?> <h3 class="items"><?=$buscar_total_items;?></h3> <?php } ?></span>
            </div>  
             
             C</i></a>
              </li>
            <?php }?>


  </ul>

</div>
   <!--     <div class="mini-cart">
              <div class="cart-head">
                5 items no carrinho
              </div>
              <div class="cart-body">
                <ul class="products mini">
                  <li class="item">
                    <div class="thumbnail object-cover">
                      <a href="#">
                        <img src="img/f1 (3).jpg" alt="">
                      </a>
                    </div>
                    <div class="item-content">
                        <p><a href="#">Camisa</a></p>
                        <span class="price">
                          <span>2.00mt</span>
                          <span class="fly-item"><span>2x</span></span>
                        </span>
                    </div>
                    <a href="" class="item-remove"><i class="ri-close-line">x</i></a>
                  </li>

                  <li class="item">
                    <div class="thumbnail object-cover">
                      <a href="#">
                        <img src="img/f1 (3).jpg" alt="">
                      </a>
                    </div>
                    <div class="item-content">
                        <p><a href="#">Camisa</a></p>
                        <span class="price">
                          <span>2.00mt</span>
                          <span class="fly-item"><span>2x</span></span>
                        </span>
                    </div>
                    <a href="" class="item-remove"><i class="ri-close-line">x</i></a>
                  </li>
                </ul>
              </div>
            </div>
</div>
            -->
</header>