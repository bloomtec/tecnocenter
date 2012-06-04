
var server="/tecnocenter/";
$( function() {
	//CARRITO
	$("p[class^='boton-compra']").css({'cursor':'pointer'});
	$("p[class^='boton-compra']").hover(function(){
		$(this).css({"color":"#25516D","fontSize":17});
	},function(){
		$(this).css({"color":"black","fontSize":"100%"});
	});
	$("p[class^='boton-compra']").click( function() {
		var boton=$(this);
		var id=$(this).attr("class").slice(12);
		$.getJSON(server+"products/shopCart",{"id":id}, function(shopCart) {
			updateResumenCart(shopCart);
			boton.after("<p class='confirm'> añadido al carrito de compra</p>");
			setTimeout(function(){
				$(".confirm").remove();
			},1000);
		});
	});
	
	$(".eliminar").click(function(){//eliminar producto del listado
		var tr=$(this).parent().parent();
		$.getJSON(server+"products/deleteOfCart",{id:tr.attr("rel")},function(shopCart){
			tr.remove();
			actualizarValoresTabla();
			updateResumenCart(shopCart);
			
		});
	});
	$(".cantidadDetallecompra").keyup(function(){
		actualizarValoresTabla();
	});
	$("#OnlineSalesCheckoutForm").submit(function(e){
		if(!checkout){
			e.preventDefault();
			alert("Debes registrarte para poder realizar compras online!");	
		}	
	});
	// ENCUESTA
	$("#send-option").click(function(){
		var optionId= $(".options input:checked").val();
		$.post(server+"surveys/voting",{optionId:optionId},function(data){
			if(data){
				$(".options-container").html('<p class="resultados">Tu voto ha sido recibido, Muchas gracias</p>');
			}
		});
	});
	
//FUNCTIONES__________________________________	
	function updateResumenCart(shopCart){
			$("#items span").text(addCommas(shopCart.count_items));
			$("#valor span").text(addCommas(shopCart.total));
	}
	function actualizarValoresTabla(){
		var cantidad=0;
		var total=0;
		$.each($("td.datos"),function(i,j){		
			//alert(parseInt($(j).children(".cantidadDetallecompra").val() ));
			//alert(parseInt($(j).children("input[type='hidden']").val() ));
			laCantidad=parseInt($(j).children(".cantidadDetallecompra").val());	
			elprecio=parseInt($(j).children("input[type='hidden']").val());
			$(j).next().text(addCommas(laCantidad*elprecio));
			total+=laCantidad*elprecio;
			cantidad+=parseInt($(j).children(".cantidadDetallecompra").val());
			
		})
		$(".last th.valor").text(addCommas(total));
		$(".last th.cantidad").text(addCommas(cantidad));
		$("#valor span").text(addCommas(total));
		//alert(num);
	}
	function addCommas(nStr)
	{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
	return x1 + x2;

	}

});
$(function(){
$.tools.validator.localize("es", {
	'*'			: 'Solo letras y espacios ',
	':email'  	: 'Correo electronico no valido',
	':number' 	: 'El campo debe ser numérico',
	':url' 		: 'El campo debe ser una URL',
	'[max]'	 	: 'Solo quedan $1 productos',
	'[min]'		: 'El campo debe ser mayor a $1',
	'[required]'	: 'Este campo es obligatorio '
});

$.tools.validator.fn("[data-equals]", " $1 diferentes", function(input) {
	var name = input.attr("data-equals"),
		 field = this.getInputs().filter("[id='" + name + "']"); 
	return input.val() == field.val() ? true : [name]; 
});
$.tools.validator.fn("[sololetras]", " $1 diferentes", function(input) {
	var contenido = input.val();
	var patt=/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/;
	var caracteresInvalidos=(contenido.match(patt));
		
	return caracteresInvalidos==null ? true : "Sólo letras y espacios"; 
});
$("#PageContactenosForm").validator({lang: 'es'});
});