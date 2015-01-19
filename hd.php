<!-- <html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Danh sách sản phẩm</title>
<meta name="title" content="Danh sách sản phẩm">
<meta name="copyright" content="khoavvph03012">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
</style></head><body> -->
<center>
<?php
include("dbconnect.php");
//include("mysql.php");
$table = 'hoadon';
$ColID = 'MaHD';
$ColID2 = 'NgayHD';
$ColID3 = 'MaKH';
$ColID4 = 'GiaTriHD';

$act = $_GET['act'];


if($_GET['sort1'] != '')
	$order_sql = "ORDER BY $ColID ".$_GET['sort1'];
else if($_GET['sort2'] != '')
	$order_sql = "ORDER BY $ColID2 ".$_GET['sort2'];
else if($_GET['sort3'] != '')
	$order_sql = "ORDER BY $ColID3 ".$_GET['sort3'];
else if($_GET['sort4'] != '')
	$order_sql = "ORDER BY $ColID4 ".$_GET['sort4'];
else $order_sql = "ORDER BY $ColID ASC";

$p_now = intval($_GET['page']);
//$pp = ($_GET['limit'] != '' ? intval($_GET['limit']) : 5);
$pp = 5;
$result = $mysql->query("SELECT * FROM $table");
$total =  $mysql->num_rows($result);
$numofpages = $total/$pp;
$numofpages = ceil($numofpages);
if ($p_now <= 0)
	$page = 1;
else {
	if ($p_now <= $numofpages)
		$page = $p_now;
	else
		$page = 1;
}
$limitvalue = $page * $pp - ($pp);
//$limit = $mysql->query("SELECT * FROM $table $order_sql LIMIT $limitvalue,$pp");
$limit = $mysql->query("SELECT hoadon.MaHD, hoadon.NgayHD, khachhang.TenKH, sum(cthoadon.SLSP*cthoadon.GiaSP) as TongTien FROM `cthoadon`, `hoadon`, `khachhang` WHERE hoadon.MaHD=cthoadon.MaHD AND hoadon.MaKH=khachhang.MaKH group by hoadon.MaHD $order_sql LIMIT $limitvalue,$pp");
//$limit = mysql_query("SELECT * FROM $table $order_sql LIMIT $limitvalue,$pp");
//mysql_close();
// <tr><th> MaSP </th> | <th> TenSP </th> |  <th> MaLoaiSP </th>   |  <th> Gia </th>  |  </tr></thead><tbody>
echo '<table class="table table-bordered table-striped table-hover table-condensed">';
echo '<thead><tr><td colspan = "5" style="text-align:center;"><b> Danh sách hóa đơn </b></td></tr></thead>';
echo '<thead>';
echo '<tr><th>MaHD <a href="?sort1='.(($_GET['sort1'] == 'ASC') ? 'DESC">DESC' : 'ASC">ASC').'</a></th>'; // ID
echo '<th>NgayHD <a href="?sort2='.(($_GET['sort2'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>'; // Name
echo '<th>KH <a href="?sort3='.(($_GET['sort3'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>'; // Name
echo '<th>GiaTriHD <a href="?sort4='.(($_GET['sort4'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>';
echo '<th>Act</th>';
echo '</tr></thead><tbody>';
while($data=mysql_fetch_array($limit)) {
	echo '<tr style="">';
	echo '<td>'.$data[$ColID].'</td>'; // Ma
	echo '<td>'.$data[$ColID2].'</td>'; // Ngay
	echo '<td>'.$data['TenKH'].'</td>'; // KH
	echo '<td>'.$data['TongTien'].' đ</td>'; // Gia
	echo '<td><a href="?act=view&IDact='.$data['MaHD'].'">View</a></td>';
	echo '</tr>';
}
?>
</tbody></table><br />
<br /><br /><?php
echo pagination($numofpages,$page).'<br />';
if($act == 'view') {
	$IDact = $_GET['IDact'];
	$sql = $mysql->query("SELECT * FROM cthoadon WHERE $ColID='$IDact'");
	echo '<table class="table table-bordered table-striped table-hover table-condensed">';
	echo '<thead><tr><td colspan = "5" style="text-align:center;"><b> Chi tiết hóa đơn: <font color="red">'.$IDact.'</font> </b></td></tr></thead>';
	echo '<thead>';
	echo '<tr><th>MaHD</th>'; // ID
	echo '<th>MaSP</th>'; // Name
	echo '<th>SLSP</th>'; // Name
	echo '<th>GiaSP</th>';
	echo '<th>Comment</th>';
	echo '</tr></thead><tbody>';
	while($data=mysql_fetch_array($sql)) {
		echo '<tr style="">';
		echo '<td>'.$IDact.'</td>'; // Ma
		echo '<td>'.$data['MaSP'].'</td>'; // Ngay
		echo '<td>'.$data['SLSP'].'</td>'; // KH
		echo '<td>'.$data['GiaSP'].' đ</td>'; // Gia
		echo '<td>'.$data['Comment'].'</td>'; // Gia
		echo '</tr>';
	}
	exit();
}
?></center>