<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __("CMS:"); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		//echo $this->Html->css('uploadify');
		echo $this->Html->css('superfish');
		echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js");
		echo $this->Html->script("admin.js");
		echo $this->Html->script("jquery-ui.js");
		echo $this->Html->script("swfobject.js");
		echo $this->Html->script("jquery.uploadify.v2.1.4.min.js");
		echo $this->Html->script("upload.js");
		echo $this->Html->script("superfish.js");
		echo $this->Html->script("ckeditor/ckeditor");
		echo $this->Html->script("jquery.dataTables.min.js");
		//NO BORRAR DE NUEVO ESTE SCRIPT y CSS, ES PARA LAS FECHAS DEL REPORTE
		echo $this->Html->script("dates.js");
		


		echo $this->Html->css("jquery-ui.css");
			echo $this->Html->script("dates.js");
		echo $scripts_for_layout;
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body <?php if(isset($login)) echo "id='login'"; ?> >
	<div id="container">
		<div id="header">
			<div class="logo">
				<?php echo $this->Html->link(
					$this->Html->image('logo_cms.png', array('alt'=> __('CMS: Tecnocenter', true), 'border' => '0')),
					array("controller"=>"users","action"=>"menu"),
					array('escape' => false)
				);
			?>
			
			</div>
			<?php if(!isset($login)): ?> 
				<div class="user">
					<strong>Usuario: </strong><?php echo $session->read("Auth.User.email");?> 
					<br />
					<strong>Role: </strong>  <?php echo $rolesLogin[$session->read("Auth.User.role_id")];?> 
				</div>
			<?php endif;?>  
			
			<?php if(!isset($login)): ?> 
				
			<ul class="nav">
				<?php if(isset($actualiza)): ?> 
				<li>
					<?php echo $html->link("Actualiza",array("#")); ?>
					<ul>
						<li>
							<?php echo $html->link("Usuarios",array("controller"=>"users","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nuevo usuario",array("controller"=>"users","action"=>"add")); ?></li>
							</ul>
						</li>
						<li>
							<?php echo $html->link("Categorías",array("controller"=>"categories","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nueva categoría",array("controller"=>"categories","action"=>"add")); ?></li>
							</ul>
						</li>
						<li>
							<?php echo $html->link("Productos",array("controller"=>"products","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nuevo producto",array("controller"=>"products","action"=>"add")); ?></li>
							</ul>
						</li>
						<li>
							<?php echo $html->link("Fabricantes",array("controller"=>"manufacturers","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nuevo Fabricante",array("controller"=>"manufacturers","action"=>"add")); ?></li>
							</ul>
						</li>
						<li>
							<?php echo $html->link("Proveedores",array("controller"=>"providers","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nuevo Proveedor",array("controller"=>"providers","action"=>"add")); ?></li>
							</ul>
						</li>
						<li>
							<?php echo $html->link("Servicios",array("controller"=>"services","action"=>"index")); ?>
							<ul>
								<li><?php echo $html->link("Nuevo Servicio",array("controller"=>"services","action"=>"add")); ?></li>
							</ul>
						</li>
					</ul>
				</li>
				<?php endif;?>
				<?php if(isset($inventarios)): ?> 
				<li>
					<?php echo $html->link("Inventarios",array("#")); ?>
					<ul>
						<li><?php echo $html->link("Factura de Compra",array("controller"=>"inventories","action"=>"add")); ?></li>
						<li><?php echo $html->link("Ventas Online",array("controller"=>"inventories","action"=>"ventasonline")); ?></li>
						<li><?php echo $html->link("Devolución Proveedor",array("controller"=>"inventories","action"=>"devolucionproveedor")); ?></li>
						<li><?php echo $html->link("Devolución Cliente",array("controller"=>"inventories","action"=>"devolucioncliente")); ?></li>
						<li><?php echo $html->link("Factura de Venta",array("controller"=>"inventories","action"=>"facturaventa")); ?></li>
						<li><?php echo $html->link("Salidas Varias",array("controller"=>"inventories","action"=>"salidasvarias")); ?></li>
						<li><?php echo $html->link("Entradas Varias",array("controller"=>"inventories","action"=>"entradasvarias")); ?></li>
					</ul>
				</li>
				<?php endif;?> 
				<?php if(isset($ventas)): ?> 
				<li><?php echo $html->link("Ventas",array("#")); ?>
					<ul>
						<!-- AQUI VA EL LISTADO DE LINKS HACIA LOS REPORTES-->
						<li><?php echo $html->link("Ventas por clientes",array("controller"=>"OnlineSales","action"=>"admin_reporte_ventas_usuarios")); ?></li>
						
					</ul>
					
				</li>
				
				<?php endif;?> 
				<?php if(isset($reportes)): ?> 
				<li><?php echo $html->link("Reportes",array("#")); ?>
					<ul>
						<!-- AQUI VA EL LISTADO DE LINKS HACIA LOS REPORTES-->
						<li><?php echo $html->link("Por usuarios",array("controller"=>"users","action"=>"admin_selectReport")); ?></li>
						<li><?php echo $html->link("Por productos",array("controller"=>"products","action"=>"admin_product_report")); ?></li>
						<li><?php echo $html->link("Reporte Gráfico de Ventas",array("controller"=>"OnlineSales","action"=>"admin_reporte_ventas_graficas")); ?></li>
						<li><?php echo $html->link("Ventas por productos y categorias",array("controller"=>"OnlineSales","action"=>"admin_reporte_ventas")); ?></li>
						<li><?php echo $html->link("Reporte inventarios",array("controller"=>"InventoryMovements","action"=>"admin_reporte_inventario")); ?></li>
						
					</ul>
				</li>
				<?php endif;?> 
				<?php if(isset($auditoria)): ?> 
				<li><?php echo $html->link("Auditoría",array("#")); ?>
					<ul>
						<li><?php echo $html->link("Proveedores",array("controller"=>"audits","action"=>"index","Provider")); ?></li>
						<li><?php echo $html->link("Productos",array("controller"=>"audits","action"=>"index","Product")); ?></li>
						<li><?php echo $html->link("Clientes",array("controller"=>"audits","action"=>"index","Client")); ?></li>
						<li><?php echo $html->link("Usuarios",array("controller"=>"audits","action"=>"index","User")); ?></li>
						<li><?php echo $html->link("Inventarios",array("controller"=>"audits","action"=>"index","InventoryMovement")); ?></li>
						<li><?php echo $html->link("Por usuario",array("controller"=>"audits","action"=>"index", "byUser")); ?></li>
						
					</ul>
				</li>
				<?php endif;?> 
				<?php if(isset($encuestas)): ?> 
				<li><?php echo $html->link("Encuestas",array("#")); ?>
					<ul>
						<li><?php echo $html->link("Crear encuestas",array("controller"=>"surveys","action"=>"add")); ?></li>
						<li><?php echo $html->link("Ver encuestas",array("controller"=>"surveys","action"=>"index")); ?></li>
					</ul>
				</li>
				<?php endif;?> 
				<?php if(isset($reportes))://todos los del back tienen este permiso, esto es un atajo ?> 
				<li><?php echo $html->link("Acerca de",array("#")); ?>
					<ul>
						<li><?php echo $html->link("Versión",array("controller"=>"pages","action"=>"acercade")); ?></li>
						<li><?php echo $html->link("Manual Administrador","/files/manual_de_administrador.pdf"); ?></li>
						<li><?php echo $html->link("Manual Instalación","/files/manual_de_instalacion.pdf"); ?></li>
						<li><?php echo $html->link("Manual Usuario","/files/manual_de_usuario_web.pdf"); ?></li>
						
					</ul>
				</li>
				<?php endif; ?>
				<?php if(isset($reportes))://todos los del back tienen este permiso, esto es un atajo ?> 
					<li><?php echo $html->link(__("logout",true),array("controller"=>"users","action"=>"logout"),array("class"=>"logout"))?><li> 
				<?php endif; ?>
			</ul>
			<?php endif;?>
		<?php //if(!isset($login)) echo $html->link(__("logout",true),array("controller"=>"users","action"=>"logout"),array("class"=>"logout"))?>
		<div style="clear:both;"></div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<?php /*echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);*/
			?>
		</div>
		<?php //echo $this->element("developer-utilities");?>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>