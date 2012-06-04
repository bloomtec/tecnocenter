<div class="onlineSales form">
<?php echo $this->Form->create('OnlineSale');?>
	<fieldset>
		
		<?php
		if(isset($rpt))
		{
			debug($rpt);
			/*
			echo "<table border='1'>";
			echo "<tr>";
				foreach($titulos as $valor)
				{
					echo "<td><b>".$valor."</b></td>";
				}
			echo "</tr>";
		
		
			for($i=0; $i<count($reporte); $i++)
			{
				echo "<tr>";
				foreach($reporte[$i] as $indice =>$valor)
				{
					echo "<td>".$valor."</td>";
				}
				echo "</tr>";
			}
			
		echo "</table>";
		*/
		
		echo $this->Html->link(__('Regresar', true), array("controller"=>"OnlineSales", 'action' => 'admin_reporte_ventas_categorias'));
		
		}
       else 
       {
		?>
 		<legend><?php __('Reporte de ventas por categoría'); ?></legend>
	   <?php
		echo "<h4>Seleciona la categoria</h4>";
        echo "<hr>"; 
		
		echo $this->Form->input('Parametro.categoria', 
                            array('label'=>'Categoría', 'type'=>"select", "options"=>$categorias, 'empty'=>array("")));
		
						
		echo $this->Form->input('Parametro.producto', 
                            array('label'=>'Producto',  'type'=>"select", "options"=>$productos, 'empty'=>array(""),
							));

							
		echo $this->Form->input('Parametro.fecha_inicial', 
                            array('label'=>'Fecha inicial', 'empty'=>array("")));
							
	    echo $this->Form->input('Parametro.fecha_final', 
                            array('label'=>'Fecha final', 'empty'=>array("")));
		
		
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
	
		 ?>
	</fieldset>
<?php echo $this->Form->end(__('Generar reporte', true));
} ?>




