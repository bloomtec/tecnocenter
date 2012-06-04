<?php 
/**
 * Llave para hacer encripciones 12ebb235294
 * usuarioId
 */
$llave_encripcion="12ebb235294";
$usuarioId="prueba";
$refVenta="generada-por-base-dedatos";
$valor=number_format($totalVenta, 2, '.', '');
$iva=$totalIva;
$baseDevolucionIva=$valor-$iva;
$moneda=COP;
$descripcion = "Pruebas de Generacion de Firmas";
$firma= "$llave_encripcion~$usuarioId~$refVenta~$valor~$moneda";
$firma_codificada = md5($firma);

?>
<form name="form1" method="post"
action="https://gateway.pagosonline.net/apps/gateway/index.html">
<table width="500" border="0" cellpadding="0" cellspacing="2">
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
<td>&nbsp;</td>
<td><input name="Submit" type="submit" value="Enviar"></td>
</tr>
</table>
<!--
	
<form method="post" action="https://gateway.pagosonline.net/apps/gateway/index.html">
	<input name="usuarioId" type="text" value="2">
	<input name="descripcion" type="text" value="Pruebas">
	<input name="refVenta" type="text" value="0001">
	<input name="valor" type="text" value="116000">
	<input name="baseDevolucionIva " type="text" value="100000">
	<input name="iva" type="text" value="16000">
	<input name="moneda" type="text" value="COP">
	<input name="firma" type="text" value="694f9837325a1948796680e450a820b0">
	<input name="Submit" type="submit" value="Enviar">
</form>
->