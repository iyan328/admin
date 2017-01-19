<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
else{
	$nm = $_SESSION['username'];
}

//cek level user
if($_SESSION['hak_akses']!="admin"){
die("Anda bukan admin");//jika bukan admin jangan lanjut
}
?>
<?php
	include "../dosenp/koneksi.php";
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
		} else {
		echo "<script>alert('Data Belum Dipilih');document.location='subbag.php'</script>";
	}
	$sql2 = "delete from akun WHERE username='$kode'";
	$kueri2 = mysql_query($sql2);
	
	if ($kueri2){
				echo "<script> document.location='subbag.php'</script>";
			}
			else {
				echo "<script> alert('Data gagal dihapus')</script>";
				echo mysql_error();
			}
	?>