<?php
$conf = $dados['conf'];

$p = new GestorPlugins();
$p->controlador = 'bo';

$bd = new BaseDados();

if($conf['modificacoes']['paginas']!=""){
	$idpagina = $conf['modificacoes']['paginas'];
	$ultimapagina = $bd->obterObjecto("SELECT * FROM paginas WHERE id='$idpagina'");
}
if($conf['modificacoes']['produtos']!=""){
	$idproduto = $conf['modificacoes']['produtos'];
	$ultimoproduto = $bd->obterObjecto("SELECT * FROM produtos WHERE id='$idproduto'");
}
if($conf['modificacoes']['artigos']!=""){
	$idartigo = $conf['modificacoes']['artigos'];
	$ultimoartigo = $bd->obterObjecto("SELECT * FROM artigos WHERE id='$idartigo'");
}

$now = date("Y-m-d");
$startat = date("Y-m-d", mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));

?>
<script  type="text/javascript">
    $(document).ready(function(){
	$('#fancyClock').tzineClock();
    });
</script>

<div class="left">
	<!--<div class="data_hora">
		<div class="title">&Uacute;ltimas Visitas</div>
		<object style="visibility: visible;" id="VisitsSummarygetEvolutionGraphChart_swf" data="http://www.webtodesign.com/piwik/libs/open-flash-chart/open-flash-chart.swf?piwik=0.6.3" bgcolor="none" type="application/x-shockwave-flash" height="150" width="100%"><param value="always" name="allowScriptAccess"><param value="transparent" name="wmode"><param value="data-file=http%3A%2F%2Fwww.webtodesign.com%2Fpiwik%2Findex.php%3Fmodule%3DVisitsSummary%26action%3DgetEvolutionGraph%26columns%5B%5D%3Dnb_visits%26idSite%3D1%26period%3Dday%26date%3D<?= $startat?>%2C<?= $now?>%26viewDataTable%3DgenerateDataChartEvolution&id=VisitsSummarygetEvolutionGraphChart_swf&loading=Loading..." name="flashvars"></object>
	</div>-->
	
    <div class="data_hora" style="margin-top:10px;">
        <div class="title">Data/Hora</div>
        <div id="fancydate"><?= ""//BO_DATA::obter_data(); ?></div>
        <div id="fancyClock"></div>
    </div>
	
</div>
<div class="right">
    <div class="msgs_sistema">
        <div class="title">Mensagens de Sistema</div>
        <div id="messages">Nada a assinalar...</div>
    </div>

    <div class="infos_sistema">
        <div class="title">Informações de Sistema</div>
        <table>
            <th colspan="2">Informações de Sistema</th>
            <tr>
                <td class="label">Website URL</td>
                <td class="data"><?= $conf['Caminho']['Url'] ?></td>
            </tr>
            <tr>
                <td class="label">Current database</td>
                <td class="data"><?= $conf['BaseDados']['BaseDados']?></td>
            </tr>
            <tr>
                <td class="label">Última modificação - Páginas</td>
                <td class="data"><?= ($conf['modificacoes']['paginas']!="")?"<a href='".BO_URL::obterHrefInterno("/bo/home/index/e_cms/paginas/edit/$idpagina")."'>$ultimapagina->titulo</a>":""; ?></td>
            </tr>
            <tr>
                <td class="label">Última modificação - Artigos</td>
                <td class="data"><?= ($conf['modificacoes']['artigos']!="")?"<a href='".BO_URL::obterHrefInterno("/bo/home/index/e_cms/artigos/edit/$idartigo")."'>$ultimoartigo->titulo</a>":""; ?></td>
            </tr>
            <tr>
                <td class="label">Última modificação - Produtos</td>
                <td class="data"><?= ($conf['modificacoes']['produtos']!="")?"<a href='".BO_URL::obterHrefInterno("/bo/home/index/e_shop/produtos/edit/$idproduto")."'>$ultimoproduto->nome</a>":""; ?></td>
            </tr>
        </table>
    </div>
</div>