<?php
if(!isset($layout)||$layout!="excel"){
?>
<div class="onlineSales form">
	<fieldset>	
		<?php
		if(isset($reporte)){$model="InventoryMovement";echo $this->element("form-reportes",array("model"=>"InventoryMovement"));
			if(isset($movimiento) && $movimiento!=""){
				if($movimiento=="E"){
					echo "<b>Tipo de movimiento: Entrada</b>";
				}else {
					echo "<b>Tipo de movimiento: Salida</b>";
				}
				echo "<br/>";
				echo "<br/>";
			}
			
			echo '<table cellspacing="0" cellpadding="0" class="reporte2">';
			echo "<thead class='header-table'><tr>";
			?>
			 	<th>ID</th>
			 	<th>ID Invent</th>
			 	<th>Tipo Doc</th>
			 	<th>Proveedor</th>
			 	<th>Num Doc</th>
			 	<th>Cod Prod</th>
			 	<th>Nom Prod</th>
			 	<th>Cantidad</th>
			 	<th>Detalle</th>
			 	<th>Fecha</th>
			 	
			<?php
			echo "</tr></thead>";
		
		    echo "<tbody class='body-table'>";
			for($i=0; $i<count($reporte); $i++)
			{
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr $class >";
				?>
				<td><?php echo $reporte[$i]["InventoryMovement"]["id"]?>&nbsp;</td>
			 	<td><?php echo $reporte[$i]["Inventory"]["id"]?>&nbsp;</td>
			 	<td><?php echo $documentos[$reporte[$i]["InventoryMovement"]["tipo_documento_id"]]?>&nbsp;</td>
			 	<td><?php echo $providers[$reporte[$i]["Inventory"]["provider_id"]]?>&nbsp;</td>
			 	
			 	<td><?php echo $reporte[$i]["InventoryMovement"]["numero_documento"]?>&nbsp;</td>
			 	<td><?php echo $productosByCodigo[$reporte[$i]["Inventory"]["product_id"]]; ?>&nbsp;</td>
			 	<td><?php echo $productosByNombre[$reporte[$i]["Inventory"]["product_id"]];?>&nbsp;</td>
			 	<td><?php echo $reporte[$i]["InventoryMovement"]["cantidad"]?>&nbsp;</td>
			 	<td><?php echo $reporte[$i]["InventoryMovement"]["detalle"]?>&nbsp;</td>
			 	<td><?php echo $reporte[$i]["InventoryMovement"]["created"]?>&nbsp;</td>
			 
				<?php
				echo "</tr>";
			}
			
		echo "</tbody></table>";
		?>
		</fieldset>
		</div>
		<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"InventoryMovements",'action'=>'admin_reporte_inventario'))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>
		<?php echo $form->button("",array("class"=>"excel"));?>
		</div>
		
		<?php
		}
       else {
			?>
			<?php echo $this->Form->create('InventoryMovement', array("controller"=>"InventoryMovements", "action"=>"admin_reporte_inventario"));?>
	 		<legend><?php __('Reporte de inventarios'); ?></legend>
		   <?php
			echo "<h4>Selecciona los parámetros para generar el reporte</h4>";
	        echo "<hr>"; 
			echo $this->Html->div('', null, array('class' => 'grafic_report'));
			echo $this->Form->input('Reporte.fecha_inicial', 
	                            array('label'=>'Fecha inicial', 'empty'=>array("")));
								
		    echo $this->Form->input('Reporte.fecha_final', 
	                            array('label'=>'Fecha final', 'empty'=>array("")));
								
			echo $this->Form->input('Reporte.documento', 
	                            array('label'=>'Tipo Documento',"options"=>$documentos, 'empty'=>"Todos"));
			?><div style"clear:both"></div>
			<?php					
		    echo $this->Form->input('Reporte.movimiento', 
	                            array('label'=>'Movimiento',"options"=>array("E"=>"Entrada", "S"=>"Salida"), 'empty'=>"Todos"));
								
		    echo "</div>"; 	
		/*
		echo "<hr>";   
	 	echo "<br>"; 
	 	echo "<h4>Campos a mostrar en el reporte</h4>";
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
	
		 * 
		 */
?>
	</fieldset>
	</div>
	<div class="botones">
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
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
			$this->sheet->setCellValueByColumnAndRow(0,$fila,"ID");
			$this->sheet->setCellValueByColumnAndRow(1,$fila,"ID Invent");
			$this->sheet->setCellValueByColumnAndRow(2,$fila,"Tipo Doc");
			$this->sheet->setCellValueByColumnAndRow(3,$fila,"Proveedor");
			$this->sheet->setCellValueByColumnAndRow(4,$fila,"Num Doc");
			$this->sheet->setCellValueByColumnAndRow(5,$fila,"Cod Prod");
			$this->sheet->setCellValueByColumnAndRow(6,$fila,"Nom Prod");
			$this->sheet->setCellValueByColumnAndRow(7,$fila,"Cantidad");
			$this->sheet->setCellValueByColumnAndRow(8,$fila,"Detalle");
			$this->sheet->setCellValueByColumnAndRow(9,$fila,"Fecha");

				$columna=0;
				$fila+=1;
				for($i=0; $i<count($reporte); $i++){
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
	
			
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["InventoryMovement"]["id"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["Inventory"]["id"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $documentos[$reporte[$i]["InventoryMovement"]["tipo_documento_id"]]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $providers[$reporte[$i]["Inventory"]["provider_id"]]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["InventoryMovement"]["numero_documento"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $productosByCodigo[$reporte[$i]["Inventory"]["product_id"]]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $productosByNombre[$reporte[$i]["Inventory"]["product_id"]]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["InventoryMovement"]["cantidad"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["InventoryMovement"]["detalle"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $reporte[$i]["InventoryMovement"]["created"]);
			
				$columna=0;
				$fila+=1;
			}
				
  		}
?>