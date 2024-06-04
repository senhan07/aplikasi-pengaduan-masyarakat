<?php session_start(); ?>
<?php
    include('conn/koneksi.php');

    if(isset($_POST["register"])){
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

                $result = mysqli_query($koneksi, "INSERT INTO masyarakat (nik, email, nama, username, password, telp, verif, tempat_lahir, tanggal_lahir, agama, jk) VALUES ('$nik', '$email', '$nama', '$username', '$password_hash', '$telp', 0, '$tempat_lahir', '$tanggal_lahir', '$agama', '$jk')");
    
                if($result){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='lynxlime2@gmail.com';
                    $mail->Password='hysn yktp sidh shwd';
    
                    $mail->setFrom('lynxlime2@gmail.com', 'lynxlime2@gmail.com');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Kode Verifikasi Akun Pelaporan Anda";
                    $mail->Body="<p>Kepada $nama, </p>
                    <h3>Kode verifikasi akun anda adalah $otp <br></h3>
                    <br><br>
                    <p>Hormat kami</p>
                    <b>Pengurus RT 5 Kupang Praupan 1</b>";
    
                    if(!$mail->send()){
                        echo "<script>alert('Alamat Email Tidak Valid!')</script>";
                    }else{
                        ?>
                        <script>
                            window.location.replace('verifikasi_daftar.php');
                        </script>
                        <?php
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Halaman Daftar</title>
    <link rel="stylesheet" href="css/daftar.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="icon" href="../image/register.png">
    <style>
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

/* Target the radio button labels */
label[for^="jk"] {
  width: auto; /* Adjust width as needed */
  padding: 5px 10px; /* Adjust padding for spacing */
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-family: inherit;
  font-size: 16px;
  cursor: pointer; /* Indicate clickable element */
  display: flex;
  align-items: center; /* Align radio button and label vertically */
  margin-right: 10px; /* Spacing between labels */
}

/* Target the radio button itself */
input[type="radio"] {
  margin-right: 5px; /* Spacing between radio button and label text */
  width: 15px; /* Adjust width for desired size */
  height: 15px; /* Adjust height for desired size */
  margin-right: 5px; /* Adjust spacing if needed */
}

/* Style for the checked radio button label (optional) */
input[type="radio"]:checked + label[for^="jk"] {
  background-color: #77bef8; /* Same color as agama dropdown */
  border-color: #77bef8; /* Adjust border color if needed */
}
</style>
</head>

<body style="background: #0b111e">
    <div class="box" style="height: 1150px">
        <div class="form">
            <form action="#" method="POST" onsubmit="return verifyPassword()">
                <h2>Daftar Masyarakat</h2>
                    <div class="inputBox">
                        <input type="number" id="nik"  name="nik" required="required" minlength="16" maxlength="16" title="Masukkan 16 nomor NIK anda" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> NIK</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="name" id="name"  name="name" required="required" maxlength="32" title="Masukkan maksimal 32 karakter" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Nama Lengkap</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="name" id="username"  name="username" required="required" maxlength="32" title="Masukkan maksimal 32 karakter" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Nama Pengguna</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" id="email_address" name="email" required="required" title="Masukkan alamat email yang valid" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Alamat Email</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password"  name="password" required="required"  title="Masukkan minimal 8 karakter" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Kata Sandi</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="cpassword"  name="cpassword" required="required" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Konfirmasi Kata Sandi</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="number" id="telp"  name="telp" required="required" minlength="10" maxlength="13" title="Masukkan minimal 10 nomor" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Nomor Telepon</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" id="tempat_lahir"  name="tempat_lahir" required="required" title="Masukkan minimal 10 nomor" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Tempat Lahir</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="date" id="tanggal_lahir"  name="tanggal_lahir" required="required" title="Masukkan minimal 10 nomor" autocomplete="off">
                        <span><i class="text-danger"><sup><span style="color:red">(*)</span></sup></i> Tanggal Lahir</span>
                        <i></i>
                    </div>

                    <div class="inputBox">
                        <!-- <span>Agama</span>
                        <i></i> -->
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

                    <div class="inputBox">
                        <div style="display: flex; align-items: center;">
                        <label for="laki-laki" style="margin-right: 10px; color: white;">Laki-Laki</label>
                            <input type="radio" id="laki-laki" name="jk" value="Laki-laki" required>
                            <div style="flex: 1;"></div>
                            <label for="perempuan" style="margin-right: 10px; color: white;">Perempuan</label>
                            <input type="radio" id="perempuan" name="jk" value="Perempuan" required style="margin-left: 5px;">
                        </div>
                    </div>


                    <br>
                        <input type="submit" value="Daftar" name="register">
                        <br>
                        <br>
                    <div class="links">
                        <p>Sudah mempunyai akun? </p>
                        <br>  
                        <a align="center" href="cek.php">Masuk disini</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
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
</script>
