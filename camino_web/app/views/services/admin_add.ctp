<div class="services form">
<?php echo $this->Form->create('Service');?>
	<fieldset>
 		<legend><?php __('Nuevo Servicio'); ?></legend>
	<?php
		echo $this->Form->input('nombre',array("div"=>"float"));
		echo $this->Form->input('descripcion',array("label"=>"Descripción","div"=>"float"));
		echo $this->Form->input('contenido');
		
	?>
	</fieldset>
<?php echo $this->Form->end();?>
	
</div>
<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
</div>
<script type="text/javascript">
					CKEDITOR.replace( 'data[Service][contenido]' );
	
</script>