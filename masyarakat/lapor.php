<?php 

    include('../conn/koneksi.php');

        $tgl = date('Y-m-d');
		$no=1;
		$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik");
		 { ?>

<link rel="stylesheet" href="../css/daftar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
	.input-box {
		color: #fff;
		font-size: 18px;
	}
	.input-box input,
	.input-box textarea {
		font-size: 16px;
	}
	input[type="submit"] {
		font-size: 16px;
	}

	body {
            color: white;
            background-color: #0b111e;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            margin-top: 500px; /* Ubah nilai ini untuk mengatur jarak dari atas */
            padding: 20px;
            /* max-width: 1000px; */
            width: 60vw;
            background-color: #444;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        label {
            color: white;
        }

        table {
            background: white;
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            color: black;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        h3, h4 {
            color: white;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .input-field {
            margin-bottom: 20px;
        }

        textarea.materialize-textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            resize: vertical;
        }

        /* Style for file input */
        .file-input-wrapper {
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            font-size: 16px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            color: white;
            background-color: #555;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

		.icon-with-text {
        display: flex;
        align-items: center;
		font-size: 1.5em;
    }

    .icon-with-text i {
        margin-right: 15px; /* Adjust the margin as needed */
        font-size: 1em; /* Adjust the icon size as needed */
    }
</style>

    <section class="container">
        <form method="POST" enctype="multipart/form-data">
		<div class="icon-with-text">
    <i class="fa-solid fa-circle-plus"></i>
    <span>Buat Laporan</span>
</div>
          <div class="input-box" style="color: #fff;">
            <label for="nik">NIK</label>
            <br><?php echo ucwords($_SESSION['data']['nik']); ?>
          </div>

        <div class="input-box" style="color: #fff;">
          <label for="nama">Nama</label>
          <br><?php echo ucwords($_SESSION['data']['nama']); ?>
        </div>

        <div class="input-box" style="color: #fff;">
          <label for="tgl">Tanggal Pengaduan</label>
          <br><?php echo $tgl; ?>
        </div>
		
		<div class="input-box" style="color: #fff;">
          <label for="judul">Judul Laporan</label>
          <br><input type="textarea" name="judul">
        </div>

        <div class="input-box" style="color: #fff;">
    	  <label for="laporan">Tulis Laporan</label>
          <br>
    	  <textarea name="laporan" rows="5" cols="50" style="background-color: #ffffff; resize: none;"></textarea>
		</div>


		<div class="input-box">
                <label for="foto">Gambar</label>
                <div class="file-input-wrapper">
                    <input type="file" name="foto" required="required">
                </div>
                <label for="foto" style="color:orange;">*) Hanya bisa file dengan ekstensi JPG, JPEG, PNG dan maksimal ukuran 5MB</label>
                <br><br>
            </div>

        <input type="submit" name="kirim" value="Kirim" style="width:-webkit-fill-available">
      </form>
    </section>

    <?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['nik'];
		
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=5000000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['judul']."','".$_POST['laporan']."','$nama','proses', 'Rendah', NULL)");

		 			if($query){
			 			echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php?p=pengaduan';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Akuran Gambar Tidak Lebih Dari 100KB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nik','".$_POST['judul']."','".$_POST['laporan']."','noImage.png','proses', 'Rendah', NULL)");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php?p=pengaduan';</script>";
 			}
		}
	}
}
?>