<!-- <html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Danh sách sản phẩm</title>
<meta name="title" content="Danh sách sản phẩm">
<meta name="copyright" content="khoavvph03012">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
</style></head><body> --><center>
<?php
@session_start();
$auth_pass = "5857b972fa07dafa017bbb06a5bbc420"; 
function printLogin() {
?> 

    <style> 

    </style> 
    <center> 
    <form method="post" action=""> 
    <input type="password" name="pass">
	<input type="submit" value="Login">
    </form></center>

    <?php 
    exit; 
}
if($_GET['act'] == 'logout') {
    unset($_SESSION['admin']);
	echo 'Bạn đăng logout thành công<br/>';
	//@session_unregister(md5($_SERVER['HTTP_HOST']));
    //header('Location: http://'.$_SERVER['HTTP_HOST']);
} 
 
if(!isset($_SESSION['admin'])) 
    if(empty($auth_pass) || (isset($_POST['pass']) && (md5($_POST['pass']) == $auth_pass))) {
		//@session_register(md5($_SERVER['HTTP_HOST']));
        $_SESSION['admin'] = true;
		echo 'Bạn đăng login thành công<br/>';
	} else
        printLogin();

?></center>