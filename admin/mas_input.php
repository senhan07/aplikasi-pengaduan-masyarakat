<?php session_start(); ?>
<?php 

include('../conn/koneksi.php');

	// if(isset($_POST['input'])){
	// 	$password = md5($_POST['password']);

	// 	$query=mysqli_query($koneksi,"INSERT INTO masyarakat (nik, email, nama, username, password, telp, verif, tempat_lahir, tanggal_lahir, agama, jk) VALUES ('$nik', '$email', '$nama', '$username', '$password', '$telp', 1, '$tempat_lahir', '$tanggal_lahir', '$agama', '$jk')");
	// 	if($query){
	// 		echo "<script>alert('Data Ditambahkan')</script>";
	// 		echo "<script>location='index.php?p=mas'</script>";
	// 		echo "<script>location.reload()</script>";
	// 	}
	// }

    if(isset($_POST["simpan"])){
        $nik = $_POST["nik"];
        $email = $_POST["email"];
        $nama = $_POST["name"];
        $username = $_POST["username"];
        $telp = $_POST["telp"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        $tempat_lahir = $_POST["tempat_lahir"];
        $tanggal_lahir = $_POST["tanggal_lahir"];
        $agama = $_POST["agama"];
        $jk = $_POST["jk"];

        $check_query = mysqli_query($koneksi, "SELECT * FROM masyarakat where email ='$email' OR username ='$username' OR nik ='$nik'");
        $rowCount = mysqli_num_rows($check_query);

        if(!empty($nik) && !empty($email) && !empty($nama) && !empty($username) && !empty($password) && !empty($cpassword) && !empty($telp)){
            if($password !== $cpassword){
                echo "<script>alert('Password Tidak Sama!')</script>";
            }
            elseif(strlen($telp) < 10 || strlen($telp) > 13){
                echo "<script>alert('Nomor telepon tidak boleh lebih dari 13 atau kurang dari 10!')</script>";
            }
            elseif(strlen($nik) !== 16){
                echo "<script>alert('Nomor NIK harus 16 angka!')</script>";
            }
            elseif($rowCount > 0){
                    echo "<script>alert('Akun dengan email, username, atau NIK tersebut sudah ada')</script>";
                }else{
                $password_hash = md5($_POST['password']);

                $result = mysqli_query($koneksi, "INSERT INTO masyarakat (nik, email, nama, username, password, telp, verif, tempat_lahir, tanggal_lahir, agama, jk) VALUES ('$nik', '$email', '$nama', '$username', '$password_hash', '$telp', 1, '$tempat_lahir', '$tanggal_lahir', '$agama', '$jk')");

            }
        }
    }
?>

<link rel="stylesheet" href="../css/daftar.css">
<style>
	.container {
			margin-top: 800px;
	}

	.home-section {
		height: 135vh;
	}

	table {
			width: 100%;
			border-collapse: collapse;
	}

	td {
			padding: 10px;
			vertical-align: bottom;
	}

	.column {
			flex: 1;
			margin-right: 20px; /* Adjust the spacing between columns */
	}

	.input-box {
			margin-bottom: 20px; /* Adjust the spacing between input boxes */
	}

	.row {
			display: flex;
			flex-wrap: wrap;
	}

	.input-box label {
			display: block;
			margin-bottom: 5px;
	}

	select#agama {
		width: 100%;
		height: 30px;
		padding: 5px;
		border: 1px solid #ccc; /* Maintain border for better visibility */
		border-radius: 4px;
		box-sizing: border-box;
		font-family: inherit;
		font-size: 16px;
		background-color: #77bef8;  /* New background color */
	}


</style>

<section class="container">
		<form method="POST" onsubmit="return verifyPassword()">
				<table>
						<tr>
								<td>
										<div class="input-box">
												<label for="nik">NIK</label>
												<input id="nik" type="number" name="nik" required />
										</div>
								</td>
								<td>
								<div class="inputBox">
										<label for="jk">Jenis Kelamin</label>
										<select id="jk" name="jk" required>
												<option value="" disabled selected>Pilih Jenis Kelamin</option>
												<option value="laki-laki">Laki-Laki</option>
												<option value="perempuan">Perempuan</option>
										</select>
								</div>
								</td>
						</tr>
						<tr>
								<td>
									<div class="input-box">
											<label for="nama">Nama Lengkap</label>
											<input id="nama" type="text" name="nama" required />
									</div>
								</td>
								<td>
									<div class="input-box">
											<label for="telp">Nomor Telepon</label>
											<input id="telp" type="number" name="telp" required />
									</div>
								</td>
						</tr>
						<tr>
								<td>
									<div class="input-box">
											<label for="alamat">Alamat</label>
											<input id="alamat" type="text" name="alamat" required />
									</div>
								</td>
								<td>
									<div class="input-box">
											<label for="email">Alamat Email</label>
											<input id="email" type="text" name="email" required />
									</div>
								</td>
						</tr>
						<tr>
								<td>

								<div class="input-box">
										<label for="tempat_lahir">Tempat Lahir</label>
										<input id="tempat_lahir" type="text" name="tempat_lahir" required />
								</div>
								</td>
								<td>
								<div class="input-box">
										<label for="username">Nama Pengguna</label>
										<input id="username" type="text" name="username" required />
								</div>
								</td>
						</tr>
						<tr>
								<td>
									<div class="input-box">
											<label for="tanggal_lahir">Tanggal Lahir</label>
											<input id="tanggal_lahir" type="date" name="tanggal_lahir" required />
									</div>
								</td>
								<td>
									<div class="input-box">
											<label for="password">Kata Sandi</label>
											<input id="password" type="password" name="password" pattern={6} required />
									</div>
									<div class="inputBox">
										<label for="password">Konfirmasi Kata Sandi</label>
										<input type="password" id="cpassword"  name="cpassword" required="required" autocomplete="off">
										<i></i>
									</div>
								</td>
						</tr>
						<tr>
								<td>
								<div class="inputBox">
										<label for="agama">Agama</label>
										<select id="agama" name="agama" required>
												<option value="" disabled selected>Pilih Agama</option>
												<option value="budha">Buddha</option>
												<option value="kristen">Kristen</option>
												<option value="katolik">Katolik</option>
												<option value="islam">Islam</option>
												<option value="hindu">Hindu</option>
												<option value="khonghucu">Khonghucu</option>
										</select>
								</div>
								</td>
								<td>
								<input type="submit" name="input" value="simpan">
								</td>
						</tr>
						
						<!-- Add more rows for other fields -->
				</table>

		</form>
</section>

<!-- <script>
    function validateEmail($email) {
        $re = '/\S+@\S+\.\S+/';
        return preg_match($re,$email);
    }
    function validateNIK($nik) {
        $re = '/^\d{16}$/';
        return preg_match($re, $nik);
    }
    funcion validatePhoneNumber($telp) {
        $re = '/^\d{10,13}$/';
        return preg_match($re, $telp);
    }
</script> -->

