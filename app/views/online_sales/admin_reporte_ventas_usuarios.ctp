<div class="onlineSales form">
<?php echo $this->Form->create('OnlineSale');?>
	<fieldset>
		
		<?php
		
		
		$nuevosTitulos["id_cuenta"]="ID Cuenta";
		$nuevosTitulos["user_id"]="Usuario";
		$nuevosTitulos["category_id"]="Categoría";
		$nuevosTitulos["product_id"]="Código de Producto";
		$nuevosTitulos["cantidad"]="Cantidad";
		$nuevosTitulos["porcentaje_iva"]="% IVA";
		$nuevosTitulos["valor_unit"]="Valor Unitario";
		$nuevosTitulos["subtotal"]="Subtotal";
		$nuevosTitulos["valor_iva"]="Valor IVA";
		$nuevosTitulos["valor_total"]="Valor Total";
		$nuevosTitulos["created"]="Fecha de creación";
		if(isset($reporte))
		{
			//debug($reporte);
			echo '<table cellspacing="0" cellpadding="0" class="reporte">';
			echo "<thead><tr>";
					foreach($campos as $valor)
					{
						echo "<th>".$nuevosTitulos[$valor]."</th>";
					}
			echo "</tr></thead><tbody>";
			
			
				for($i=0; $i<count($reporte); $i++)
				{
					if ($i % 2 == 0) {
					$class = ' class="altrow"';
					}
					echo "<tr $class >";
					foreach($reporte[$i] as $indice =>$valor)
					{
						echo "<td>".$valor."</td>";
					}
					echo "</tr>";
				}
				
			echo "</tbody></table>";
			?>
		</fieldset>
		</div>
		<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"OnlineSales",'action'=>'admin_reporte_ventas_usuarios'))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>
		<?php echo $form->button("",array("class"=>"excel"));?>
		</div>
		
		<?php
		}
       else {
			?>
	 		<legend><?php __('Reporte de ventas por clientes'); ?></legend>
		   <?php
			echo "<h4>Selecciona los parámetros para generar el reporte</h4>";
	        echo "<hr>"; 
			echo $this->Html->div('', null, array('class' => 'grafic_report'));
			echo $this->Form->input('Reporte.fecha_inicial', 
	                            array('label'=>'Fecha inicial', 'empty'=>array("")));
								
		    echo $this->Form->input('Reporte.fecha_final', 
	                            array('label'=>'Fecha final', 'empty'=>array("")));
		
			echo $this->Form->input('Reporte.email', 
	                            array('label'=>'Email'));

			echo "</div>"; 	
			echo "<hr>";   
		 	echo "<br>"; 
		 	echo "<h4>Campos a mostrar en el reporte</h4>";
		 	echo "<br>";
		 	echo $html->div('products_options'); 
		 	echo $this->Form->input('Campos.codigo_venta',array('type'=>'hidden'));								
			echo $this->Form->input('Campos.user_id', array('label'=>'Usuario','type'=>'checkbox'));
			echo $this->Form->input('Campos.category_id', array('label'=>'Categoría','type'=>'checkbox'));
			echo $this->Form->input('Campos.product_id', array('label'=>'Producto','type'=>'checkbox'));
			echo $this->Form->input('Campos.cantidad', array('label'=>'Cantidad','type'=>'checkbox'));
			echo $this->Form->input('Campos.porcentaje_iva', array('label'=>'Porcentaje IVA','type'=>'checkbox'));
			echo $this->Form->input('Campos.valor_unit', array('label'=>'Valor unitario','type'=>'checkbox'));
			echo $this->Form->input('Campos.subtotal', array('label'=>'SubTotal','type'=>'checkbox'));
			echo $this->Form->input('Campos.valor_iva', array('label'=>'Valor IVA','type'=>'checkbox'));
			echo $this->Form->input('Campos.valor_total', array('label'=>'Valor Total','type'=>'checkbox'));
			echo $this->Form->input('Campos.created', array('label'=>'Fecha','type'=>'checkbox'));
		
?>
	
	</fieldset>
	</div>
	<div class="botones">
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"selectAll"));?>
		<?php //echo $this->Form->button(null, array('label'=>null,'id'=>'deselectAll','type'=>'button'));?>
		<?php echo $form->button(null,array("class"=>"limpiar",'type'=>'button'));?>
	</div>
		
<?php
} 					      
     	
?>