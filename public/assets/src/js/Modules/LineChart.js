if (typeof PH == 'undefined') {	var PH = {Module:{}}; }

PH.Module.LineChart = {

	element: null,
	chart: null,
	ctx: null,

	chart_data: {
		labels : [],
		datasets : [],
	},

	dataset: {
		label: "",
		fillColor : "rgba(clr ,clr ,clr , 0.2)",
		strokeColor : "rgba(clr ,clr ,clr , 1)",
		pointColor : "rgba(clr ,clr ,clr , 1)",
		pointStrokeColor : "#fff",
		pointHighlightFill : "#fff",
		pointHighlightStroke : "rgba(clr ,clr ,clr , 1)",
		data : []
	},

	init: function(element) {
		this.element = element;

		this.addLabels();
		this.addDataSets();

		var ctx = element[0].getContext("2d");

		this.chart = new Chart(ctx).Line(this.chart_data, {
			responsive: true
  		});
		
		this.addLegend();
	},

	addLegend: function() {
		var legend = '<ul class="legend">';

		jQuery(this.chart_data.datasets).each(function(i, set){
			legend += '<li style="color: '+set.color.replace(/opacity/g, 1)+';">'+set.label+'</li>';
		});

		legend += '</ul>';

		this.element.parent().append(legend);
	},

	addLabels: function() {
		this.chart_data.labels = this.element.data('labels');
	},

	addDataSets: function() {
		var sets = jQuery(this.element.data('sets'));
		sets.each(function(i, set){
			this.addDataSet(set.label,set.values);
		}.bind(this));
	},

	addDataSet: function(label, data) {
		var dataset = jQuery.extend({}, this.dataset);
		dataset = this.colorize(dataset);
		dataset.label = label;
		dataset.data = data;

		this.chart_data.datasets.push(dataset);
	},

	colorize: function(dataset) {
		var color = 'rgba('+Math.floor(Math.random() * 256)+' ,'+Math.floor(Math.random() * 256)+' ,'+Math.floor(Math.random() * 256)+' , opacity)';
		dataset.color = color;
		dataset.fillColor = color.replace(/opacity/g, 0.2);
		dataset.strokeColor = color.replace(/opacity/g, 1);
		dataset.pointColor = color.replace(/opacity/g, 1);
		dataset.pointHighlightStroke = color.replace(/opacity/g, 1);

		return dataset;
	},
 
	getData: function() {
		return jQuery('.chart-data[data-ref='+(this.element.data('ref'))+']').text();
	}

}