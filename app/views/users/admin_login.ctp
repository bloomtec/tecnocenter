<div class="login">
	<h1> <?php __("Ingreso al Back-End")?> </h1>
<?php echo $this->Session->flash('auth');?>
<?php echo $this->Form->create('User');?>
	<fieldset>
 	
	<?php
		echo $this->Form->input('email', array('label'=>'Usuario'));
		echo $this->Form->input('password',array('type'=>'password'));
		//echo $this->Form->input('rol',array('type'=>'hidden','value'=>'x'));
	?>
	</fieldset>
<?php echo $html->image("keys.png"); ?>
<?php echo $this->Form->end(__('Ingresar', true));?>
<div style="clear:both;"> </div>
</div>