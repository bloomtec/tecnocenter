<div class="onlineSales form">
<?php echo $this->Form->create('OnlineSale');?>
	<fieldset>
 		<legend><?php __('Admin Edit Online Sale'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('id_cuenta');
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('porcentaje_iva');
		echo $this->Form->input('valor_unit');
		echo $this->Form->input('subtotal');
		echo $this->Form->input('valor_iva');
		echo $this->Form->input('valor_total');
	?>
	</fieldset>
<?php echo $this->Form->end();?>
	<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php //echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
	</div>
</div>

