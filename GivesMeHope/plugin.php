<?php

class GivesMeHope extends SilverBotPlugin {

	private $cache = array();

	public function chn_gmh($data) {
		if (count($this->cache) < 3) $this->refillCache();
		$fml = array_shift($this->cache);
		
		$this->bot->reply($fml);
	}
	
	private function refillCache() {
		$url = 'http://www.givesmehope.com/random';
		$tags = get_meta_tags($url);
		if (isset($tags['description'])) {
			$description = $tags['description'];
			$gmh = html_entity_decode(preg_replace("/[\r\n]+/", ' ', strip_tags(trim($description))));
			$brokenOnDashes = explode(' - ', $gmh);
			if (count($brokenOnDashes) > 1) {
				array_shift($brokenOnDashes);
				$gmh = implode(' - ', $brokenOnDashes);
			}
			$this->cache[] = $gmh;
		}
	}
	
}

