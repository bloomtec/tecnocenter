<div class="login">
	<h1> <?php __("Reporte auditorias")?> </h1>

<?php echo $this->Form->create('Audit');?>
	<fieldset>
 	
	<?php
			echo 	"Nombres: ".$pri_nom." ".$seg_ape." ".$pri_ape." ".$seg_ape;
			echo 	"<br>";
			echo 	"Identificación: ".$identificacion;
			echo 	"<br>";
			echo 	"<br>";
			
		echo "<table border='1'>";
			echo "<tr>";
			
				echo 	"<td>Tablas</td>";
				echo 	"<td>Acciones</td>";
				echo 	"<td>Fecha acción</td>";
				echo "</tr>";
			
				for($i=0;$i<=count($reports)-1;$i++)
				{
					echo "<tr>";
					$report=$reports[$i]["Audit"];
					echo"<td>".$report["model"]."</td>";
					echo"<td>".$report["action"]."</td>";
					echo"<td>".$report["created"]."</td>";
					echo "</tr>";
				}
					
		echo "</table>";;
	?>
	</fieldset>
<?php echo $this->Form->end(__('Generar reporte', true));?>
</div>