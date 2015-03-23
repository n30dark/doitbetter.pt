<?php
$conf = $dados['conf'];
$subseccao = $dados['subseccao'];
$action = $dados['action'];

$p = new GestorPlugins();
$p->controlador = 'bo';

$now = date("Y-m-d");
$lastmonth = date("Y-m-d", mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
$lastdays = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-3,   date("Y")));
$lastyear = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d"),   date("Y")-1));

//echo "action: ".$action;


// /* defaults */
// $month = date('n');
// $year = date('Y');

// if(!isset($_GET['month']))
        // $_GET['month'] = date('n');
// if(!isset($_GET['year']))
        // $_GET['year'] = date('Y');

// /* submission? */
// if(isset($_GET['month']) || isset($_GET['year'])):
	// /* cleanse lookups */
	// $month = (int) $_GET['month']; if(!$month) { $month = 1; }
	// $year = (int) $_GET['year']; if(!$year) { $year = date('Y'); }
	// /* retrieve information from google analytics */
	// require_once $conf['Caminho']['SistemaFicheiros'].'lib/gapi.class.php';
	// $ga = new gapi("neopaulino@gmail.com","pj111085");
        // $ga->requestReportData('34069573','day',array('pageviews','visits'), null, null, "2010-06-11", date('Y-m-d'));
		// $results = $ga->getResults();
        // foreach($ga->getResults() as $result):
            // $visits = $result->getVisits();
            // $views = $result->getPageviews();
			
			// $flot_datas_visits[] = '['.$result.','.$visits.']';
			// $flot_datas_views[] = '['.$result.','.$views[$result].']';
			
			// $flot_data_visits = '['.implode(',',$flot_datas_visits).']';
			// $flot_data_views = '['.implode(',',$flot_datas_views).']';
		
        // endforeach;
		
	// /* build tables */
	
// endif;
?>
<script type="text/javascript">
$(function() {
	// var visits = <?php //echo $flot_data_visits; ?>;
	// var views = <?php //echo $flot_data_views; ?>;
	// $('#placeholder').css({
		// height: '400px',
		// width: '600px'
	// });
	// $.plot($('#placeholder'),[
			// { label: 'Visits', data: visits },
			// { label: 'Pageviews', data: views }
		// ],{
	        // lines: { show: true },
	        // points: { show: true },
	        // grid: { backgroundColor: '#fffaff' }
	// });
	
	/*$("#placeholder").load(
		path + '/piwik/index.php?module=CoreHome&action=index&idSite=1&period=day&date=today#module=Dashboard&action=embeddedIndex&idSite=1&period=day&date=today', 
		function(){
			$("#owa_header").hide();
			$(".owa_reportLeftNavColumn").hide();
			$(".report_headline").hide();
			$(".owa_reportPeriod").hide();
			$(".owa_reportContainer").css("background", 'none');
		}
	);*/
	
	$("iframe#live html").css('font','11px');
	
	
});
</script>

<div id="placeholder">
	<!--<iframe src="<?php //echo $conf['Caminho']['Url'] ?>/owa/index.php?owa_do=base.reportDashboard" style="display:block;width:900px;border:none;overflow:hidden;height:100%;">
	</iframe>-->
	
	<?php if($action=='geral'):	?>
	<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitsSummary&actionToWidgetize=index&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
	<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserCountry&actionToWidgetize=getCountry&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
	<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserSettings&actionToWidgetize=getConfiguration&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
	<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Actions&actionToWidgetize=getPageUrls&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
	
	<?php endif; 
	if($action=='ano'):?>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitsSummary&actionToWidgetize=index&idSite=1&period=year&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserCountry&actionToWidgetize=getCountry&idSite=1&period=year&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserSettings&actionToWidgetize=getConfiguration&idSite=1&period=year&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Actions&actionToWidgetize=getPageUrls&idSite=1&period=year&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	<?php endif; 
	if($action=='m_ecirc_s'):?>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitsSummary&actionToWidgetize=index&idSite=1&period=month&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserCountry&actionToWidgetize=getCountry&idSite=1&period=month&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserSettings&actionToWidgetize=getConfiguration&idSite=1&period=month&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Actions&actionToWidgetize=getPageUrls&idSite=1&period=month&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	<?php endif; 
	if($action=='dia'):?>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitsSummary&actionToWidgetize=index&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserCountry&actionToWidgetize=getCountry&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=UserSettings&actionToWidgetize=getConfiguration&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Actions&actionToWidgetize=getPageUrls&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	<?php endif; 
	if($action=='detalhe'):?>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Referers&actionToWidgetize=getRefererType&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitFrequency&actionToWidgetize=getSparklines&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitorInterest&actionToWidgetize=getNumberOfVisitsPerVisitDuration&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitorInterest&actionToWidgetize=getNumberOfVisitsPerPage&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="350" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=VisitTime&actionToWidgetize=getVisitInformationPerLocalTime&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		
	<?php endif; 
	if($action=='utilizadores_online'):?>
		<div id="widgetIframe"><iframe style="display:block;background:none;" width="100%" height="1150" src="http://www.webtodesign.com/piwik/index.php?module=Widgetize&action=iframe&moduleToWidgetize=Live&actionToWidgetize=widget&idSite=1&period=day&date=<?= $now?>&disableLink=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
	<?php endif; ?>
	
</div>


