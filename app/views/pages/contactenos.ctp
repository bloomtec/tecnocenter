<div class="contacto form altofijo" id="UserRegisterForm">
<?php if(!isset($mensaje)): ?>
<!-- <h2>Contactanos</h2> -->
<p>
	Para Tecnocenter & Servicios es un placer atenderlo!. Por favor documente el formulario con sus datos de contacto, inquietudes ó solicitud específica de cotización. Nosotros le estaremos dando respuesta a la mayor brevedad posible. Recuerde que los campos marcados con asterisco (*) son necesarios para poder dar respuesta a su requerimiento.
</p>
<?php echo $this->Form->create('Page', array('action'=>'contactenos',"novalidate"=>"novalidate"));?>
  <fieldset>
 
	<?php 
	echo $this->Form->input('nombre', array('label'=>'Nombre',"div"=>"required input","required"=>"required"));  
	?>
	<div class="input text required">
		<label for="UserEmail">Correo eléctronico</label>
		<input name="data[Page][email]" type="email" required="required" maxlength="50" id="Correos eléctronicos" class="">
	</div>
	
  <?php
    //echo $this->Form->input('empleado_id',array('options'=>$usuarios));

$onlyLetters="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]";
 		$mensajeOnlyLetters="sólo letras y espacios";
	
	echo $this->Form->input('empresa', array('label'=>'Empresa')); 
	echo $this->Form->input('ciudad', array('label'=>'Ciudad',"div"=>"required input","required"=>"required","sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
    echo $this->Form->input('pais', array('label'=>'Pais',"sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('telefono', array('label'=>'Teléfono',"div"=>"required input","required"=>"required","type"=>"number"));   
   	echo $this->Form->input('celular', array('label'=>'Celular',"type"=>"number"));   
	echo "<div class='input'>";
		echo $this->Form->label("Comentarios");
	echo "<div style='clear:both'></div>";
    echo "</div>"; 
	echo $this->Form->textarea('comentarios', array('label'=>'Comentarios'));   
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Enviar', true));?>

<div style="clear:both"> </div>
<p class="datos-cotnacto">
Contacto: Diego Fernando Joaqui Tel. 3736199 – Cel. 311-6363913 Cali – Colombia
</p>
<?php endif; ?>
<?php if(isset($mensaje)):?>
<p class="confirmacion">
Gracias por contactarnos, en breve nos comunicaremos con usted.
</p>
<?php endif;?>
</div>
<script type="text/javascript">

</script>