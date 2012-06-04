<div class="tipoDocumentos form">
<?php echo $this->Form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php __('Admin Add Tipo Documento'); ?></legend>
	<?php
		echo $this->Form->input('nombre');
	?>
	</fieldset>
<?php echo $this->Form->end();?>
	<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tipo Documentos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inventory Movements', true), array('controller' => 'inventory_movements', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory Movement', true), array('controller' => 'inventory_movements', 'action' => 'add')); ?> </li>
	</ul>
</div>