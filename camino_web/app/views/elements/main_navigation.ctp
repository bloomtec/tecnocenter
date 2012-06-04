<div id="main-navigation">

          <ul class="main_nav">
            
            <li>

            	<?php 
            	echo $html->link("Inicio",
            			"/",
						array(
							"class"=>"color home other",
						)
					);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("Nuestra Empresa",
            			array(
							"controller"=>"pages","action"=>"empresa"),
						array(
							"class"=>"other color nuestra-empresa",
						)
						);
				?>
            </li>
             <li>
            	<?php 
            	echo $html->link("Contáctenos",
            			"/contactenos",
						array(
							"class"=>"final color contactenos",
						)
						);
				?>
            </li>
            <li>
            	<?php 
            	echo $html->link("Ayuda",
            			array(
							"controller"=>"pages","action"=>"ayuda"),
						array(
							"class"=>"other color servicios",
						)
						);
				?>
            </li>
           
            
          </ul>
    <?php
		$user=$session->read("Auth.User");
		if($user){
		echo "<div class='opciones-logueado'>";
	    echo $html->tag('span', '', array('class' => 'sprite account_icon'));
		echo $html->link("Mi cuenta",
						array(
							"controller"=>"users","action"=>"view",$user["id"]),
						array(
							"class"=>"my-account",
						)
						); ?>
			
		<div class="logout">
			<?php echo $html->image("icono-salir.png")?>
      		<?php echo $html->link("salir",array("controller"=>"users","action"=>"logout"));?>
      	</div>
	<?php	
		echo "</div>";
		}
	 ?>
</div>