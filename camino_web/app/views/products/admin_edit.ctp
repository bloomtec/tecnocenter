<div class="products form">
<?php echo $this->Form->create('Product', array('action'=>'admin_edit',"type"=>"file"));?>
	<fieldset>
		
 		<legend><?php __('Editar Producto'); ?></legend>
 			<div class="layer">
 		<?php
			//debug($this->data);
			echo $this->Form->input('id', array("type"=>"hidden"));
			echo $this->Form->input('category_id',array("div"=>"inline","label"=>"Categoría"));
			echo $this->Form->input('manufacturer_id',array("div"=>"inline","label"=>"Fabricante"));
			echo "<br />";
			echo $this->Form->input('estado',array("div"=>"inline","options"=>array("Activo"=>"Activo","Inactivo"=>"Inactivo")));
			echo $this->Form->input('rotacion',array("div"=>"inline","options"=>array("Alta"=>"Alta","Media"=>"Media","Baja"=>"Baja"),"label"=>"Rotación"));
			echo $this->Form->input('nombre');
			echo $this->Form->input('codigo',array("label"=>"Código","disabled"=>true));
			echo $this->Form->input('codigo',array("type"=>"hidden"));
			echo $this->Form->input('cod_barras');
			echo $this->Form->input('descripcion',array("label"=>"Descripción"));
			echo $this->Form->input('promocionar',array("div"=>"inline check"));
			echo $this->Form->input('destacar',array("div"=>"inline check"));
		?>
 		</div>
<div class="layer">
 		<?php
		
		echo $this->Form->input('inventario',array("disabled"=>true));
		echo $this->Form->input('stock_minimo');
		echo $this->Form->input('stock_maximo');
		echo $this->Form->input('costo');
		echo $this->Form->input('costo_promedio');
		
		?>
 		</div>
 		<div class="layer">
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
 		<div class="layer">
 		<?php
 		//debug($this->data);
 			//------------
 			echo $this->Form->input('ficha_producto', array("type"=>"file", "id"=>"ficha_producto"));
 			
			if(!empty($this->data["Product"]["ficha_producto"])) 
			echo $html->link("Quitar Ficha",array("action"=>"resetFicha",$this->data["Product"]["id"]));
			else
			echo "El producto no tiene ficha";
			
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
 			echo $this->Form->input('imagen_listado', array("type"=>"file", "id"=>"imagen_listado"));
			echo $html->image($this->data['Product']['imagen_listado'],array('width' => "100", 'height' => "100"));

 			echo $this->Form->input('imagen_principal', array("type"=>"file", "id"=>"imagen_principal"));
			echo $html->image($this->data['Product']['imagen_principal'],array('width' => "100", 'height' => "100"));
			
			//------------
			echo $this->Form->input('imagen_destacar', array("type"=>"file","id"=>"imagen_destacar"));			
			if(isset($this->data['Product']['imagen_destacar']) && !empty($this->data['Product']['imagen_destacar']) ) {
				echo $html->image($this->data['Product']['imagen_destacar'],array('width' => "100", 'height' => "100"));
				echo $html->link("Quitar Imagen",array("action"=>"resetDestacar",$this->data["Product"]["id"]));
			}else {
				echo $html->image('imagen-no-disponible.jpg',array('width' => "100", 'height' => "100"));
				
			}	
			
			//___________
			
		/*	//------------		
			echo $this->Form->input('imagen_ficha_tecnica', array("type"=>"file","id"=>"imagen_ficha_tecnica"));			
			if(isset($this->data['Product']['imagen_ficha_tecnica']) && !empty($this->data['Product']['imagen_ficha_tecnica']) ) {
				echo $html->image('imagen-no-disponible.jpg',array('width' => "100", 'height' => "100"));
			}else {
				echo $html->image('imagen-no-disponible.jpg',array('width' => "100", 'height' => "100"));
				//echo "No tiene imagen de ficha técnica";
			}	
			
			//___________	*/	
			echo $this->Form->input('Imagenes.ficha_producto', array("type"=>"hidden", "value"=>$this->data['Product']['ficha_producto']));
 			echo $this->Form->input('Imagenes.imagen_listado', array("type"=>"hidden",  "value"=>$this->data['Product']['imagen_listado']));
 			echo $this->Form->input('Imagenes.imagen_principal', array("type"=>"hidden",  "value"=>$this->data['Product']['imagen_principal']));
			echo $this->Form->input('Imagenes.imagen_destacar', array("type"=>"hidden", "value"=>$this->data['Product']['imagen_destacar']));
			//echo $this->Form->input('Imagenes.imagen_ficha_tecnica', array("type"=>"hidden", "value"=>$this->data['Product']['imagen_ficha_tecnica']));
		?>
 		</div>
   </fieldset>

	<?php echo $this->Form->end();?>
</div>
<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("action"=>"index"))));?>
		<?php //echo $form->button("",array("class"=>"limpiar"));?>
		<?php echo $form->button("",array("class"=>"guardar"));?>
</div>