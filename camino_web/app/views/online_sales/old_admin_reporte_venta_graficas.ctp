<div id="graph">Loading graph...</div>
			<?php echo $this->Html->script("jscharts.js",true); ?>
			<script type="text/javascript">
				var productos=<?php echo json_encode($rpt)?>;
				var myData=new Array();
				var colors = ['#0673B8', '#0091F1', '#F85900', '#1CC2E6', '#C32121'];
				var myColors=new Array();
				for(i=0,j=0;i<productos.length;i++,j++){
				 //alert(productos[i]["nombre"]);
				 if(j>=colors.length){
				 	j=0;
				 }
				 myColors[i]=colors[j];
				 myData[i]=[productos[i]["nombre"],productos[i]["porcenjate"]];
				}
				//var myData = new Array(['IE7', 26], ['IE6', 24.6], ['Firefox', 44.2], ['Safari', 2.6], ['Opera', 2.1]);
				
				var myChart = new JSChart('graph', 'pie');
				myChart.setDataArray(myData);
				myChart.colorizePie(myColors);
				myChart.setTitle("<?php echo $titulo;?>");
				myChart.setTitleColor('#8E8E8E');
				myChart.setTitleFontSize(11);
				myChart.setTextPaddingTop(280);
				myChart.setPieValuesDecimals(1);
				myChart.setPieUnitsFontSize(9);
				myChart.setPieValuesFontSize(8);
				myChart.setPieValuesColor('#fff');
				myChart.setPieUnitsColor('#969696');
				myChart.setSize(616, 321);
				myChart.setPiePosition(308, 145);
				myChart.setPieRadius(95);
				myChart.setFlagColor('#fff');
				myChart.setFlagRadius(4);
				myChart.setTooltipOpacity(1);
				myChart.setTooltipBackground('#ddf');
				myChart.setTooltipPosition('ne');
				myChart.setTooltipOffset(2);
				myChart.setBackgroundImage('chart_bg.jpg');
				myChart.draw();
			</script>