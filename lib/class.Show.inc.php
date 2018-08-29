<?php
class Show extends BaseObject {

	function Show($_params = array()) {
		parent::BaseObject($_params,'shows','id');
	}

	public static function getShowByURI($show_uri) {
		$db = getDb();
		$sql = 'SELECT * FROM shows WHERE show_uri = ?';
		$rs = $db->Execute($sql,array($show_uri));
		$rows = $rs->GetRows();
		if(count($rows) > 0) {
			return $rows[0];
		}
	}

	public static function getGenres($show_id) {
		$db = getDb();
		$sql = 'select g.* from shows s 
			left join show_genres sg on s.id = sg.show_id
			left join genres g on g.id = sg.genre_id
			where s.id = ?';
		$rs = $db->Execute($sql,array($show_id));
		$rows = $rs->GetRows();
		return $rows;
	}

	public static function getNetworks($show_id) {
		$db = getDb();
		$sql = 'select n.* from shows s 
			left join show_networks sn on s.id = sn.show_id
			left join networks n on n.id = sn.network_id
			where s.id = ?';
		$rs = $db->Execute($sql,array($show_id));
		$rows = $rs->GetRows();
		return $rows;
	}


	public static function getRandom() {
		$db = getDb();
		$db->debug = true;
		$params = array();
		$genre_filter = $filter['genre'];
		$network_filter = $filter['network'];
		$sql = 'select min(n.network_name) as network_name, min(b.file_path) as file_path,s.* from shows s
			 left join show_genres sg on s.id = sg.show_id
			 left join genres g on g.id = sg.genre_id
			 left join show_networks sn on s.id = sn.show_id
			 left join networks n on n.id = sn.network_id
			 left join backdrops b on b.show_id = s.id
			 where b.type = \'backdrop\'';
			$sql .= ' group by s.id order by rand()';
		$rs = $db->Execute($sql);
		$rows = $rs->GetRows();
		return $rows[0];
	}



	public static function getAll($filter) {
		$db = getDb();
		$params = array();
		$genre_filter = $filter['genre'];
		$network_filter = $filter['network'];
		$language_filter = $filter['language'];
		$sql = 'select min(n.network_name) as network_name, min(b.file_path) as file_path,s.* from shows s
			 left join show_genres sg on s.id = sg.show_id
			 left join genres g on g.id = sg.genre_id
			 left join show_networks sn on s.id = sn.show_id
			 left join networks n on n.id = sn.network_id
			 left join show_languages sl on s.id = sl.show_id
			 left join languages l on sl.language_id = l.id
			 left join backdrops b on b.show_id = s.id
			 where b.type = \'poster\'';

			 if(trim($genre_filter) != '') {
			 	$sql .= ' and lower(g.genre_name) = lower(?) ';
			 	$params[] = $genre_filter;
			 }
			 if(trim($network_filter) != '') {
			 	$sql .= ' and lower(n.network_name) = lower(?) ';
			 	$params[] = $network_filter;
			 }
			 if(trim($language_filter) != '') {
			 	$sql .= ' and lower(l.language_name) = lower(?) ';
			 	$params[] = $language_filter;
			 }

			$sql .= ' group by s.id';
		$rs = $db->Execute($sql,$params);
		$rows = $rs->GetRows();
		return $rows;
	}

	public function addNetwork($network_name) {
		$network = Network::FindOrCreateByName($network_name,'networks','network_name');

		$db = getDb();
//		$db->debug = true;
		$sql = 'SELECT * FROM show_networks WHERE show_id = ? and network_id = ?';
		$rs = $db->Execute($sql,array($this->params['id'],$network['id']));
		$rows = $rs->GetRows();
		if(count($rows) == 0) {
			$params = array();
			$params['show_id'] = $this->params['id'];
			$params['network_id'] = $network['id'];
			$params['created_at'] = time();
			$params['updated_at'] = time();
			$sql = $db->GetInsertSql($rs,$params);
			$rs = $db->Execute($sql);
		}

	}

	public function addLanguage($language_name) {
		$language = Language::FindOrcreateByName($language_name,'languages','language_name');
		$db = getDb();
//		$db->debug = true;
		$sql = 'SELECT * FROM show_languages WHERE show_id = ? and language_id = ?';
		$rs = $db->Execute($sql,array($this->params['id'],$language['id']));
		$rows = $rs->GetRows();
		if(count($rows) == 0) {
			$params = array();
			$params['show_id'] = $this->params['id'];
			$params['language_id'] = $language['id'];
			$params['created_at'] = time();
			$params['updated_at'] = time();
			$sql = $db->GetInsertSql($rs,$params);
			$rs = $db->Execute($sql);
		}

	}

	public function addGenre($genre_name) {
		$genre = Genre::FindOrCreateByName($genre_name,'genres','genre_name');
		$db = getDb();
//		$db->debug = true;
		$sql = 'SELECT * FROM show_genres WHERE show_id = ? and genre_id = ?';
		$rs = $db->Execute($sql,array($this->params['id'],$genre['id']));
		$rows = $rs->GetRows();
		if(count($rows) == 0) {
			$params = array();
			$params['show_id'] = $this->params['id'];
			$params['genre_id'] = $genre['id'];
			$params['created_at'] = time();
			$params['updated_at'] = time();
			$sql = $db->GetInsertSql($rs,$params);
			$rs = $db->Execute($sql);
		}
	}

	public function addExternalId($external_id,$value) {
		$external = External::FindOrCreateByName($external_id,'externals','external_name');
		$db = getDb();
		$db->debug = true;
		$sql = 'SELECT * FROM show_external_ids WHERE show_id = ? and external_id = ?';
		$rs = $db->Execute($sql,array($this->params['id'],$external['id']));
		$rows = $rs->GetRows();

		$params = array();
		$params['show_id'] = $this->params['id'];
		$params['external_id'] = $external['id'];
		$params['value'] = $value;
		$params['updated_at'] = time();
		echo "Rows = " . count($rows) . "<br />";
		if(count($rows) == 1) {
			// we need to update
			$updateSql = $db->GetUpdateSql($rs,$params);
			$rs = $db->Execute($updateSql);
		} elseif (count($rows) == 0) {
			// we need to insert
			$params['created_at'] = time();
			$insertSql = $db->GetInsertSql($rs,$params);
			echo "insertSql = $insertSql<Br />";
			$rs = $db->Execute($insertSql);
		}
	}


	public function saveBackdrop($params) {
		// First check to see if we have it and need to update
	}

	public static function importTmdb($tmdbId) {
		$object = json_decode(getTmdbShow($tmdbId));
		$show_name = $object->name;

		$obj = Show::FindOrcreateByName($show_name,'shows','show_name');
		$show = new Show($obj);
		$show->params['show_description'] = $object->overview;
		//$show->imdbid = '';
		$show->params['show_image_large'] = "https://image.tmdb.org/t/p/original" . $object->backdrop_path;
		$show->params['show_image_small'] = "https://image.tmdb.org/t/p/original" .$object->poster_path;
		$show->params['show_uri'] = str_replace(' ','_',strtolower($show_name));
		$show->params['homepage'] = $object->homepage;
		$show->params['in_production'] = ($object->in_production == 1);
		$show->params['number_of_episodes'] = $object->number_of_episodes;
		$show->params['seasons'] = count($object->seasons);
		$show->params['tmdbid'] = $tmdbId;
		$show->save();
		$networks = $object->networks;
		foreach($networks as $network) {
			$show->addNetwork($network->name);
		}
		$genres = $object->genres;
		foreach($genres as $genre) {
			$show->addGenre($genre->name);
		}

		$languages = $object->languages;
		foreach($languages as $language) {
			$show->addLanguage($language);
		}

		// External IDs
		$external_ids = json_decode(getExternalIds($tmdbId));
		while(list($key,$val) = each($external_ids)) {
			// We don't need the tmdbId
			if($key != 'id' && $val != '') {
				$show->addExternalId($key,$val);
			}
		}

		$images = json_decode(getBackdrops($tmdbId));
		$backdrops = $images->backdrops;
		foreach($backdrops as $backdrop) {
			$params = array();
			$params['show_id'] = $show->params['id'];
			$params['aspect_ratio'] = $backdrop->aspect_ratio;
			$params['file_path'] = $backdrop->file_path;
			$params['type'] = 'backdrop';
			$params['height'] = $backdrop->height;
			$params['width'] = $backdrop->width;
			$bd = new Backdrop($params);
			$bd->save();
		}
		$posters = $images->posters;
		foreach($posters as $poster) {
			$params = array();
			$params['show_id'] = $show->params['id'];
			$params['aspect_ratio'] = $poster->aspect_ratio;
			$params['file_path'] = $poster->file_path;
			$params['type'] = 'poster';
			$params['height'] = $poster->height;
			$params['width'] = $poster->width;
			$p = new Backdrop($params);
			$p->save();
		}






	}

}
?>