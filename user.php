<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$page = "Data User";
	session_start();
	include 'auth/connect.php';
	include "template/head.php";

	if (isset($_POST['submit'])) {
		$id = $_POST['iduser'];
		$nama = $_POST['nama'];
		$user = $_POST['username'];
		$old_pass = $_POST['old_password'];
		$new_pass = $_POST['new_password'];

		if ($old_pass == "" && $new_pass == "") {
			$up1 = mysqli_query($conn, "UPDATE user SET nama_pegawai='$nama', username='$user', WHERE id='$id'");
			echo '<script>
			setTimeout(function() {
				swal({
					title: "Data Diubah",
					text: "Data berhasil diubah!",
					icon: "success"
					});
					}, 500);
					</script>';
		} elseif ($old_pass != "" && $new_pass != "") {
			$cekpass = mysqli_query($conn, "SELECT * FROM user WHERE id='$id' AND password='$old_pass'");
			$cekada = mysqli_num_rows($cekpass);
			if ($cekada == 0) {
				echo '<script>
						setTimeout(function() {
							swal({
								title: "Password salah",
								text: "Password salah, cek kembali form password anda!",
								icon: "error"
								});
								}, 500);
								</script>';
			} else {
				$up2 = mysqli_query($conn, "UPDATE user SET nama_pegawai='$nama', username='$user', password='$new_pass', WHERE id='$id'");
				echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data atau Password berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
			}
		}
	}

	if (isset($_POST['submit2'])) {
		$nama = $_POST['nama'];
		$user = $_POST['username'];
		$pass = $_POST['password'];
		$job = $_POST['pekerjaan'];

		$cekuser = mysqli_query($conn, "SELECT * FROM user WHERE username='$user'");
		$baris = mysqli_num_rows($cekuser);
		if ($baris >= 1) {
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Username sudah digunakan",
						text: "Username sudah digunakan, gunakan username lain!",
						icon: "error"
						});
					}, 500);
			</script>';
		} else {
			$add = mysqli_query($conn, "INSERT INTO user (username, password, nama_pegawai, pekerjaan) VALUES ('$user', '$pass', '$nama', '$alam', '$job')");
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Pegawai telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
		}
	}
	?>
</head>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>

			<?php
			include 'template/navbar.php';
			include 'template/sidebar.php';
			?>

			<!-- Main Content -->
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1><?php echo $page; ?></h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h4><?php echo $page; ?></h4>
										<div class="card-header-action">
											<a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah User</a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th>Nama User</th>
														<th>Pekerjaan</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = mysqli_query($conn, "SELECT * FROM user");
													$i = 0;
													while ($row = mysqli_fetch_array($sql)) {
														$i++;
													?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo ucwords($row['nama_pegawai']); ?></td>
															<td><?php 
															if ($row['pekerjaan'] == '1') {
																	echo '<div class="badge badge-pill badge-dark mb-1">Admin';
																} 
															if ($row['pekerjaan'] == '2') {
																echo '<div class="badge badge-pill badge-danger mb-1">Dokter';
															}
															if ($row['pekerjaan'] == '3') {
																	echo '<div class="badge badge-pill badge-primary mb-1">Perawat';
																} 
															if ($row['pekerjaan'] == '4') {
																echo '<div class="badge badge-pill badge-success mb-1">Apoteker';
															}  
																?>
										</div>
										</td>
										<td>
											<span data-target="#editUser" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_pegawai']; ?>" data-user="<?php echo $row['username']; ?>">
												<a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i class="fas fa-pencil-alt"></i></a>
											</span>
											<a class="btn btn-danger btn-action" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=user&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
										</td>
										</tr>
									<?php } ?>
									</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			</section>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="addUser">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Tambah Pegawai</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="needs-validation" novalidate="">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="nama" required="">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="username" required="">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Pekerjaan</label>
								<select class="form-control selectric" name="pekerjaan">
									<option value="1">Admin</option>
									<option value="2">Dokter</option>
									<option value="3">Perawat</option>
									<option value="4">Apoteker</option>
								</select>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-9">
									<input type="password" name="password" class="form-control">
								</div>
							</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" id="editUser">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Data</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="" method="POST" class="needs-validation" novalidate="">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" name="iduser" required="" id="getId">
									<input type="text" class="form-control" name="nama" required="" id="getNama">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Username</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="username" required="" id="getUser">
									<div class="invalid-feedback">
										Mohon data diisi!
									</div>
								</div>
							</div>
							<div class="alert alert-light text-center">
								Jika password tidak diganti, form dibawah dikosongi saja.
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Lama</label>
								<div class="col-sm-9">
									<input type="password" name="old_password" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Baru</label>
								<div class="col-sm-9">
									<input type="password" name="new_password" class="form-control">
								</div>
							</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit">Edit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include 'template/footer.php'; ?>
	</div>
	</div>
	<?php include "template/all-js.php"; ?>

	<script>
		$('#editUser').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var nama = button.data('nama')
			var user = button.data('user')
			var alam = button.data('alam')
			var id = button.data('id')
			var modal = $(this)
			modal.find('#getId').val(id)
			modal.find('#getNama').val(nama)
			modal.find('#getUser').val(user)
			modal.find('#getAddrs').val(alam)
		})
	</script>
</body>

</html>