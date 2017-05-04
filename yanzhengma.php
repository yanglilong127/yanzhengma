<?php

	function __autoload($classname){  //当实例化类不存在时执行该函数
		include $classname.'.class.php';
	}
	$code=new CheckCode();
	$code->bg_color='#cce8cf';
	$code->font_color='#305887';
	$code->getimage();
	session_start();
	$_SESSION['mycode'] = $code->getcode();
	//echo $_SESSION['mycode'];
?>