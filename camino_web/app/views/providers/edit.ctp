<div class="providers form">
<?php echo $this->Form->create('Provider');?>
	<fieldset>
 		<legend><?php __('Edit Provider'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tipo_prov');
		echo $this->Form->input('tipo_iden_pro');
		echo $this->Form->input('nit_proveedor');
		echo $this->Form->input('digito_ver');
		echo $this->Form->input('clasificacion');
		echo $this->Form->input('p_nom_prov');
		echo $this->Form->input('s_nom_prov');
		echo $this->Form->input('p_ape_prov');
		echo $this->Form->input('s_ape_prov');
		echo $this->Form->input('representante_legal');
		echo $this->Form->input('pais');
		echo $this->Form->input('departamento');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('direccion');
		echo $this->Form->input('telefono_1');
		echo $this->Form->input('telefono_2');
		echo $this->Form->input('celular');
		echo $this->Form->input('e_mail');
		echo $this->Form->input('estado_proveedor');
		echo $this->Form->input('tipo_regimen');
		echo $this->Form->input('notas_proveedor');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Provider.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Provider.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Providers', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inventories', true), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory', true), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
	</ul>
</div>