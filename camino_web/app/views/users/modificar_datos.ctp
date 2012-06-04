<div id="UserRegisterForm" class="register form" style="height:1230px">
<h2>Modificar Datos</h2>

<?php echo $this->Form->create('User', array('action'=>'modificarDatos',"novalidate"=>"novalidate"));?>
  <fieldset>
    <legend><?php __('Los campos marcados con (*) son obligatorios'); ?></legend>
	
  <?php
    //echo $this->Form->input('empleado_id',array('options'=>$usuarios));

/*
	echo $this->Form->input('direccion', array('label'=>'Dirección',"div"=>"required input","required"=>"required")); 
	echo $this->Form->input('ciudad', array('label'=>'Ciudad',"div"=>"required input","required"=>"required"));   
    echo $this->Form->input('pais', array('label'=>'Pais',"div"=>"required input","required"=>"required"));     
 */  $onlyLetters="/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/";
 		$mensajeOnlyLetters="sólo letras y espacios";
    echo $this->Form->input('tipo_identificacion',array("label"=>"Tipo Identificación","options"=>$tiposIdentificacion));
	echo $this->Form->input('numero_identificacion',array("type"=>"number","label"=>"Número Identificación","div"=>"required input","required"=>"required"));
	echo $this->Form->input('direccion', array('label'=>'Dirección',"div"=>"required input","required"=>"required")); 
	echo $this->Form->input('primer_nombre',array("required"=>"required","sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('segundo_nombre',array("sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('primer_apellido',array("required"=>"required","sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('segundo_apellido',array("sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('telefono',array("type"=>"number","label"=>"Teléfono","required"=>"required"));
	echo $this->Form->input('celular',array("required"=>"required","type"=>"number"));
	echo $this->Form->input('telefono_adicional',array("label"=>"Teléfono Adicional","type"=>"number"));
	echo $this->Form->input('pais', array('label'=>'Pais',"div"=>"required input","required"=>"required","sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('departamento',array("sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
	echo $this->Form->input('ciudad', array('label'=>'Ciudad',"div"=>"required input","required"=>"required","sololetras"=>$onlyLetters,"title"=>$mensajeOnlyLetters));
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
<div style="clear:both"></div>
</div>
<script type="text/javascript">
$(function(){
	$("#UserModificarDatosForm").validator({lang: 'es'});
});
</script>