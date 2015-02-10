<?php namespace Powerhouse\Core;

class Chart {

	public static function make($type) {
		switch($type) {
			case "line" : return new LineChart();
			break;
			case "pie" : return new PieChart();
			break;
			default : return new BarChart();
			break;
		}
	}

}
