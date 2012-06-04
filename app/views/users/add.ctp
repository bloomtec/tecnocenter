<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('role_id');
		echo $this->Form->input('tipo_identificacion');
		echo $this->Form->input('primer_nombre');
		echo $this->Form->input('segundo_nombre');
		echo $this->Form->input('primer_apellido');
		echo $this->Form->input('segundo_apellido');
		echo $this->Form->input('email');
		echo $this->Form->input('direccion');
		echo $this->Form->input('pais');
		echo $this->Form->input('departamento');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('telefono');
		echo $this->Form->input('telefono_adicional');
		echo $this->Form->input('celular');
		echo $this->Form->input('celular_adicional');
		echo $this->Form->input('foto');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Roles', true), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role', true), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Audits', true), array('controller' => 'audits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Audit', true), array('controller' => 'audits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Passoword Changes', true), array('controller' => 'passoword_changes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Passoword Change', true), array('controller' => 'passoword_changes', 'action' => 'add')); ?> </li>
	</ul>
</div>