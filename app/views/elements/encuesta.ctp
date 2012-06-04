<div class="options">
	<?php if(!empty($encuesta["Survey"]["titulo"])):?>
	<h2><?php echo $encuesta["Survey"]["titulo"] ?></h2>
	<div class="options-container">
	<?php $voto=$session->read("voto");?>
	<?php if(empty($voto)||!$voto){ ?>
		<?php echo $this->Form->radio("SurveyOption",$surveyOptions,array("id"=>"survey-options","separator"=>"<div style='clear:both'> </div>")); ?>
    	<div id="send-option">votar</div>
    	<?php }else{?>
    	<ul>
    		<?php foreach($encuesta["SurveyOption"] as $option):?>
    			<li>
    				<label><?php echo $option["name"];?></label>
    				<div class="votos"><?php echo $option["votos"];?></div>
    				<div style="clear:both"></div>
    			</li>
    		<?php endforeach;?>
    	</ul>	
    	<?php }?>
     </div>
    	<?php endif;?>
   
    	<?php if(empty($encuesta["Survey"]["titulo"])):?>
    		No hay encuesta disponible
    	<?php endif;?>
    	
    	
 </div>