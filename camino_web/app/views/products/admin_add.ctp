<div class="products form">
<?php echo $this->Form->create('Product', array('type'=>'file'));?>
	<fieldset>

 		<legend><?php __('Nuevo Producto' ); ?></legend>
 		<div class="layer" style="width:295px;">
 		<?php
			echo $this->Form->input('category_id',array("div"=>"inline","label"=>"Categoría"));
			echo $this->Form->input('manufacturer_id',array("div"=>"inline","label"=>"Fabricante"));
			echo "<br />";
			echo $this->Form->input('estado',array("div"=>"inline","options"=>array("Activo"=>"Activo","Inactivo"=>"Inactivo")));
			echo $this->Form->input('rotacion',array("label"=>"Rotación","div"=>"inline","options"=>array("Alta"=>"Alta","Media"=>"Media","Baja"=>"Baja")));
			echo $this->Form->input('nombre');
			echo $this->Form->input('codigo',array("label"=>"Código"));
			echo $this->Form->input('cod_barras');
			echo $this->Form->input('descripcion',array("label"=>"Descripción"));
			echo $this->Form->input('promocionar',array("div"=>"inline check"));
			echo $this->Form->input('destacar',array("div"=>"inline check"));
		?>
 		</div>
 		<div class="layer" style="width:141px;">
 		<?php
		
		echo $this->Form->input('inventario',array("disabled"=>true));
		echo $this->Form->input('stock_minimo',array("label"=>"Stock Mínimo"));
		echo $this->Form->input('stock_maximo',array("label"=>"Stock Máximo"));
		echo $this->Form->input('costo');
		echo $this->Form->input('costo_promedio');
		
		?>
 		</div>
 		<div class="layer" style="width:141px;">
 		<?php 
		echo $this->Form->input('valor_venta',array("class"=>"valorVenta"));
 		
 		echo $this->Form->input('tarifa_iva',array("options"=>array("0"=>"0","10"=>"10","16"=>"16","20"=>"20")));
		echo $this->Form->input('valor_iva',array("disabled"=>true,"class"=>"valorIva"));
		echo $this->Form->input('valor_iva',array("type"=>"hidden","class"=>"valorIva","id"=>"valorIva"));
		
		echo $this->Form->input('valor_base',array("disabled"=>true,"class"=>"valorBase"));
		echo $this->Form->input('valor_base',array("type"=>"hidden","class"=>"valorBase","id"=>"valorBase"));
		//echo $this->Form->input('valor_venta',array("type"=>"hidden","class"=>"valorVenta","id"=>"valorVenta"));
		echo $this->Form->input('porc_utilidad',array("label"=>"% Utilidad","class"=>"porcentaje","id"=>"porcentaje","disabled"=>true));
		echo $this->Form->hidden('porc_utilidad',array("label"=>"% Utilidad","class"=>"porcentaje"));
		echo $this->Form->input('tiempo_reposicion',array("label"=>"Tiempo Reposición"));
 		?>

 		</div>
 		<div class="layer" style="width:300px;">
 		<?php
 			echo $this->Form->input('ficha_producto', array("type"=>"file", "id"=>"ficha_producto"));
 			echo $this->Form->input('imagen_listado', array("type"=>"file", "id"=>"imagen_listado"));
 			echo $this->Form->input('imagen_principal', array("type"=>"file", "id"=>"imagen_principal"));
			echo $this->Form->input('imagen_destacar', array("type"=>"file","id"=>"imagen_destacar"));
			//echo $this->Form->input('imagen_ficha_tecnica', array("label"=>"Imagen Ficha Técnica","type"=>"file","id"=>"imagen_ficha_tecnica"));
		?>
 		</div>

	</fieldset>
	<?php echo $this->Form->end();?>
	<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
	</div>





</div>