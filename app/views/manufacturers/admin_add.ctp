<div class="manufacturers form">
<?php echo $this->Form->create('Manufacturer');?>
	<fieldset>
 		<legend><?php __('Nuevo Fabricante'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
</div>