<?php if(!isset($layout)||$layout!="excel"){?>
<div class="users form">
<?php echo $this->element("form-reportes",array("model"=>"User"));?>
  <fieldset>
    <legend><?php if(!isset($titulo))  __('Reportes de usuarios'); ?><br /></legend>

<?php

  if(isset($reporte)){
  
  		
  			$divisora=(1358)/(count($titulos)+1);
			echo '<table class="reporte" cellspacing="0" cellpadding="0">';
			echo "<thead><tr>";
				$array=$titulos;
				$i = 0;
				foreach($array as $valor)
				{
					echo "<th style='width:".($divisora)."px'><b>".$valor."</b></th>";
				}
			echo "</tr></thead>";
			echo "<tbody>";
			
			for($i=0; $i<count($reporte); $i++)
			{
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr $class >";
				foreach($reporte[$i] as $indice =>$valor)
				{
						
					echo "<td style='width:".($divisora)."px'>".$valor."</td>";
				}
				echo "</tr>";
			}
			
		echo "</tbody>";
		
		
		
		echo "</table>";

		
	}
?>
</div>
<div class="botones">
	<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"users","action"=>"admin_selectReport"))));?>
	<?php echo $form->button("",array("class"=>"pdf"));?>
	<?php echo $form->button("",array("class"=>"excel"));?>
</div>
<?php }else{
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
			$array=$titulos;
				foreach($array as $valor){
					$this->sheet->setCellValueByColumnAndRow($columna++,$fila, $valor);
				}
			$fila=4;
			$columna=0;
			for($i=0; $i<count($reporte); $i++){
				$class="";
				if ($i % 2 == 0) {
					$class = ' class="altrow"'; //ESto pro si algun dia se le pone color
				}

				foreach($reporte[$i] as $indice =>$valor){						
					$this->sheet->setCellValueByColumnAndRow($columna++,$fila, $valor);
					
				}
			$columna=0;
			$fila+=1;
			}
  		}
?>