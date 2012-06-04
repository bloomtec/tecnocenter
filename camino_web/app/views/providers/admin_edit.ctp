<div class="providers form">
<?php echo $this->Form->create('Provider');?>
	<fieldset>
 		<legend><?php __('Editar Proveedor'); ?></legend>
 		<div class="layer">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('tipo_prov',array("label"=>"Tipo Proveedor","options"=>array("Natural"=>"Natural","Jurídico"=>"Jurídico")));
			echo $this->Form->input('tipo_iden_pro',array("label"=>"Tipo Identificación","options"=>array("Cédula"=>"Cédula","NIT"=>"NIT")));
			echo $this->Form->input('nit_proveedor',array("disabled"=>true));
			echo $this->Form->input('nit_proveedor',array("type"=>"hidden"));
			echo $this->Form->input('digito_ver',array("label"=>"Dígito Verificación"));
			
		?>
		</div>
		<div class="layer">
		<?php
		echo $this->Form->input('clasificacion',array("label"=>"Clasificación","options"=>array("Accesorios"=>"Accesorios","Cables"=>"Cables","Desktop"=>"Desktop","Insumos"=>"Insumos","Otros"=>"Otros","Periféricos"=>"Periféricos","Portátiles"=>"Portátiles","Redes"=>"Redes","Servidores"=>"Servidores","Software"=>"Software")));
		echo $this->Form->input('razon_social',array("label"=>"Razón Social"));

		echo $this->Form->input('representante_legal');
		?>
		</div>
		<div class="layer">
		<?php
		echo $this->Form->input('pais',array("label"=>"País"));
		echo $this->Form->input('departamento');
		echo $this->Form->input('ciudad');
		echo $this->Form->input('direccion',array("Dirección"));
		echo $this->Form->input('telefono_1',array("label"=>"Teléfono"));
		
		?>
		</div>
		<div class="layer">
		<?php
		echo $this->Form->input('telefono_2',array("label"=>"Teléfono 2"));
		echo $this->Form->input('celular');
		echo $this->Form->input('e_mail',array("label"=>"E-mail"));
		echo $this->Form->input('estado_proveedor');
		echo $this->Form->input('tipo_regimen');

		?>
		</div>
		<div class="layer_proveedor">
		<?php
		echo $this->Form->input('notas_proveedor');
		?>
		</div>

	</fieldset>
<?php echo $this->Form->end();?>
	<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php //echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
	</div>
</div>
