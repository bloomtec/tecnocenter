<div class="inventories form movement">
<?php echo $this->Form->create('Inventory',array("action"=>"movements"));?>
	<fieldset>
 		<legend><?php __('Registrar Salida'); ?></legend>
	<div class="layer">
		<?php
		$errors=$session->read("errors");
		$afterCantidad["label"]="Cantidad";
		$afterNumeroDocumento["label"]="Número Documento";
		if(isset($errors["Inventory"]["stock"])){
			$afterCantidad=array("after"=>'<div class="error-message">'.$errors["Inventory"]["stock"].'</div>');
		}
		if(isset($errors["InventoryMovement"]["numero_documento"])){
			$afterNumeroDocumento["after"]='<div class="error-message">'.$errors["InventoryMovement"]["numero_documento"].'</div>';
		}
		echo $this->Form->input('provider_id',array("size"=>7,"label"=>"Proveedor"));
		
		?>
	</div>
	<div class="layer">
		<?php 
		echo $this->Form->input('InventoryMovement.numero_documento',$afterNumeroDocumento);
		echo $this->Form->input('product_codigo',array("id"=>"product-autocomplete","label"=>"Código Producto"));
		echo $this->Form->input('product_id',array("type"=>"hidden","id"=>"productId"));
		echo $this->Form->input('Audit.action',array("type"=>"hidden","value"=>"Salidas Varias"));
		echo $this->Form->input('stock',$afterCantidad);
		?>
	</div>
	<div class="layer">
		<?php
		echo $this->Form->input('InventoryMovement.detalle');
		echo $this->Form->input('InventoryMovement.tipo_documento_id',array("value"=>"6","type"=>"hidden"));
		?>
	</div>
	</fieldset>
<?php echo $this->Form->end();?>
	<div class="botones">
		<?php //echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
	</div>
</div>