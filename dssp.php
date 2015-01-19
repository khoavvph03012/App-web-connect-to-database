<!-- <html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Danh sách sản phẩm</title>
<meta name="title" content="Danh sách sản phẩm">
<meta name="copyright" content="khoavvph03012">
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
</style></head><body> --><center>
<?php
include("dbconnect.php");
//include("mysql.php");
$table = 'sanpham';
$ColID = 'MaSP';
$ColID2 = 'TenSP';
$ColID3 = 'MaLoaiSP';
$ColID4 = 'Gia';
$act = $_GET['act'];
if($act == 'del' && isset($_SESSION['admin'])) {
	$IDact = $_GET['IDact'];
	$sql = $mysql->query("DELETE FROM $table WHERE $ColID='$IDact'");
	if($sql) echo 'Đã xóa - <a href="'.$_SERVER['PHP_SELF'].'">Home</a>';
	else echo 'Không thể xóa - <a href="'.$_SERVER['PHP_SELF'].'">Home</a>';
} elseif(($act == 'add' || $act == 'adddone') && isset($_SESSION['admin'])) {
	$IDact = $_GET['IDact'];
	if($_POST['adddone'] != '') {
		$dataColID = addslashes($_POST[$ColID]);
		$dataColID2 = addslashes($_POST[$ColID2]);
		$dataColID3 = addslashes($_POST[$ColID3]);
		$dataColID4 = addslashes($_POST[$ColID4]);
		$sql = $mysql->query("INSERT INTO $table VALUES ('$dataColID','$dataColID2','$dataColID3','$dataColID4')");
		if($sql) echo 'Đã Add: '.$IDact.' - <a href="'.$_SERVER['PHP_SELF'].'">Home</a><br />';
		else echo 'Không thể Add: '.$IDact.' - <a href="'.$_SERVER['PHP_SELF'].'">Home</a><br />';
	//exit();
	}
	$source = $mysql->query("SELECT * FROM $table ORDER BY $ColID DESC LIMIT 1");
	$data = mysql_fetch_array($source);
	preg_match('/(\d+)/', $data[$ColID], $dataID);
	preg_match('/(\D+)/', $data[$ColID], $dataPrefix);
	$IDNew = $dataID[0] + 1;
	if ($IDNew < 10) $IDNew = '0'.$IDNew;
	$IDNew = $dataPrefix[0].$IDNew;
	echo '<form action="?act=add&IDact='.$IDNew.'" method="POST">';
	echo '<table border="1" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0">';
	echo '<tr>';
		echo '<td>'.$ColID.'</td>';
		echo '<td><input type="text" name="'.$ColID.'" value="'.$IDNew.'"></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID2.'</td>';
		echo '<td><input type="text" name="'.$ColID2.'" value=""></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID3.'</td>';
		echo '<td><input type="text" name="'.$ColID3.'" value=""></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID4.'</td>';
		echo '<td><input type="text" name="'.$ColID4.'" value=""></td>';
	echo '</tr>';
	echo '<tr><td colspan = "2" style="text-align:center;"><input type="submit" name="adddone" value="Add"> | <a href="?act=">Hủy</a></td></tr>';
	echo '</table>';
	echo '</form>';

} elseif(($act == 'edit' || $act == 'editdone') && isset($_SESSION['admin'])) {
	$IDact = $_GET['IDact'];
	if($_POST['editdone'] != '') {
		$dataColID = addslashes($_POST[$ColID]);
		$dataColID2 = addslashes($_POST[$ColID2]);
		$dataColID3 = addslashes($_POST[$ColID3]);
		$dataColID4 = addslashes($_POST[$ColID4]);
		$sql = $mysql->query("UPDATE $table SET $ColID='$dataColID', $ColID2='$dataColID2', $ColID3='$dataColID3', $ColID4='$dataColID4' WHERE $ColID='$IDact'");
		if($sql) echo 'Đã update: '.$IDact.' - <a href="'.$_SERVER['PHP_SELF'].'">Home</a><br />';
		else echo 'Không thể update: '.$IDact.' - <a href="'.$_SERVER['PHP_SELF'].'">Home</a><br />';
	//exit();
	}
	$source = $mysql->query("SELECT * FROM $table WHERE $ColID='$IDact' LIMIT 1");
	$data = mysql_fetch_array($source);
	echo '<form action="?act=edit&IDact='.$IDact.'" method="POST">';
	echo '<table border="1" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0">';
	echo '<tr>';
		echo '<td>'.$ColID.'</td>';
		echo '<td><input type="text" name="'.$ColID.'" value="'.$data[$ColID].'"></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID2.'</td>';
		echo '<td><input type="text" name="'.$ColID2.'" value="'.$data[$ColID2].'"></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID3.'</td>';
		echo '<td><input type="text" name="'.$ColID3.'" value="'.$data[$ColID3].'"></td>';
	echo '</tr>';
	echo '<tr>';
		echo '<td>'.$ColID4.'</td>';
		echo '<td><input type="text" name="'.$ColID4.'" value="'.$data[$ColID4].'"></td>';
	echo '</tr>';
	echo '<tr><td colspan = "2" style="text-align:center;"><input type="submit" name="editdone" value="Save"> | <a href="?act=">Hủy</a></td></tr>';
	echo '</table>';
	echo '</form>';

} else {

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
$limit = $mysql->query("SELECT * FROM sanpham, loaisanpham WHERE sanpham.MaLoaiSP=loaisanpham.MaloaiSP $order_sql LIMIT $limitvalue,$pp");
//$limit = mysql_query("SELECT * FROM $table $order_sql LIMIT $limitvalue,$pp");
//mysql_close();
// <tr><th> MaSP </th> | <th> TenSP </th> |  <th> MaLoaiSP </th>   |  <th> Gia </th>  |  </tr></thead><tbody>
echo '<table class="table table-bordered table-striped table-hover table-condensed">';
echo '<thead><tr><td colspan = "5" style="text-align:center;"><b> Danh sách sản phẩm </b></td></tr></thead>';
echo '<thead>';
echo '<tr><th>MaSP <a href="?sort1='.(($_GET['sort1'] == 'ASC') ? 'DESC">DESC' : 'ASC">ASC').'</a></th>'; // ID
echo '<th>TenSP <a href="?sort2='.(($_GET['sort2'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>'; // Name
echo '<th>MaLoaiSP <a href="?sort3='.(($_GET['sort3'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>'; // Name
echo '<th>Gia <a href="?sort4='.(($_GET['sort4'] == 'DESC') ? 'ASC">ASC' : 'DESC">DESC').'</a></th>';
echo '<th>Act</th>';
echo '</tr></thead><tbody>';
while($data=mysql_fetch_array($limit)) {
	echo '<tr style="">';
	echo '<td>'.$data[$ColID].'</td>'; // Ma
	echo '<td>'.$data[$ColID2].'</td>'; // Ten
	echo '<td>'.$data[$ColID3].' - '.$data['MoTa'].'</td>'; // MaLoai
	echo '<td>'.$data[$ColID4].' đ</td>'; // Gia
	echo '<td><a href="?act=edit&IDact='.$data['MaSP'].'">Edit</a> - <a href="?act=del&IDact='.$data['MaSP'].'">Del</a></td>';
	echo '</tr>';
}
?>
</tbody></table><br />
<a href="?act=add">Thêm sản phẩm</a>
<br /><br /><?php
echo pagination($numofpages,$page);
}
?></center>