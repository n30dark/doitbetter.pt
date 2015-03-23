<?php

/**
 * Imprime uma mensagem de debug caso o nível de debug definido na raíz seja superior ao 
 * nível definido na mensagem
 * 
 * @param $msg A mensagem a imprimir
 * @param $level O nível da mensagem
 */
function debug($msg, $level=1){
    global $conf;
    if($conf['Debug'] > $level){
        ?> 
        
        <p style="color:blue;"><?php echo $msg ?></p>
        
        <?php
    }   
}

function fahrenheit2celsius($f){
    $c = ($f-32)*(5/9);	
    return (int)$c;
}

function mph2kmh($mph){	
    return (int)($mph * 1.609344);
}
?>