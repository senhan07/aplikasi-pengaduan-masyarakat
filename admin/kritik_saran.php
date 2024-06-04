<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../conn/koneksi.php';
if(!isset($_SESSION['username'])){
  header('location:../index.php');
} elseif($_SESSION['data']['level'] != "admin"){
  header('location:../index.php');
}

$query = "SELECT * FROM kritik_saran";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Komentar terhadap pelayanan pengaduan</title>
    <!-- Tambahkan elemen head lainnya di sini -->
    <style>
        /* CSS untuk memberikan warna putih pada font */
        body {
            color: white;
        }

        /* CSS untuk memberikan warna putih pada label */
        label {
            color: white;
        }
        td {
            color: black;
        }
    </style>
</head>
<body>
  <div class="container" style="margin-top:100px">
    <h3>Komentar terhadap pelayanan pengaduan</h3>
    <table id="example" class="display">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama</th>
          <th>Komentar</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?php echo $row['id_kritiksaran']; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['kritik_saran']; ?></td>
          <td><?php echo $row['tanggal']; ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
