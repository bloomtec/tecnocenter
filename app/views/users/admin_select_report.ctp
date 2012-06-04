<div class="users form">
<?php echo $this->Form->create('User', array('action'=>'userReports'));?>
	<fieldset>
		
		
 		<legend><?php __('Reportes de usuarios, selecciona los campos a mostrar'); ?></legend>
			<br>	
			<div class="user_type">
				<?php echo $this->Form->input('role_id', array('label'=>'Tipo de usuario','type'=>'select','values'=>$roles));?>
				<div style="clear:both; margin:0;"></div>
			</div>
			
			<div>
			<?php //echo $this->Form->input('role_id', array('label'=>'Rol','type'=>'checkbox'));?>
			</div>
			<div class="options">	
				<div>
				<?php echo $this->Form->input('tipo_identificacion', array('label'=>'Tipo identificación','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('primer_nombre', array('label'=>'Primer nombre','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('segundo_nombre', array('label'=>'Segundo nombre','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('primer_apellido', array('label'=>'Primer apellido','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('segundo_apellido', array('label'=>'Segundo apellido','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('email', array('label'=>'E-mail','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('direccion', array('label'=>'Dirección','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('pais', array('label'=>'País','type'=>'checkbox'));?>
				</div>
				
				
				<div>
				<?php echo $this->Form->input('departamento', array('label'=>'Departamento','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('ciudad', array('label'=>'Ciudad','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('telefono', array('label'=>'Teléfono','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('telefono_adicional', array('label'=>'Teléfono adicional','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('celular', array('label'=>'Celular','type'=>'checkbox'));?>
				</div>
				
				<div>
				<?php echo $this->Form->input('celular_adicional', array('label'=>'Celular adicional','type'=>'checkbox'));?>
				</div>
				<div style="clear:both; margin:0;"></div>
			</div>
		
			
		</fieldset>
		<br>
		
</div>
<div class="botones">
	<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
	<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"selectAll"));?>
	<?php //echo $this->Form->button(null, array('label'=>null,'id'=>'deselectAll','type'=>'button'));?>
	<?php echo $form->button("",array("class"=>"limpiar"));?>
</div>
