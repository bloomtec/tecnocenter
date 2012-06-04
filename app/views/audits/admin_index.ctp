<?php
$titulos["Provider"]=" Proveedores";
	$titulos["Product"]=" Productos";
	$titulos["Client"]=" Clientes";
	$titulos["User"]=" Usuarios";
	$titulos["InventoryMovement"]=" Movimientos de Inventario";
	$titulos["byUser"]=" por Usuarios";
	
	$paginas["Provider"]="Provider";
	$paginas["Product"]="Product";
	$paginas["Client"]="Client";
	$paginas["User"]="User";
	$paginas["InventoryMovement"]="InventoryMovement";
	$paginas["byUser"]="byUser";
if(!isset($layout)||$layout!="excel"){
?>
<div class="categories form">
	
	
<?php 
	
	

if(!isset($reporte))
{
	echo $this->Form->create('Audit');?>
	<fieldset>
 		<legend><?php __('Auditoría'.$titulos[$model]); ?></legend>
	<?php
	echo "<div class='layer'>";	
		echo $this->Form->input('fecha_inicial', 
                            array('label'=>'Fecha inicial', 'empty'=>array("")));
							
	echo $this->Form->input('fecha_final', 
                            array('label'=>'Fecha final', 'empty'=>array("")));
	
	
	echo $this->Form->input('modelo',array("type"=>"hidden", "value"=>$model));
		//echo $this->Form->input('order');
		echo "</div>";	
	if($model=="byUser")
	{
		echo "<div class='layer'>";	
		$users=array("Todos"=>"Todos");
		array_push($users,$usuarios);
		echo $this->Form->input('user', 
                            array('label'=>'Usuario','type'=>'select', 'options'=>$users,"size"=>"7"));
		echo "</div>";
	}
	?>
	</div>
	</fieldset>
	<div class="botones">
	<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php echo $form->button("",array("class"=>"limpiar","type"=>"button"));?>
	</div>
   <?php 
}else {

	echo $this->element("form-reportes",array("model"=>"Audit"));
	//debug($reporte);
		echo '<table cellspacing="0" cellpadding="0" class="reporte">';
			echo "<thead><tr>";
				echo 	"<th>Tabla</th>";
				echo 	"<th>Acciones</th>";
				echo 	"<th>Identificación</th>";
				echo 	"<th>Usuario</th>";
				
				echo 	"<th>Fecha acción</th>";
			   echo "</tr></thead><tbody>";
				for($i=0;$i<=count($reporte)-1;$i++)
				{
					echo "<tr>";
					$report=$reporte[$i]["Audit"];
					$report1=$reporte[$i]["User"];
					echo"<td>".$report["model"]."</td>";
					echo"<td>".$report["action"]."</td>";
					echo"<td>".$report["alias"]."</td>";
					echo"<td>".$report1["email"]."</td>";
					
					echo"<td>".$report["created"]."</td>";
					echo "</tr>";
				}
					
		echo "</tbody></table>";
	?>
	</fieldset>
	</div>

	<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"audits",'action'=>'index',$paginas[$model]))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>
		<?php echo $form->button("",array("class"=>"excel"));?>
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
			$this->sheet->setCellValueByColumnAndRow(0,$fila,"Tabla");
			$this->sheet->setCellValueByColumnAndRow(1,$fila,"Acciones");
			$this->sheet->setCellValueByColumnAndRow(2,$fila,"Identificación");
			$this->sheet->setCellValueByColumnAndRow(3,$fila,"Usuario");
			$this->sheet->setCellValueByColumnAndRow(4,$fila,"Fecha acción");

				$columna=0;
				$fila+=1;
				for($i=0; $i<count($reporte); $i++){
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
	
				
					$report=$reporte[$i]["Audit"];
					$report1=$reporte[$i]["User"];
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila,$report["model"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $report["action"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $report["alias"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $report1["email"]);
					 $this->sheet->setCellValueByColumnAndRow($columna++,$fila, $report["created"]);
				
				$columna=0;
				$fila+=1;
			}
				
  		}
?>