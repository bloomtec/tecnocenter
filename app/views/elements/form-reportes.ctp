<?php 
	$key="";

	echo $form->create($model);
	foreach($this->data as $key => $field){
		foreach($field as $fieldName=>$value){

			echo $form->hidden($key.".".$fieldName,array("value"=>$value));
		}		
	}
	if($key!="Report") echo $form->hidden("Report.tipo",array("id"=>"tipoReporte"));
	echo $form->end();
?>