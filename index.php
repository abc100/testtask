<!DOCTYPE html>
<html>

<head> 

<title>Test: directory content</title>
 
</head>

<body>
 
 <?php
	require 'myClass.php';
	
	echo('<form action="" method="post">');
	echo('<b>Input directory name: </b>');

	if (isset($_POST['dir_name'])) {
		echo('<input type="text" name="dir_name" value="'.$_POST['dir_name'].'"/>');
	}
	elseif (isset($_GET['dir_name'])) {
		echo('<input type="text" name="dir_name" value="'.$_GET['dir_name'].'"/>');
	}	
	else {
		echo('<input type="text" name="dir_name" value="'.$_SERVER['DOCUMENT_ROOT'].'"/>');
	}

	echo('<b>Sort by: </b>');
	echo('<select name="sort_type" size=1>');
	
	$selected1 = '';
	$selected2 = '';
	$selected3 = '';
	
	if (isset($_POST['sort_type'])) {
		if ($_POST['sort_type'] == 1) {
			$selected1 = ' selected';
		}
		elseif ($_POST['sort_type'] == 2) {
			$selected2 = ' selected';
		}
		elseif ($_POST['sort_type'] == 3) {
			$selected3 = ' selected';
		}		
	}
	echo('<option value=1'.$selected1.'>name</option>');
	echo('<option value=2'.$selected2.'>type</option>');
	echo('<option value=3'.$selected3.'>size</option>');
	echo('</select>');
	echo('<br/>');
	echo('<input type="submit" value="GO!" />');
	echo('</form>');
 
	echo('<br/>');
	
	if (isset($_POST['dir_name'])) {
		myClass::getInstance()->read_dir($_POST['dir_name']);
		myClass::getInstance()->sort_dir($_POST['sort_type']);
		myClass::getInstance()->show_dir();
	}
	elseif (isset($_GET['dir_name'])) {
		myClass::getInstance()->read_dir($_GET['dir_name']);
		myClass::getInstance()->sort_dir($_POST['sort_type']);
		myClass::getInstance()->show_dir();
	}
	else {
		myClass::getInstance()->read_dir($_SERVER['DOCUMENT_ROOT']);
		myClass::getInstance()->sort_dir($_POST['sort_type']);
		myClass::getInstance()->show_dir();		
	}

 ?>

</body>

</html>