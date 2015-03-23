<?php
$conf = $dados['conf'];
$seccao_ops = $dados['seccao_ops'];
if(isset($seccao_ops['seccoes']))
	$subseccoes = split(',', $seccao_ops['seccoes']);
else
	$subseccoes = Array();
//$selected_option = $dados['selected_option'];
$lingua = $dados['lingua'];

$seccao = $dados['seccao'];
$subseccao = $dados['subseccao'];

if(isset($subseccoes[0]) && $subseccoes[0]!=""):
?>
<script type="text/javascript">
	$(function(){
		$(".steps .option").click(function(){
			var link = $(this).attr('link');
			<?php if($seccao=='e_stat'):?>
			window.location.href="<?= BO_URL::obterHrefInterno("bo/home/index/$seccao/$subseccao/") ?>" + link;
			<?php else: ?>
			window.location.href="<?= BO_URL::obterHrefInterno("bo/home/index/$seccao/") ?>" + link;
			<?php endif; ?>
		});
	});
</script>

<?php
foreach($subseccoes as $ss):
    $ops = split(',', $seccao_ops[$ss]);
?>
<div class="sec_section"><?= $lingua->obter($ss) ?></div>
<div class="steps">
<?php
    foreach($ops as $op):
?>
    <div class="option" link="<?= (isset($seccao_ops[$op."_link"]))?$seccao_ops[BO_TEXTO::codificar($op, '_')."_link"]:BO_TEXTO::codificar($op, '_'); ?>">> <?= $op ?></div>
<?php 
    endforeach;
?>
</div>
<?php
endforeach;
endif;
?>
<div style="color:#555;text-transform: uppercase;margin-top:10px;margin-bottom:5px;">Menu Navega&ccedil;&atilde;o</div>
