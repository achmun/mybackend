<?php
$CLASS = ( isset($CLASS) && $CLASS!='') ? $CLASS : 'alert-warning';
?>
<div class="row clearfix">
    <div class="col-xs-12 alert <?=$CLASS?>" style="text-align: center;">
        <?php if($ERROR_MESSAGE!='') :?>
        {ERROR_MESSAGE}
        <?php else : ?>
        <br />
        <br />
        <p><strong>Sorry, </strong>but the raquest you are looking for has not been found. Back to <a href="<?=  base_url()?>" class="alert-link">homepage</a>
            or back to <a href="javascript::window.history.back()" onclick="history.back()" class="alert-link">previous page</a>.
        </p>
        <br />
        <br />
        <?php endif;?>
        
    </div>
</div>  
