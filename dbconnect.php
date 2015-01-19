<?php
function pagination($numofpages,$page_num) {
	if ($numofpages > 1) {
		$range = 8;
		$range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1)/2;
		$range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
		$page_min = $page_num - $range_min;
		$page_max = $page_num + $range_max;
		$page_min = ($page_min < 1) ? 1 : $page_min;
		$page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
		if ($page_max > $numofpages) {
			$page_min = ($page_min> 1) ? $numofpages - $range + 1 : 1;
			$page_max = $numofpages;
		}
		$page_min = ($page_min < 1) ? 1 : $page_min;
		if (($page_num > ($range -$range_min)) && ($numofpages > $range)) {
			$page_pagination .= '<a title="First" href="'.$_SERVER['PHP_SELF'].'?page=1#"> Đầu </a>';
		}
		if ($page_num != 1) {
			$page_pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($page_num - 1).'#"> Trước </a>';
		}
		for ($i = $page_min;$i <= $page_max;$i++) {
			if ($i == $page_num)
				$page_pagination .= '<span class="current"> '.$i.' </span>';
			else
				$page_pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'#"> '.$i.' </a>';
		}
		if ($page_num < $numofpages) {
			$page_pagination .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.($page_num + 1).'#"> Tiếp </a>';
		}
		if (($page_num < ($numofpages - $range_max)) && ($numofpages > $range)) {
			$page_pagination .= '<a title="Last" href="'.$_SERVER['PHP_SELF'].'?page='.$numofpages.'#"> Cuối </a>';
		}
		$page_pagination = '<span class="sotrang">Page: ('.$page_num.'/'.$numofpages.') </span> '.$page_pagination;
	}
	return $page_pagination;
}
class mysql { 
	var $link_id;
	var $log_file = 'logs.txt';
	var $log_error = 1;
	function connect($db_host, $db_username, $db_password, $db_name) {
		$this->link_id = @mysql_connect($db_host, $db_username, $db_password);		@mysql_query("SET NAMES 'UTF8'");
		if ($this->link_id){
			if (@mysql_select_db($db_name, $this->link_id)) return $this->link_id;
			else $this->show_error('Unable to select database. MySQL reported: '.mysql_error());
		}
		else $this->show_error('Unable to connect to MySQL server. MySQL reported: '.mysql_error());
	}
	function query($input){
		$q = @mysql_query($input) or $this->show_error("<b>Lỗi MySQL Query</b> : ".mysql_error(),$input);
		return $q;
	}
	function fetch_array($query_id, $type=MYSQL_BOTH){
		$fa = @mysql_fetch_array($query_id,$type);
		return $fa;
	}
	function fetch_assoc($query_id){
		$fa = @mysql_fetch_assoc($query_id);
		return $fa;
	}
	function num_rows($query_id) {
		$nr = @mysql_num_rows($query_id);
		return $nr;
	}
	function result($query_id, $row=0, $field) {
		$r = @mysql_result($query_id, $row, $field);
		return $r;
	}
	function insert_id() {
		return @mysql_insert_id($this->link_id);
	}
	function show_error($input,$q){
		if ($this->log_error) {
			$file_name = $this->log_file;
			$fp = fopen($file_name,'a');
			flock($fp,2);
			@fwrite($fp,"### ".date('H:s:i d-m-Y',NOW)." ###\n");
			fwrite($fp,$input."\n");
			fwrite($fp,"QUERY : ".$q."\n");
			flock($fp,1);
			fclose($fp);
		}
		exit($input);
	}
}
$config['db_host']	= 'localhost';
$config['db_name'] 	= 'inf205';
$config['db_user']	= 'root';
$config['db_pass']	= '';
$tb_prefix			= '';
$mysql = new mysql;
$mysql->connect($config['db_host'],$config['db_user'],$config['db_pass'],$config['db_name']);
?>