<?php
$conf = $dados['conf'];
$ops = split(',', $dados['seccao_ops']);
$selected_option = $dados['selected_option'];

?>
<?php foreach($ops as $op): ?>
<div class="sec_op<?= ($selected_option==$op)?"_selected":"";?>" option="<?= BO_TEXTO::codificar(utf8_decode($op)) ?>"><?= $op ?></div>
<?php endforeach; ?>
