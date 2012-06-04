
<form method="post" action="https://gateway2.pagosonline.net/apps/gateway/index.html">
	<table style="display:none;" width="500" border="0" cellpadding="0" cellspacing="2">
		<tr bgcolor="#FF8000 ">
		<th> Campo</th>
		<th >Valor</th>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td>Usuario:</td>
		<td><input name="usuarioId" type="text" value="<?php echo($usuarioId) ?>"></td>
		</tr>
		<tr bgcolor="#DEDEDE">
		<td>Descripci&oacute;n:</td>
		<td><input name="descripcion" type="text" value="<?php echo $descripcion ?>" > </td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td>Ref. Venta:</td>
		<td><input name="refVenta" type="text" value="<?php echo $refVenta ?>"></td>
		</tr>
		<tr bgcolor="#DEDEDE">
		<td>Valor:</td>
		<td><input name="valor" type="text" value="<?php echo $valor ?>">
		</td> </tr> </tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">IVA:</td>
		<td><input name="iva" type="text" value="<?php echo $iva ?>"></td>
		</tr>
		<tr bgcolor="#DEDEDE">
		<td bgcolor="#DEDEDE">Base Devolución Iva:</td>
		<td>
		<input name="baseDevolucionIva" type="text" value="<?php echo $baseDevolucionIva ?>" >
		</td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">Moneda:</td>
		<td><input name="moneda" type="text" value="<?php echo $moneda ?>"></td>
		</tr>
		<tr bgcolor="#DEDEDE">
		<td>Firma:</td>
		<td><input name="firma" type="text" value="<?php echo $firma_codificada ?>"></td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">Extra 1:</td>
		<td><input name="extra1" type="text" value="<?php echo $extra1; ?>"></td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">Extra 2:</td>
		<td><input name="extra2" type="text" value="<?php echo $extra2?>"></td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">Prueba</td>
		<td><input name="prueba" type="text" value="1"></td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td bgcolor="#CCCCCC">Prueba</td>
		<td><input name="url_confirmacion" type="text" value="http://embalao.org/tecnocenter/onlineSales/confirmacion"></td>
		<td><input name="url_respuesta" type="text" value="http://embalao.org/tecnocenter/users/view/<?php echo $usuarioId;?>"></td>
		</tr>
		<tr bgcolor="#CCCCCC">
		<td>&nbsp;</td>
		<td></td>
		</tr>
	
	</table>
<p class="fondeado">
	Esta a punto de realizar su compra por valor de: $ <?php echo number_format($valor, 0, ' ', '.'); ?>
</p>
<input name="Submit" type="submit" value="Enviar">
</form>