<?php

namespace Powerhouse\Core;

class LineChart extends AbstractChart {

	private $data_sets;
	private $labels;

	public function addDataSet($name, $data) {
		$this->data_sets[] = array(
				'label' => $name,
				'values' => $data
			);
	}

	public function getDataSets() {
		return $this->data_sets;
	}

	public function getLabels() {
		return $this->labels;
	}

	public function setLabels($labels) {
		$this->labels = $labels;
	}

}
