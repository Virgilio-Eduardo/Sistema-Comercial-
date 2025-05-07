<?php

function buscar_cat_produtos(){

    global $conn;

    $select_cat_prod = $conn -> prepare("SELECT * FROM `categoria_produto` LIMIT 4 ");
       $select_cat_prod ->execute();

        while($fetch_cat_prod = $select_cat_prod->fetch(PDO::FETCH_ASSOC)){
            $p_cat_id = $fetch_cat_prod['cat_prod_id'];

            $p_cat_nome = $fetch_cat_prod['cat_prod_nome'];



             echo"
             <li>
             <a href='listings_cat.php?p_cat=$p_cat_id'>$p_cat_nome</a>
             
             </li>

             ";

        }  

}

function buscar_cat(){

  global $conn;

  $select_cat = $conn -> prepare("SELECT * FROM `categoria` LIMIT 4 ");
     $select_cat ->execute();

      while($fetch_cat= $select_cat->fetch(PDO::FETCH_ASSOC)){
          $cat_id = $fetch_cat['cat_id'];

          $cat_nome = $fetch_cat['cat_nome'];



           echo"
           <li>
           <a href='categoria.php?cat=$cat_id'>$cat_nome</a>
           
           </li>

           ";

      }  

}


function buscarcatpro(){

  global $conn;



}

?>