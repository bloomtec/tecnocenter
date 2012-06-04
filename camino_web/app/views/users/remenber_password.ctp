<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend>
 		<?php __('Recordar contraseña y nombre de usuario'); ?>
 		</legend>
 		<br>
	<?php
		echo $this->Form->input('email', array('label'=>'Ingresa tu email'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>