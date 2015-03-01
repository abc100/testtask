<?php

 class myClass {
	
	private static $instance;
	private static $arr;
	
	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
	
	public static function getInstance() {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function read_dir($dir_name) {
		
		$handle = opendir($dir_name);
		
		if ($handle != false) {
		
			$arr = array();
			chdir($dir_name);
			
			while (false != ($file=readdir($handle))) {			
				$path_info = pathinfo($file);
				
				self::$arr[$file]["realpath"] = realpath($file);
				
				/*
				self::$arr[$file]["dirname"] = $path_info['dirname'];
				*/
				self::$arr[$file]["filename"] = $path_info['filename'];
				self::$arr[$file]["extension"] = $path_info['extension'];
				/*
				self::$arr[$file]["file"] = $file;
				*/
				if (is_dir($file)) {
					self::$arr[$file]["filesize"] = 0;
					self::$arr[$file]["isdir"] = 0;
				}
				else {
					self::$arr[$file]["filesize"] = filesize($file);
					self::$arr[$file]["isdir"] = 1;
				}
			}
			
			closedir($handle);
		}
		
		return false;
	}
	
	private static function compare1($val1, $val2) {
		if (($val1["isdir"])<($val2["isdir"])) return -1;
		if (($val1["isdir"])>($val2["isdir"])) return 1;
	
		if (strtoupper($val1["filename"])<strtoupper($val2["filename"])) return -1;
		if (strtoupper($val1["filename"])>strtoupper($val2["filename"])) return 1;
		
		if (strtoupper($val1["extension"])<strtoupper($val2["extension"])) return -1;
		if (strtoupper($val1["extension"])>strtoupper($val2["extension"])) return 1;
		
		return 0;
	}
	
	private static function compare2($val1, $val2) {
		if (($val1["isdir"])<($val2["isdir"])) return -1;
		if (($val1["isdir"])>($val2["isdir"])) return 1;
	
		if (strtoupper($val1["extension"])<strtoupper($val2["extension"])) return -1;
		if (strtoupper($val1["extension"])>strtoupper($val2["extension"])) return 1;
		
		if (strtoupper($val1["filename"])<strtoupper($val2["filename"])) return -1;
		if (strtoupper($val1["filename"])>strtoupper($val2["filename"])) return 1;	
		
		return 0;
	}
	
	private static function compare3($val1, $val2) {
		if (($val1["isdir"])<($val2["isdir"])) return -1;
		if (($val1["isdir"])>($val2["isdir"])) return 1;
	
		if (($val1["filesize"])<($val2["filesize"])) return -1;
		if (($val1["filesize"])>($val2["filesize"])) return 1;
	
		if (strtoupper($val1["filename"])<strtoupper($val2["filename"])) return -1;
		if (strtoupper($val1["filename"])>strtoupper($val2["filename"])) return 1;
		
		if (strtoupper($val1["extension"])<strtoupper($val2["extension"])) return -1;
		if (strtoupper($val1["extension"])>strtoupper($val2["extension"])) return 1;	
		
		return 0;
	}
	
	public function sort_dir($sort_type) {
		if ($sort_type == 1) {
			usort(self::$arr, array('myClass','compare1'));
		}
		elseif ($sort_type == 2) {
			usort(self::$arr, array('myClass','compare2'));
		}
		elseif ($sort_type == 3) {
			usort(self::$arr, array('myClass','compare3'));
		}
		else {
			usort(self::$arr, array('myClass','compare1'));
		}
	}
	
	public function show_dir() {
	
		echo('<br/>');
		echo('<table>');
				
		echo('<tr>');
		echo('<td width="200px"><b> Name </b></td>');
		echo('<td width="50px"><b> Type </b></td>');
		echo('<td width="50px"><b> Size </b></td>');
		echo('</tr>');
		echo('<tr>');
		echo('</tr>');
	
		foreach (self::$arr as $file) {		
			echo('<tr>');
			
			if ($file["isdir"] == 0) {
				echo('<td width="200px"><a href="index.php?dir_name='.$file["realpath"].'">'.$file["filename"].'</a></td>');
				echo('<td width="50px"></td>');
				echo('<td width="50px"></td>');
			}
			else {
				echo('<td width="200px">'.$file["filename"].'</td>');
				echo('<td width="50px">'.$file["extension"].'</td>');
				echo('<td width="50px">'.$file["filesize"].'</td>');
			}
			
			echo('</tr>');
		}
		
		echo('</table>');
	}	
 }

?>