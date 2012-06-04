<div class="register form registrado altofijo">
<h2>¡No estoy Registrado!</h2>
<p>
	Regístrate ya en tecnocenter.com.co es muy fácil y te da muchos beneficios como: Acceso al Chat On-Line para que despejes tus dudas con un asesor, productos en promoción y compras On-Line sin moverte de tu casa u oficina.
</p>
<?php echo $this->Form->create('User',array("novalidate"=>"novalidate"));?>
  <fieldset>
    <legend><?php __('Todos los campos son obligatorios'); ?></legend>
	<div class="input text required">
		<label for="UserEmail">Correo eléctronico</label>
		<input name="data[User][email]" type="email" required="required" maxlength="50" id="Correos eléctronicos" class="">
	</div>
	<div class="required input">
		<label for="UserEmail2">Confirmar correo eléctronico</label>
		<input name="data[User][email2]" type="email" required="required" data-equals="Correos eléctronicos" id="UserEmail2" data-message="Por favor verifique este campo">
	</div>
  <?php
    //echo $this->Form->input('empleado_id',array('options'=>$usuarios));


	echo $this->Form->input('password', array('label'=>'Contraseña',"required"=>"required","id"=>"Contraseñas"));  
	echo $this->Form->input('password2', array('label'=>'Confirmar contraseña',"div"=>"required input","required"=>"required","data-equals"=>"Contraseñas","type"=>"password","data-message"=>"Por favor verifique este campo"));    
	echo $this->Form->input('direccion', array('label'=>'Dirección',"div"=>"required input","required"=>"required")); 
	echo $this->Form->input('ciudad', array('label'=>'Ciudad',"div"=>"required input","required"=>"required","sololetras"=>"/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/","title"=>"sólo letras y espacios"));   
    echo $this->Form->input('pais', array('label'=>'Pais',"div"=>"required input","required"=>"required","sololetras"=>"/[A-Za-zñÑáéíóúÁÉÍÓÚ\s]/","title"=>"sólo letras y espacios"));
       
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Crear Cuenta', true));?>
<div style="clear:both"> </div>
	<h2>¿Por qué debo registrarme? </h2>
	<p>
		Al ser usuario registrado en tecnocenter.com.co tendrás beneficios como el Chat On-Line para poder consultarle a un asesor sobre algún producto de tu interés, hacer un pedido de algún producto en especial, realizar compras On-Line de forma segura, Ingresar al historial de sus compras y tener acceso a nuestros servicios adicionales.
		Tu cuenta tecnocenter.com.co es gratuita, privada y segura, la información para pagos solo será solicitada en el momento que realices una compra y esta se realiza mediante la plataforma de pagosonline.com.co
	</p>
</div>
<script type="text/javascript">
$(function(){
var send=false;
	$("#UserRegisterForm").validator({lang: 'es'}).submit(function(e){
		var form = $(this);	
			// submit with AJAX
			$.getJSON(server+"users/checkEmail?" + form.serialize(), function(json) {
				// everything is ok. (server returned true)
				if (json === true)  {
					//form.load(form.attr("action"));
					
				if(form.data("validator").checkValidity()) $("form").unbind('submit').submit();	
				// server-side validation failed. use invalidate() to show errors
				} else {
					form.data("validator").invalidate(json);
				}
			});
	
			// prevent default form submission logic
			e.preventDefault();

	});
});
</script>