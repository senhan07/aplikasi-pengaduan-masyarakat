<?php 
session_start();
include '../conn/koneksi.php';

// Proses pengiriman kritik dan saran
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nama = $_SESSION['data']['nama'];
    $kritik_saran = $_POST['kritik_saran'];
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO kritik_saran (nama, kritik_saran, tanggal) VALUES ('$nama', '$kritik_saran', '$tanggal')";
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Kritik dan Saran berhasil dikirim.');window.location='index.php?p=kritik_saran';</script>";
    } else {
        echo "<script>alert('Gagal mengirim Kritik dan Saran.');window.location='index.php?p=kritik_saran';</script>";
    }
}

// Ambil data kritik dan saran
$nama = $_SESSION['data']['nama'];
$query = "SELECT * FROM kritik_saran WHERE nama = '$nama'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Komentar terhadap penyelesaian pengaduan</title>
    <style>
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
            margin-top: 700px; /* Ubah nilai ini untuk mengatur jarak dari atas */
            /* padding: 20px;
            max-width: 1000px;
            width: 100%;
            background-color: #444;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); */
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
    </style>
</head>
<body>
    <div class="container">
        <h3>Komentar terhadap penyelesaian pengaduan</h3>
        <form method="POST" action="">
            <div class="input-field">
                <textarea id="kritik_saran" name="kritik_saran" class="materialize-textarea" required></textarea>
                <label for="kritik_saran" style="color: white;">Tuliskan Komentar Anda terhadap pelayanan penyelesaian pengaduan</label>
            </div>
            <button type="submit" class="btn waves-effect waves-light">Kirim</button>
        </form>

        <h4>Komentar yang Sudah Diajukan</h4>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Komentar</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                    <td><?php echo htmlspecialchars($row['kritik_saran']); ?></td>
                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
