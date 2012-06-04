<div class="inventories form">
<?php echo $this->Form->create('Inventory');?>
	<fieldset>
 		<legend><?php __('Editar Inventario'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('provider_id');
		echo $this->Form->input('stock');
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php //echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
</div>