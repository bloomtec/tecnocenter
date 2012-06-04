var server="/tecnocenter/";
String.prototype.capitalize = function(){
   return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase(); } );
  };
var sendData=function(order,controller){
		var data={};
		for(i=0;i<order.length;i+=1){
			data["data[Item]["+order[i]+"]"]=(i+1);
		}
		$.post(server+controller+"/reOrder",
				data,
				function(response){
					if(response=="yes"){
						for(i=0;i<order.length;i+=1){
							$("tr#"+order[i]).children(".order").text(i+1);
						}
					}
				}
		);
		
		}
	$(function() {
			$( "#sortable tbody" ).sortable({
			revert: true,
			items:"tr:not(.ui-state-disabled)",
			update:function(event, ui){
		
			sendData($(this).sortable("toArray"),$("table").attr("controller"));
			
			
			}
				
		});

		$( "#sortable tbody > tr" ).disableSelection();

	});
		$(function() {
		function log( message ) {
			$( "<div/>" ).text( message ).prependTo( "#log" );
			$( "#log" ).attr( "scrollTop", 0 );
		}

		$( "#product-autocomplete" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: server+"products/getProducts",
					dataType: "json",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						query: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: "nombre: "+item.Product.nombre +  ", codigo:" + item.Product.codigo,
								value: item.Product.codigo,
								id: item.Product.id
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				$("#productId").val(ui.item.id);
				log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
	$(function(){//botones
		$("button.guardar").attr("title","Guardar");
		$("button.limpiar").attr("title","Limpiar");
		$("button.atras").attr("title","Atrás");
		$("button.pdf").attr("title","Exportar a PDF");
		$("button.excel").attr("title","Exportar a Excel");
		$("button#reporte").attr("title","Generar Reporte");
		$("button.guardar").click(function(){
			$("form").submit();
		});
		$("button#reporte").click(function(){
			$("form").submit();
		});
		$(".pdf").click(function(){
			$("#tipoReporte").val("pdf");
			$("form").submit();
		
		});
		$(".excel").click(function(){
			$("#tipoReporte").val("excel");
			$("form").submit();
		
		});
		$("button.limpiar").click(function(){
			$(':input').not(':button, :submit, :reset, :hidden').val('')
		 	.removeAttr('checked')
		 	.removeAttr('selected');
		 	var input=$("input");
		 	var select=$("select");
			//alert($("input:eq(1)").index());
			//alert($("select:eq(1)").index());
			if($("#Lacategoria").length==1){
				$("#Lacategoria").focus();
			}else{
				$("input:eq(1)").focus();
			}
		 	
		 	return false;
		});
		$("button.atras").click(function(){
			window.location=$(this).attr("url");
		});
		
	});
	$(function(){
		//FUNCIONALIDAD CHECKBOX
		$("#InventoryProviderId option:eq(0)").attr("selected",true);
		var checkbox=function(){
			$("#selectAll").attr("title","Seleccionar todo");
			$("#selectAll").click(function(){
				$("input[type='checkbox']").attr("checked",true);
			});
			
			$("#deselectAll").click(function(){
				$("input[type='checkbox']").attr("checked",false);
			});
			
		}();
	
		$.each($("img[title]"),function(i,img){
			$(img).attr("title",$(img).attr("title").capitalize());
		});	
		
		var calculadoraIVA=function(){
			$("#ProductValorVenta").keyup(function(){
				actualizarCampos();
			});
			$("#ProductTarifaIva").change(function(){
				actualizarCampos();
			});
			function actualizarCampos(){
				var valorVenta=parseFloat($("#ProductValorVenta").val());
				var tarifaIva=parseFloat($("#ProductTarifaIva :selected").val())/100;
				var multiplicadorIva=1+tarifaIva;
				var valorBase=(multiplicadorIva>1)?valorVenta/(multiplicadorIva):0;
				var valorIva=(multiplicadorIva>1)?valorVenta-valorBase:0;
				if(isNaN(valorIva)||isNaN(valorIva)){
					$(".valorIva").val("error");
					$(".valorBase").val("error");
					$("#valorIva").val("error");
					$("#valorBase").val("error");
				}else{
					$(".valorIva").val(valorIva);
					$(".valorBase").val(valorBase);
					$("#valorIva").val(valorIva);
					$("#valorBase").val(valorBase);
				}
				
				
			}
		}();
		var calcularUtilidad=function(){
			$("#ProductCosto").keyup(function(){
				actualizarUtilidad();
			});
			$("#ProductValorVenta").keyup(function(){
				actualizarUtilidad();
			});
			$("#ProductTarifaIva").change(function(){
				actualizarUtilidad();
			});
			function actualizarUtilidad(){
				var tarifaIva=parseFloat($("#ProductTarifaIva :selected").val())/100;
				var costo=parseFloat($("#ProductCosto").val());
				var valorVenta=parseFloat($("#ProductValorVenta").val());
				var multiplicadorIva=1+tarifaIva;
				var valorBase=(multiplicadorIva>1)?valorVenta/(multiplicadorIva):0;
				var valorIva=(multiplicadorIva>1)?valorVenta-valorBase:0;				
				if(isNaN(costo)||isNaN(valorVenta)){
					$(".porcentaje").val("error");
					$("#ProductPorcUtilidad").val("error");
				}else{
					$(".porcentaje").val(1-(costo/(valorVenta-valorIva)));
					$("#ProductPorcUtilidad").val(1-(costo/(valorVenta-valorIva)));
				}
			}
		}();
		
		dataTables=function(){
			$('table.reporte').dataTable( {
				"sScrollY": "400px",
				"sScrollX": "950px",
				"bPaginate": false,
				"oLanguage":{
						"sProcessing":   "Procesando...",
						"sLengthMenu":   "Mostrar _MENU_ registros",
						"sZeroRecords":  "No se encontraron resultados",
						"sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
						"sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
						"sInfoFiltered": "(filtrado de _MAX_ registros en total)",
						"sInfoPostFix":  "",
						"sSearch":       "Buscar:",
						"sUrl":          "",
						"oPaginate": {
							"sFirst":    "Primero",
							"sPrevious": "Anterior",
							"sNext":     "Siguiente",
							"sLast":     "Último"
						}
					}
			} );
			$('table.inventario').dataTable( {
				"sScrollY": "200px",
				"sScrollX": "950px",
				"bPaginate": false,
				"oLanguage":{
						"sProcessing":   "Procesando...",
						"sLengthMenu":   "Mostrar _MENU_ registros",
						"sZeroRecords":  "No se encontraron resultados",
						"sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
						"sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
						"sInfoFiltered": "(filtrado de _MAX_ registros en total)",
						"sInfoPostFix":  "",
						"sSearch":       "Buscar:",
						"sUrl":          "",
						"oPaginate": {
							"sFirst":    "Primero",
							"sPrevious": "Anterior",
							"sNext":     "Siguiente",
							"sLast":     "Último"
						}
					}
			} );
			$('table.reporte2').dataTable( {
				"sScrollY": "200px",
				"sScrollX": "950px",
				"bPaginate": false,
				"aaSorting": [[ 9, "desc" ]],
				"oLanguage":{
						"sProcessing":   "Procesando...",
						"sLengthMenu":   "Mostrar _MENU_ registros",
						"sZeroRecords":  "No se encontraron resultados",
						"sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
						"sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
						"sInfoFiltered": "(filtrado de _MAX_ registros en total)",
						"sInfoPostFix":  "",
						"sSearch":       "Buscar:",
						"sUrl":          "",
						"oPaginate": {
							"sFirst":    "Primero",
							"sPrevious": "Anterior",
							"sNext":     "Siguiente",
							"sLast":     "Último"
						}
					}
			} );
		}();
		
	});
