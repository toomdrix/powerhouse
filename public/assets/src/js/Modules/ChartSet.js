if (typeof PH == 'undefined') {	var PH = {Module:{}}; }

PH.Module.ChartSet = {

	charts: jQuery([]),

	init: function() {
		this.charts = jQuery('.chart');

		if (!this.charts.length) {
			return;
		}

			var chart, element, type;
			var that = this;
			this.charts.each(function(){
				element = jQuery(this);
				type = that.getType(element)+'Chart';
				chart = PH.Utilities.getInstance(PH.Module[type]);

				if (typeof chart != 'undefined') {
					chart.init(element);
					that.charts.push(chart);
				}

			});
	},

	getType: function(element) {
		return element.data('type');
	}

}