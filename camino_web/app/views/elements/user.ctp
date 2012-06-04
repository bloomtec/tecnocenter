<?php //$id=$session->read("Auth.User.id")?>
<?php //$productos = $this->requestAction("/products/getProductosComprados/"+$id);?>
<div class="content_wrap">
<?php echo $this->Session->flash(); ?>
	<div id="user_showcase">
		<h1>Mi Cuenta <span><?php echo $html->link("Modificar datos",array("action"=>"modificarDatos"));?></span><span><?php echo $html->link("cambiar contraseña",array("action"=>"cambiarContrasena"));?></span></h1>
		<span class="separador_horizontal"></span>
		<div class="user_details">
			<div class="user_photo">
				<?php echo $this->Html->image($user['User']['foto']); ?>
			</div>
			<div class="user_editable">
				<h2><?php echo $user['User']['primer_nombre']." ".$user['User']['segundo_nombre']." ".$user['User']['primer_apellido']." ".$user['User']['segundo_apellido']; ?></h2>
				<br />
				<p><span>email: </span><?php echo $user['User']['email']; ?></p>
				<p><span>dirección: </span><?php echo $user['User']['direccion']; ?></p>
				<p><span>ciudad: </span><?php echo $user['User']['ciudad']; ?></p>
			</div>
			<div style="clear:left"></div>
			<div class="user_editable">
				<p><span>Tipo Identificacion: </span><?php echo $user['User']['tipo_identificacion']; ?></p>
				<p><span>Número Identificación: </span><?php echo $user['User']['numero_identificacion']; ?></p>
				<p><span>Dirección: </span><?php echo $user['User']['direccion']; ?></p>
				<p><span>Primer Nombre: </span><?php echo $user['User']['primer_nombre']; ?></p>
				<p><span>Segundo Nombre: </span><?php echo $user['User']['segundo_nombre']; ?></p>
				<p><span>Primer Apellido: </span><?php echo $user['User']['primer_apellido']; ?></p>
				<p><span>Segundo Apellido: </span><?php echo $user['User']['segundo_apellido']; ?></p>
				<p><span>Celular: </span><?php echo $user['User']['celular']; ?></p>
				<p><span>Teléfono: </span><?php echo $user['User']['telefono']; ?></p>
				<p><span>Teléfono Adicional: </span><?php echo $user['User']['telefono_adicional']; ?></p>
				<p><span>País: </span><?php echo $user['User']['pais']; ?></p>
			</div>
		</div>
		<div style="clear:both"></div>	
	</div>
	<span class="detail_tittle">Mis productos comprados</span>
	<div class="detail-user-shop">
		<div class="view-shop-history">
		<?php if(isset($onlineSales)):?>
			<table cellpadding="0" cellspacing="0">
				<tr>
						<th>Producto</th>

						<th>Precio</th>
						<th>Cantidad</th>
						<th>Fecha</th>
				</tr>
				<?php 
					foreach($onlineSales as $venta): 
				?>
				<tr>
					<td> <?php echo $html->link($venta["Product"]["nombre"],array("controller"=>"products","action"=>"view",$venta["Product"]["id"])); ?></td>
					<td> <?php echo "$".number_format($venta["Product"]["valor_venta"], 0, ' ', '.');?></td>
					<td> <?php echo $venta["OnlineSale"]["cantidad"]; ?> </td>
					<td> <?php echo $venta["OnlineSale"]["created"]; ?> </td>
				</tr>		
		<?php endforeach;?>
			</table>
		<?php endif; ?>
		</div>
	</div>
	
</div>

