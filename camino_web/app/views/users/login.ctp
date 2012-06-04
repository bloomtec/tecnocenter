<div class="internal_login">
	<h1> <?php __("Zona de Usuarios")?> </h1>
<?php echo $this->Html->link(__('Recuperar contraseña', true), array('controller' => 'users', 'action' => 'rememberPassword'));?>
<?php echo $session->flash('auth');?>
<?php echo $this->Form->create('User');?>
	<fieldset>
 	
	<?php
		echo $this->Form->input('email', array('label'=>'Usuario'));
		echo $this->Form->input('password',array('type'=>'password'));
	?>
	</fieldset>
<?php echo $html->link('Registrarse',array("controller"=>"users","action"=>"register"), array("id"=>"registrarse"));?>
<?php echo $this->Form->end(__('Ingresar', true));?>
 
</div>
