<?php namespace Powerhouse\Core;

abstract class AbstractChart {

	protected $title;
	protected $data;

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function getData() {
		return $this->data;
	}

}
