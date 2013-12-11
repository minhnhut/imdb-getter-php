<?php

/* Code lay du lieu tu IMDB
 * Writen by Minh Nhut
 * Ngay 29/4/2013
 * Website: http://minhnhut.info
 * Version: 1.0
 */

class imdb_getter {
	private $ch;
	private $data;
	private $page;
	
	function __construct($url) {
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
	}
	
	public function exec() {
		$this->page = curl_exec($this->ch);
		curl_close($this->ch);
		
		$regex = '/<span class="itemprop" itemprop="name">(.*)<\/span>/';
		preg_match($regex, $this->page, $match);
		$data['title'] = $match[1];
	
		$regex = '/<a href="\/year\/(.*)\/\?ref_=tt_ov_inf" >(.*)<\/a>/';
		preg_match($regex, $this->page, $match);
		$data['year'] = $match[1];

		$regex = '/<meta itemprop="contentRating" content="(.*)" \/>/';
		preg_match($regex, $this->page, $match);
		$data['grene'] = $match[1];

		$regex = '/<a href="\/genre\/(.*)\?ref_=tt_ov_inf" >/';
		preg_match_all($regex, $this->page, $match);
		$data['category'] = $match[1];

		$regex = '/<link rel=\'image_src\' href="(.*)">/';
		preg_match($regex, $this->page, $match);
		$data['thumb'] = $match[1];

		$regex = '/\/\?ref_=tt_ov_dr" itemprop=\'url\'><span class="itemprop" itemprop="name">(.*)<\/span><\/a>/';
		preg_match($regex, $this->page, $match);
		$data['director'] = $match[1];

		$regex = '/\/\?ref_=tt_ov_st" itemprop=\'url\'><span class="itemprop" itemprop="name">(.*)<\/span><\/a>/';
		preg_match_all($regex, $this->page, $match);
		$data['actor'] = $match[1];

		$regex = '/<time itemprop="duration" datetime="PT(.*)M" >/';
		preg_match($regex, $this->page, $match);
		$data['duration'] = $match[1];

		$regex = '/<strong><span itemprop="ratingValue">(.*)<\/span><\/strong>/';
		preg_match($regex, $this->page, $match);
		$data['rate'] = $match[1];
		
		$this->data = $data;
		unset($data);
	}
	
	public function get_title() {
		return $this->data['title'];
	}
	
	public function get_thumb() {
		return $this->data['thumb'];
	}
	
	public function get_year() {
		return $this->data['year'];
	}
	
	public function get_grene() {
		return $this->data['grene'];
	}
	
	public function get_category() {
		return $this->data['category'];
	}
	
	public function get_duration() {
		return $this->data['duration'];
	}
	
	public function get_director() {
		return $this->data['director'];
	}
	
	public function get_actor() {
		return $this->data['actor'];
	}
	
	public function get_rate() {
		return $this->data['rate'];
	}
	
	public function save_thumbnail() {
		$saveTo = str_replace(" ","",strtolower($data['title']));
		if (!file_exists("../img/".$saveTo.".jpg")) {
			$ch = curl_init($data['thumb']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
			$img = curl_exec($ch);
			file_put_contents("../img/".$saveTo.".jpg",$img);
		}
	}
}

?>