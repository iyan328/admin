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
die("Anda bukan Admin");//jika bukan admin jangan lanjut
}
?>
<?php
	include "../dosenp/koneksi.php";
	
	$sql = "SELECT * FROM akun WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama = $data['username'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../dosenp/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dosenp/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../dosenp/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../dosenp/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="homedosen.php">Dosen Pembimbing</a> -->
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="homeadmin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="m" class="collapse">
                            
							<li>
                                <a href="koor.php"><i class="fa fa-fw fa-user"></i>Dosen Koordinator</a>
                            </li>
							<li>
                                <a href="pudir.php"><i class="fa fa-fw fa-user"></i>Pudir</a>
                            </li>
                            
							<li>
                                <a href="subbag.php"><i class="fa fa-fw fa-user"></i>Sub Bag Kerjasama</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
				<div class="col-lg-3">
				<form action="" method="post">
					<!-- <input class="btn btn-default" name="tambah" type="submit" id="tambah" value="Tambah"/> -->
					<p>
					
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Open Modal</button>
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">

						<!-- Modal content-->
						<form action="" method="post">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Tambah Akun</h4>
						  </div>
						  <div class="modal-body">
							<div class="form-group">
								<label>Nama</label>
								<input name="nama" class="form-control">
							</div>
							<div class="form-group">
								<label>Nik</label>
								<input name="nik" class="form-control">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input name="user" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input name="pass" class="form-control">
							</div>
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-default" name="simpan">Simpan</button>
						  </div>
						</div>
						</form>
						<?php 
					if(isset($_POST['simpan'])){
						include "..dosenp/koneksi.php";
						$nama=$_POST['nama'];
						$nik=$_POST['nik'];
						$user=$_POST['user'];
						$pass=$_POST['pass'];
						
						$sql3=mysql_query("INSERT into akun values('$user', '$pass', 'sbk')");
						$sql4=mysql_query("SELECT * from akun where username='$user'");
						$data4=mysql_fetch_array($sql4);
						$sql5=mysql_query("INSERT into sbk values('$user', '$nik', '$nama')");
						if($sql5){
							echo "<script> document.location='../admin/subbag.php'</script>";
								}else {
									echo "<script>alert('data gagal disimpan'); document.location='../admin/subbag.php'</script>";
								}
					}
					?>
					  </div>
					</div>
					
					</div>
					</div>
					<div class="row">
					<div class="col-lg-12">
					<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
										<th>Nama</th>
										<th>Nik</th>
										<th>Username</th>
										<th>Password</th>
										<th>Hapus</th>
									</tr>
                                </thead>
                                <tbody>
									<?php
						include "../dosenp/koneksi.php";
							$sql = "SELECT * from akun where hak_akses='sbk'";
							$kueri = mysql_query($sql);
							$no=1;
							while($data = mysql_fetch_array($kueri)){
								$username1=$data['username'];
							$sql1=mysql_query("SELECT * from sbk where username='$username1'");
							$data1=mysql_fetch_array($sql1);
					?>
								<tr>
								<td><?php echo $data1['nama']?></td>
								<td><?php echo $data1['nik']?></td>
								<td><input name="uname[]" value="<?php echo $data['username']?>" readonly></td>
								<td><input name="pass[]" value="<?php echo $data['password']?>"></td>
								<!--<td><a href="lihatakundp.php?kode=<?php echo $data['username']?>"> Lihat </a> </td> -->
								<!--<td><a href="ubahdosen.php?kode=<?php echo $data['username']?>"> Ubah </a> </td>-->
								<td><a href="hapussubbag.php?kode=<?php echo $data['username']?>"> Hapus </a> </td>
								</tr>
							<?php
								$no++;}
							?>
                                </tbody>
                            </table>
							<button class="btn btn-default" name="ubah" id="tambah" type="submit">Ubah Akun</button>
                        </div>
				</form>
                </div>
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../dosenp/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../dosenp/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../dosenp/js/plugins/morris/raphael.min.js"></script>
    <script src="../dosenp/js/plugins/morris/morris.min.js"></script>
    <script src="../dosenp/js/plugins/morris/morris-data.js"></script>

</body>

</html>
<?php
if(isset($_POST['ubah'])){
	include "../dosenp/koneksi.php";
	$pass=$_POST['pass'];
	$uname=$_POST['uname'];
	
	for($i=0;$i<sizeof($pass);$i++){
		$sql2=mysql_query("Update akun set password = '$pass[$i]' where username='$uname[$i]'");
		if($sql2){
			echo "<script> document.location='../admin/subbag.php'</script>";
		}else {
			echo "<script>alert('data gagal di ubah'); document.location='../admin/subbag.php'</script>";
		}
	}
}
?>