<?php  @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ứng dụng web</title>
<link rel="stylesheet" href="style.css" type="text/css">
<style>
   /* Begin Navigation Bar Styling */
   #nav {
      width: 100%;
      float: left;
      margin: 0 0 3em 0;
      padding: 0;
      list-style: none;
      background-color: #f2f2f2;
      border-bottom: 1px solid #ccc; 
      border-top: 1px solid #ccc; }
   #nav li {
      float: left; }
   #nav li a {
      display: block;
      padding: 8px 15px;
      text-decoration: none;
      font-weight: bold;
      color: #069;
      border-right: 1px solid #ccc; }
   #nav li a:hover {
      color: #c00;
      background-color: #fff; }
   /* End navigation bar styling. */
   
   /* This is just styling for this specific page. */
   body {
      background-color: #555; 
      font: small/1.3 Arial, Helvetica, sans-serif; }
   #wrap {
      width: 750px;
      margin: 0 auto;
      background-color: #fff; }
   h1 {
      font-size: 1.5em;
      padding: 1em 8px;
      color: #333;
      background-color: #069;
      margin: 0; }
   #content {
      padding: 0 50px 50px; }
</style>
</head>

<body>
<div id="wrap">
   <h1> Xây dựng một ứng dụng web kết nối với database</h1>
   
   <!-- Here's all it takes to make this navigation bar. -->
   <ul id="nav">
      <li><a href="?index=dssp.php">Sản phẩm</a></li>
      <li><a href="?index=dslsp.php">Loại sản phẩm</a></li>
      <li><a href="?index=dskh.php">Khách hàng</a></li>
      <li><a href="?index=hd.php">Hóa đơn</a></li>
	  <?php if (!isset($_SESSION['admin']))
		echo '<li><a href="?index=login.php">Login</a></li>';
		else echo '<li><a href="?index=login.php&act=logout">Logout</a></li>';
	  ?>
   </ul>
   <!-- That's it! -->
   
   <div id="content">
      <p>
	  <?php
	  if(!isset($_SESSION['index'])) $_SESSION['index'] = 'dssp.php';
	  if($_GET['index'] != '') $_SESSION['index'] = $_GET['index'];
	  
	  
	  //if(!isset($_SESSION['index'])) $_SESSION['index'] = 'dssp.php';
	  //if(($_GET['index'] != '') && ($_GET['index'] != $_SESSION['index'])) $_SESSION['index'] = $_GET['index'];
	  
	  //if(!isset($_GET['index'])) $_GET['index'] = 'dssp.php';
	  include($_SESSION['index']);
	  ?>
	  
	  </p>
   </div>
</div>

</body>
</html>