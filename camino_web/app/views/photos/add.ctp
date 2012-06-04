<div class="photos form">
<?php echo $this->Form->create('Photo');?>
	<fieldset>
 		<legend><?php __('Add Photo'); ?></legend>
	<?php
		echo $this->Form->input('photo_album_id');
		echo $this->Form->input('path');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('thumb');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Photos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Photo Albums', true), array('controller' => 'photo_albums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo Album', true), array('controller' => 'photo_albums', 'action' => 'add')); ?> </li>
	</ul>
</div>