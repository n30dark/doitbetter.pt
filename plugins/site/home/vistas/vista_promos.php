<?php
$conf = $dados['conf'];
$lingua = $dados['lingua'];
$promos = $dados['promos'];
?>
<div class="sales">
    <div class="headtag"></div>
    <div class="content">
        <?php foreach($promos as $promo): ?>  
        <div class="promo">  
            <span class="promo_value"><?= strip_tags(html_entity_decode($promo->intro)) ?></span>
               - <?= html_entity_decode($promo->titulo) ?>
        </div>
        <?php endforeach; ?>  
                            
    </div>
</div>