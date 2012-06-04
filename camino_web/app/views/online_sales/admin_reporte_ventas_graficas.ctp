<div class="onlineSales form">
<?php echo $this->Form->create('OnlineSale');?>
	<fieldset>
		
		<?php
		
		$titulo="Reporte Gráfico de Ventas (%)";
		if(isset($rpt)){
			echo $this->element("form-reportes",array("model"=>"OnlineSale"));
			if($fecha1&&$fecha2){
				echo "desde ".$fecha1." hasta ".$fecha2."\n";
			}
			if($categoria){
				echo $categoria;
			}
		?>
		<?php 
			$procentajes="";
			$nombres="";
			$datos="";
			foreach($rpt as $producto){
				$procentajes.=round($producto["porcenjate"])."%|";
				$datos.=$producto["porcenjate"].",";
				$nombres.=$producto["nombre"]."|";
			}
			$procentajes=substr($procentajes, 0,strlen($procentajes)-1);
			//debug($procentajes);
			$nombres=substr($nombres, 0,strlen($nombres)-1);;
			$datos=substr($datos, 0,strlen($datos)-1);

		?>
			<img src="http://chart.apis.google.com/chart?cht=p3&chco=FFFF10,FF0000&chd=t:<?php echo $datos?>&chs=700x250&chl=<?php echo $procentajes;?>&chdl=<?php echo $nombres?>" />
		<?php //debug($rpt);
		
		?>
		</fieldset>
		
		<div class="botones">
		<?php echo $form->button("",array("class"=>"atras","url"=>$html->url(array("controller"=>"OnlineSales",'action'=>'admin_reporte_ventas_graficas'))));?>
		<?php echo $form->button("",array("class"=>"pdf"));?>

		</div>
		
		<?php
		}
       else {
			?>
	 		<legend><?php __('Reporte Gráfico de Ventas'); ?></legend>
		   <?php
			echo "<h4>Selecciona los parámetros para generar el reporte</h4>";
	        echo "<hr>"; 
			echo $this->Html->div('', null, array('class' => 'grafic_report'));
			echo $this->Form->input('Reporte.fecha_inicial', 
	                            array('label'=>'Fecha inicial', 'empty'=>array("")));
								
		    echo $this->Form->input('Reporte.fecha_final', 
	                            array('label'=>'Fecha final', 'empty'=>array("")));
		
			echo $this->Form->input('Parametros.categoria', 
	                            array('label'=>'Categoría', 'options'=>$categorias, 'empty'=>"Todas"));
			?><div style"clear:both"></div>
			<?php					
			echo $this->Form->input('product_id',array("type"=>"hidden","id"=>"productId"));
			echo $this->Form->input('product_codigo',array("id"=>"product-autocomplete","label"=>"producto"));

			echo "</div>"; 
		/*
			
								
		    echo $this->Form->input('Parametros.producto', 
	                            array('label'=>'Producto', 'options'=>$productos, 'empty'=>array("")));
			*/
								

			
			

		 ?>
	</div>	 
	</fieldset>
<div class="botones">
		<?php echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"reporte"));?>
		<?php //echo $this->Form->button(null, array('label'=>null,'type'=>'button','id'=>"selectAll"));?>
		<?php //echo $this->Form->button(null, array('label'=>null,'id'=>'deselectAll','type'=>'button'));?>
		<?php echo $form->button("",array("class"=>"limpiar"));?>
	</div>
<?php 
} ?>

