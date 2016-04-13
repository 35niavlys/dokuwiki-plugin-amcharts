jQuery(document).ready(function() {
    jQuery("[id^=__amchart_]").each(function(i, div) {
		try {
			var id = jQuery(div).attr('id');
			var amdata = jQuery(div).attr('data-amchart');
			var chart = AmCharts.makeChart(id, jsyaml.load(decodeURIComponent(escape(atob(amdata)))));
		} catch(err) {
			console.warn(err.message);
		}
	});
});
