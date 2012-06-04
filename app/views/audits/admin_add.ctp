<div class="audits form">
<?php echo $this->Form->create('Audit');?>
	<fieldset>
 		<legend><?php __('Nueva Auditoria'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('foreing_key');
		echo $this->Form->input('model');
		echo $this->Form->input('alias');
		echo $this->Form->input('action');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Opciones'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Auditorias', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo Usuario', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>