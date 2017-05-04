<?php
	$code=strtolower($_POST['code']);
	session_start();
	//echo $code.'<==========>'.$_SESSION['mycode'];
	if($code===$_SESSION['mycode']){
		echo "验证码输入成功！";
	}else{
	 echo "<script>alert('验证码错误');history.go(-1);</script>";
	 exit();
	}
	
	echo "<h1>验证成功！</h1>";
?>