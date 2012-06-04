<?php 
		$nuevosTitulos["id"]="ID";
		$nuevosTitulos["codigo_venta"]="Código Venta";
		$nuevosTitulos["id_cuenta"]="ID Cuenta";
		$nuevosTitulos["user_id"]="Usuario";
		$nuevosTitulos["product_id"]="Código Producto";
		$nuevosTitulos["cantidad"]="Cantidad";
		$nuevosTitulos["porcentaje_iva"]="% IVA";
		$nuevosTitulos["valor_unit"]="Valor Unitario";
		$nuevosTitulos["subtotal"]="Subtotal";
		$nuevosTitulos["valor_iva"]="Valor IVA";
		$nuevosTitulos["valor_total"]="Valor Total";
		$nuevosTitulos["created"]="Fecha de Creación";
if(!isset($layout)||$layout!="excel"){
?>
<div class="onlineSales form">

	<fieldset>
		
		<?php 
		//debug($fields);
		
		if(isset($reporte))
		{echo $this->element("form-reportes",array("model"=>"OnlineSale"));
			//debug($reporte);
			echo '<table cellspacing="0" cellpadding="0" class="reporte">';
			echo "<thead><tr>";
				foreach($fields as $valor)
				{

					echo "<td><b>".$nuevosTitulos[$valor]."</b></td>";
				}
		echo "</tr></thead><tbody>";
		
		
			for($i=0; $i<count($reporte); $i++)
			{
				$class="";
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
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"OnlineSales",'action'=>'admin_reporte_ventas'))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>
		<?php echo $form->button("",array("class"=>"excel"));?>
		</div>
		
		<?php
		}
       else {
     		echo $this->Form->create('OnlineSale');
			?>
	 		<legend><?php __('Reporte de ventas por productos y categorías'); ?></legend>
		   <?php
			echo "<h4>Selecciona los parámetros para generar el reporte</h4>";
	        echo "<hr>"; 
			echo $this->Html->div('', null, array('class' => 'grafic_report'));
			echo $this->Form->input('Parametro.fecha_inicial', 
	                            array('label'=>'Fecha inicial', 'empty'=>array("")));
								
		    echo $this->Form->input('Parametro.fecha_final', 
	                            array('label'=>'Fecha final', 'empty'=>array("")));
		
		
			echo $this->Form->input('Parametro.categoria', 
                            array('label'=>'Categoría', 'type'=>"select", "options"=>$categorias, 'empty'=>"Todas"));
		
		?><div style"clear:both"></div>
			<?php					
		echo $this->Form->input('Parametro.producto',array("type"=>"hidden","id"=>"productId"));
			echo $this->Form->input('product_codigo',array("id"=>"product-autocomplete","label"=>"producto"));
							
		echo "</div>"; 					
		echo "<hr>";   
	 	echo "<br>"; 
	 	echo "<h4>Campos a mostrar en el reporte</h4>";
		echo $html->div('products_options');
		echo $this->Form->input('Reporte.id',array('value'=>1,'type'=>'hidden'));	
	 	echo $this->Form->input('Reporte.codigo_venta',array('value'=>1,'type'=>'hidden'));								
		echo $this->Form->input('Reporte.id_cuenta',array('label'=>'Cuenta','type'=>'checkbox'));
		echo $this->Form->input('Reporte.user_id', array('label'=>'Usuario','type'=>'checkbox'));
		echo $this->Form->input('Reporte.product_id', array('label'=>'Producto','type'=>'checkbox'));
		echo $this->Form->input('Reporte.cantidad', array('label'=>'Cantidad','type'=>'checkbox'));
		echo $this->Form->input('Reporte.porcentaje_iva', array('label'=>'Porcentaje IVA','type'=>'checkbox'));
		echo $this->Form->input('Reporte.valor_unit', array('label'=>'Valor unitario','type'=>'checkbox'));
		echo $this->Form->input('Reporte.subtotal', array('label'=>'SubTotal','type'=>'checkbox'));
		echo $this->Form->input('Reporte.valor_iva', array('label'=>'Valor IVA','type'=>'checkbox'));
		echo $this->Form->input('Reporte.valor_total', array('label'=>'Valor Total','type'=>'checkbox'));
		echo $this->Form->input('Reporte.created', array('label'=>'Fecha','type'=>'checkbox'));
	
		 
?>
	</fieldset>
	</div>
	<div class="botones">
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"selectAll"));?>
		<?php //echo $this->Form->button(null, array('label'=>null,'id'=>'deselectAll','type'=>'button'));?>
		<?php echo $form->button("",array("class"=>"limpiar","type"=>"buttom"));?>
	</div>
		
<?php
} 					      
     	
?>
<?php }else{//EXCEL
  			App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
			App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));
	        $this->xls = new PHPExcel();
	        $this->sheet = $this->xls->getActiveSheet();
	        $this->sheet->getDefaultStyle()->getFont()->setName('Verdana');
	 		$this->sheet->setCellValue('A2', $titulo);
	        $this->sheet->getStyle('A2')->getFont()->setSize(14);
	        $this->sheet->getRowDimension('2')->setRowHeight(23);
  			$fila=3;
			$columna=0;
	
				foreach($fields as $valor){
					$this->sheet->setCellValueByColumnAndRow($columna++,$fila, $nuevosTitulos[$valor]);
				}
				$columna=0;
				$fila+=1;
				for($i=0; $i<count($reporte); $i++){
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
	
				foreach($reporte[$i] as $indice =>$valor)
				{
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $valor);
				}
				$columna=0;
				$fila+=1;
			}
				
  		}
?>