<?php 
  $nuevosTitulos["category_id"]="Categoría";
   $nuevosTitulos["manufacturer_id"]="Fabricante";
    $nuevosTitulos["codigo"]="Código";
	 $nuevosTitulos["nombre"]="Nombre";
	  $nuevosTitulos["descripcion"]="Descripción";
	   $nuevosTitulos["cod_barras"]="Cod. Barras";
	    $nuevosTitulos["inventario"]="Inventario";
		 $nuevosTitulos["stock_minimo"]="Stock Mínimo";
		  $nuevosTitulos["stock_maximo"]="Stock Máximo";
		   $nuevosTitulos["costo"]="Costo";
		    $nuevosTitulos["costo_promedio"]="Costo Promedio";
			 $nuevosTitulos["tarifa_iva"]="Tarifa IVA";
			  $nuevosTitulos["valor_iva"]="Valor IVA";
			   $nuevosTitulos["porc_utilidad"]="% Utilidad";
			    $nuevosTitulos["valor_venta"]="Valor Venta";
				 $nuevosTitulos["estado"]="Estado";
				 $nuevosTitulos["rotacion"]="Rotación";
				 $nuevosTitulos["tiempo_reposicion"]="Tiempo de Reposición";
				 $nuevosTitulos["created"]="Fecha de Creación";
if(!isset($layout)||$layout!="excel"){?>
<div class="users form">
<?php echo $this->Form->create('Product');?>
  <fieldset>
    <legend><?php if(!isset($titulo)) __('Reportes de productos'); ?></legend>
  <?php

  if(isset($rpt))
  	{//debug($fields);
  	 echo $this->element("form-reportes",array("model"=>"Product"));
  		$reporte = $rpt;
  		
		echo '<table cellspacing="0" cellpadding="0" class="reporte">';
			echo "<thead><tr>";
				foreach($fields as $valor)
				{
					echo "<th><b>".$nuevosTitulos[$valor]."</b></th>";
				}
			echo "</tr></thead><tbody>";
		
		
			for($i=0; $i<count($reporte); $i++)
			{
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr $class>";
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
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"OnlineSales",'action'=>'admin_reporte_ventas_graficas'))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>
		<?php echo $form->button("",array("class"=>"excel"));?>
		</div>
		
		<?php
	} 
  else 
	{
	
	echo "<h4>Selecciona los parámetros para generar el reporte</h4>";
    echo "<hr>"; 
    echo $this->Html->div('', null, array('class' => 'products_parameters'));
    echo $this->Form->input('Reporte.categoria', 
                            array('label'=>'Selecciona una categoria', 
                            'type'=>'select','empty'=>'Todas','options'=>$categorias,"id"=>"Lacategoria"));
	
	echo "<div style='clear:both'></div>";
												
	echo $this->Form->input('Reporte.estado', 
                            array('label'=>'Selecciona un estado', 'type'=>'select',
                            'empty'=>'Todos','options'=>array('activo'=>'Activo','Inactivo'=>'Inactivo')));
	
	echo "<div style='clear:both'></div>";
	
	echo $this->Form->input('Reporte.rotacion', 
                            array('label'=>'Selecciona la rotación', 'type'=>'select',
                            'empty'=>'Todas','options'=>array('Alta'=>'Alta','Media'=>'Media','Baja'=>'Baja')));
	
	echo "<div style='clear:both'></div>";
																
	echo $this->Form->input('Reporte.fecha_inicial', 
                            array('label'=>'Fecha inicial', 'empty'=>array("")));		
                            
	echo $this->Form->input('Reporte.fecha_final', 
                            array('label'=>'Fecha final', 'empty'=>array("")));	
	 echo "</div>"; 					
	 echo "<hr>";   
	 echo "<br>"; 
	 echo "<h4>Campos a mostrar en el reporte</h4>";
	    echo $html->div('products_options');
	    echo $this->Form->input('category_id', array('label'=>'Categoría','type'=>'checkbox'));
		echo $this->Form->input('manufacturer_id', array('label'=>'Fabricante','type'=>'checkbox') );
		echo $this->Form->input('codigo', array('label'=>'Código','type'=>'checkbox'));
		echo $this->Form->input('nombre', array('label'=>'Nombre','type'=>'checkbox'));
		echo $this->Form->input('descripcion', array('label'=>'Descripción','type'=>'checkbox'));
		echo $this->Form->input('cod_barras', array('label'=>'Código de barras','type'=>'checkbox'));
		//echo $this->Form->input('ficha_producto', array('label'=>'Ficha del producto','type'=>'checkbox'));
		
		echo $this->Form->input('inventario', array('label'=>'Inventario','type'=>'checkbox'));
		echo $this->Form->input('stock_minimo', array('label'=>'Stock mínimo','type'=>'checkbox'));
		echo $this->Form->input('stock_maximo', array('label'=>'Stock máximo','type'=>'checkbox'));
		echo $this->Form->input('costo', array('label'=>'Costo','type'=>'checkbox'));
		echo $this->Form->input('costo_promedio', array('label'=>'Costo promedio','type'=>'checkbox'));
		echo $this->Form->input('tarifa_iva', array('label'=>'Tipo IVA','type'=>'checkbox'));
		echo $this->Form->input('valor_iva', array('label'=>'Valor IVA','type'=>'checkbox'));
		echo $this->Form->input('porc_utilidad', array('label'=>'Utilidad','type'=>'checkbox'));
		echo $this->Form->input('valor_venta', array('label'=>'Valor venta','type'=>'checkbox'));
		echo $this->Form->input('estado', array('label'=>'Estado','type'=>'checkbox'));
		echo $this->Form->input('rotacion', array('label'=>'Rotación','type'=>'checkbox'));
		//echo $this->Form->input('nit_proveedor', array('label'=>'Nit proveedor','type'=>'checkbox'));
		echo $this->Form->input('tiempo_reposicion', array('label'=>'Tiempo de reposición','type'=>'checkbox'));
		echo $this->Form->input('created', array('label'=>'Fecha','type'=>'checkbox'));
		 
?>
	</fieldset>
	</div>
	<div class="botones">
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"selectAll"));?>
		<?php //echo $this->Form->button(null, array('label'=>null,'id'=>'deselectAll','type'=>'button'));?>
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
			$reporte = $rpt;

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
					foreach($reporte[$i] as $indice =>$valor){
						$this->sheet->setCellValueByColumnAndRow($columna++,$fila, $valor);
					}
				$columna=0;
				$fila+=1;
				}
  		}
?>