<?php


class nofollowphp  {

	private $filter = array();
	private $html = '';
	

	static function make($html) {
		return new self($html);
	}

	function __construct($value) {
		
		$this->html = $value;
	
	}

	
	function addfilter($value) {	
		
		if (is_array($value))
			$this->filter = array_merge($this->filter, $value);
		else
			$this->filter[] = $value;
		
		return $this;
	
	}


	function html($value) {
		
		$this->html = $value;
		return $this;
	
	}

	function get() {
		return $this->parselinks($this->html);
	}

	
	function parselinks($html, $body = True){
		
		if ($html == '')
			return '';

		$dom = new DOMDocument;
		$dom->loadHTML($html);

		$links = $dom->getElementsByTagName('a');

		foreach($links as $link) {

			$href = $link->getAttribute('href');

			$href = str_replace(array('http://', 'https://'), '', $href);
			$href = trim($href, '/');

			
			if (in_array($href, $this->filter))
				$link->setAttribute('rel','nofollow');

		}

		echo $dom->getElementsByTagName('body')->nodeValue;

		if ($body)
			return $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
		else
			return $dom->saveHTML();


	}


}
