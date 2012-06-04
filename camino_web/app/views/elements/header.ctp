<div class="header_wrap">
     
      <div id="logo" class="sprite logo_tecnocenter">
         
      </div>
	<?php  
	//debug($login);
		$user= $session->read("Auth.User");
		if(empty($user) && !isset($login)):?>
      <div class="login">
          <?php echo $form->create("User",array("action"=>"login","controller"=>"users"));?>
            <fieldset>
              <legend>Zona de Usuarios</legend>
              <?php echo $form->input("email",array("label"=>"Email:"));?>   
              <?php echo $form->input("password",array("label"=>"Contraseña:"));?>
              <?php echo $html->link('Registrarse',array("controller"=>"users","action"=>"register"), array("id"=>"registrarse"));?>
              <?php echo $form->end(__('Ingresar', true), array('div' => false));?>   
 				<div style="clear:both;"></div>
            </fieldset>
         <p>
			<?php echo $html->link("¿Olvidaste tu contraseña?",array("controller"=>"users","action"=>"rememberPassword"))?>
		 </p>
		 <div style="clear:both;"></div>
        </div>
     
      <?php endif;?> 
      <?php if(!empty($user)):?>
    
      <?php endif;?>
     <div style="clear:both;"></div>
</div>

