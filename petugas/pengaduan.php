<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Set font color for all options */
        .select-dropdown.dropdown-content li span {
            color: black;
        }

        /* Set font color for the selected option */
        .select-dropdown.dropdown-content li.selected span,
        .select-dropdown.dropdown-trigger {
            color: black !important; /* Override MaterializeCSS default styles */
        }
    </style>
</head>
<body>
    <table id="example" class="display responsive-table" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Judul Laporan</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik = masyarakat.nik ORDER BY pengaduan.id_pengaduan DESC");
                while ($r = mysqli_fetch_assoc($query)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $r['nik']; ?></td>
                    <td><?php echo $r['nama']; ?></td>
                    <td><?php echo $r['judul']; ?></td>
                    <td><?php echo $r['tgl_pengaduan']; ?></td>
                    <td><?php echo $r['status']; ?></td>
                    <td>
                        <select class="filter_status" id="prioritas" data-id-pengaduan="<?php echo $r['id_pengaduan']; ?>">
                            <option value="Tinggi" <?php if($r['prioritas'] == 'Tinggi') echo 'selected style="color: black;"'; ?>>Tinggi</option>
                            <option value="Rendah" <?php if($r['prioritas'] == 'Rendah') echo 'selected style="color: black;"'; ?>>Rendah</option>
                        </select>
                    </td>
                    <td>
                        <a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan']; ?>">Tanggapi</a>
                        <a class="btn modal-trigger red" href="#tolak?id_pengaduan=<?php echo $r['id_pengaduan']; ?>">Tolak</a>
                    </td>

                    <!-- Modal Structure for Tanggapi -->
                    <div id="more?id_pengaduan=<?php echo $r['id_pengaduan']; ?>" class="modal">
                        <div class="modal-content">
                            <h4 class="orange-text">Detail</h4>
                            <div class="col s12 m6">
                                <p>NIK: <?php echo $r['nik']; ?></p>
                                <p>Dari: <?php echo $r['nama']; ?></p>
                                <p>Judul Laporan: <?php echo $r['judul']; ?></p>
                                <p>Tanggal Masuk: <?php echo $r['tgl_pengaduan']; ?></p>
                                <?php if($r['foto'] == "kosong"){ ?>
                                    <img src="../img/noImage.png" width="100">
                                <?php } else { ?>
                                    <img width="100" src="../img/<?php echo $r['foto']; ?>">
                                <?php } ?>
                                <br><b>Pesan</b>
                                <p><?php echo $r['isi_laporan']; ?></p>
                                <p>Status: <?php echo $r['status']; ?></p>
                            </div>
                            <?php if($r['status'] == "proses"){ ?>
                            <div class="col s12 m6" style="margin-bottom: 50px">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col s12 input-field">
                                        <label for="textarea">Tanggapan</label>
                                        <textarea id="textarea" name="tanggapan" style="color: #000;" class="materialize-textarea"></textarea>
                                    </div>
                                    <div class="input-box">
                                        <label for="bukti">Bukti</label>
                                        <input type="file" required="required" style="color: #000;" name="bukti">
                                        <label for="foto" style="color:red;">*) Hanya bisa file dengan ekstensi JPG, JPEG, PNG dan maksimal ukuran 5MB</label>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input type="submit" name="tambahTanggapi" value="Tambah Tanggapan" class="btn right">
                                        <input type="submit" name="tanggapi" value="Kirim" class="btn right" style="margin: 0px 10px 0px 10px">
                                        <!-- <div class="modal-footer col s12"> -->
                                        <a href="#!" class="modal-close btn right red">Kembali</a>
                                    </div>
                                </form>
                            </div>
                            <?php } ?>

                            <?php 
                                if(isset($_POST['tanggapi'])){
                                    $tgl = date('Y-m-d');
                                    $tanggapan = $_POST['tanggapan']; // Get the response message directly, no need to encode it again
                                    $bukti = $_FILES['bukti']['name'];
                                    $folder = './../img/';
                                    $listeks = array('jpg','png','jpeg');
                                    $pecah = explode('.', $bukti);
                                    $eks = $pecah['1'];
                                    $size = $_FILES['bukti']['size'];
                                    $namabukti = date('dmYis').$bukti;
                                    $namabukti_json = json_encode(array('nama' => $namabukti));
                                
                                    if($bukti != ""){
                                        if(in_array($eks, $listeks)){
                                            if($size <= 5000000){
                                                move_uploaded_file($_FILES['bukti']['tmp_name'], $folder.$namabukti);
                                
                                                // Check if there are existing responses
                                                $query = mysqli_query($koneksi, "SELECT tanggapan, bukti FROM tanggapan WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                $row = mysqli_fetch_assoc($query);
                                                if($row){
                                                    // If there are existing responses, append the new response data to the existing JSON data
                                                    $existingTanggapan = json_decode($row['tanggapan'], true);
                                                    $existingTanggapan[] = $tanggapan; // Append the new response message
                                                    $existingBukti = json_decode($row['bukti'], true);
                                                    $existingBukti[] = array('nama' => $namabukti); // Append the new response attachment
                                                    $newTanggapan = json_encode($existingTanggapan);
                                                    $newNamabuktiJson = json_encode($existingBukti);
                                
                                                    // Update the database with the new JSON data
                                                    $update = mysqli_query($koneksi, "UPDATE tanggapan SET tanggapan='$newTanggapan', bukti='$newNamabuktiJson' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                } else {
                                                    // If there are no existing responses, insert the new response data normally
                                                    $newTanggapan = json_encode(array($tanggapan));
                                                    $newNamabuktiJson = json_encode(array(array('nama' => $namabukti)));
                                                    $insert = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '".$r['id_pengaduan']."', '".$tgl."', '$newTanggapan', '$newNamabuktiJson', '".$_SESSION['data']['id_petugas']."')");
                                                }
                                
                                                if($update || $insert){
                                                    $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                    echo "<script>alert('Tanggapan Terkirim')</script>";
                                                    echo "<script>location='index.php?p=pengaduan';</script>";
                                                }
                                            } else {
                                                echo "<script>alert('Ukuran Gambar Tidak Lebih Dari 100KB')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('Format File Tidak Di Dukung')</script>";
                                        }
                                    } else {
                                        // Handle case where no attachment is provided
                                    }
                                }
                                
                                
                                //! TAMBAH TERUS TERUSSAN !!!
                                if(isset($_POST['tambahTanggapi'])){
                                    $tgl = date('Y-m-d');
                                    $tanggapan = $_POST['tanggapan']; // Get the response message directly, no need to encode it again
                                    $newBukti = $_FILES['bukti']['name'];
                                    $folder = './../img/';
                                    $listeks = array('jpg','png','jpeg');
                                    $pecah = explode('.', $newBukti);
                                    $eks = $pecah['1'];
                                    $size = $_FILES['bukti']['size'];
                                    $namabukti = date('dmYis').$newBukti;
                                    $namabukti_json = json_encode(array('nama' => $namabukti));
                                
                                    if($newBukti != ""){
                                        if(in_array($eks, $listeks)){
                                            if($size <= 1000000){
                                                move_uploaded_file($_FILES['bukti']['tmp_name'], $folder.$namabukti);
                                
                                                // Check if there are existing responses
                                                $query = mysqli_query($koneksi, "SELECT tanggapan, bukti FROM tanggapan WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                $row = mysqli_fetch_assoc($query);
                                                if($row){
                                                    // If there are existing responses, append the new response data to the existing JSON data
                                                    $existingTanggapan = json_decode($row['tanggapan'], true);
                                                    $existingTanggapan[] = $tanggapan; // Append the new response message
                                                    $existingBukti = json_decode($row['bukti'], true);
                                                    $existingBukti[] = array('nama' => $namabukti); // Append the new response attachment
                                                    $newTanggapan = json_encode($existingTanggapan);
                                                    $newNamabuktiJson = json_encode($existingBukti);
                                
                                                    // Update the database with the new JSON data
                                                    $insert = mysqli_query($koneksi, "UPDATE tanggapan SET tanggapan='$newTanggapan', bukti='$newNamabuktiJson' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                } else {
                                                    // If there are no existing responses, insert the new response data normally
                                                    $newTanggapan = json_encode(array($tanggapan));
                                                    $newNamabuktiJson = json_encode(array(array('nama' => $namabukti)));
                                                    $insert = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '".$r['id_pengaduan']."', '".$tgl."', '$newTanggapan', '$newNamabuktiJson', '".$_SESSION['data']['id_petugas']."')");
                                                }
                                
                                                if($update || $insert){
                                                    echo "<script>alert('Tanggapan Terkirim')</script>";
                                                    echo "<script>location='index.php?p=pengaduan';</script>";
                                                }
                                            } else {
                                                echo "<script>alert('Ukuran Gambar Tidak Lebih Dari 100KB')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('Format File Tidak Di Dukung')</script>";
                                        }
                                    } else {
                                        // Handle case where no attachment is provided
                                    }
                                }
                                
                            ?>
                        </div>

                    </div>

                    <!-- Modal Structure for Tolak -->
                    <div id="tolak?id_pengaduan=<?php echo $r['id_pengaduan']; ?>" class="modal">
                        <div class="modal-content">
                            <h4 class="orange-text">Detail</h4>
                            <div class="col s12 m6">
                                <p>NIK: <?php echo $r['nik']; ?></p>
                                <p>Dari: <?php echo $r['nama']; ?></p>
                                <p>Judul Laporan: <?php echo $r['judul']; ?></p>
                                <p>Tanggal Masuk: <?php echo $r['tgl_pengaduan']; ?></p>
                                <?php if($r['foto'] == "kosong"){ ?>
                                    <img src="../img/noImage.png" width="100">
                                <?php } else { ?>
                                    <img width="100" src="../img/<?php echo $r['foto']; ?>">
                                <?php } ?>
                                <br><b>Pesan</b>
                                <p><?php echo $r['isi_laporan']; ?></p>
                                <p>Status: <?php echo $r['status']; ?></p>
                            </div>
                            <?php if($r['status'] == "proses"){ ?>
                            <div class="col s12 m6">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col s12 input-field">
                                        <label for="textarea">Tanggapan</label>
                                        <textarea id="textarea" name="tanggapan" style="color: #000;" class="materialize-textarea"></textarea>
                                    </div>
                                    <div class="input-box">
                                        <label for="bukti">Bukti</label>
                                        <input type="file" style="color: #000;" name="bukti">
                                    </div>
                                    <div class="col s12 input-field">
                                        <input type="submit" name="tolak" value="Kirim" class="btn right">
                                    </div>
                                </form>
                            </div>
                            <?php } ?>

                            <?php 
                                if(isset($_POST['tolak'])){
                                    $tgl = date('Y-m-d');
                                    $bukti = $_FILES['bukti']['name'];
                                    $source = $_FILES['bukti']['tmp_name'];
                                    $folder = './../img/';
                                    $listeks = array('jpg','png','jpeg');
                                    $pecah = explode('.', $bukti);
                                    $eks = $pecah['1'];
                                    $size = $_FILES['bukti']['size'];
                                    $namabukti = date('dmYis').$bukti;

                                    if($bukti != ""){
                                        if(in_array($eks, $listeks)){
                                            if($size <= 100000){
                                                move_uploaded_file($source, $folder.$namabukti);
                                                $query = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '".$r['id_pengaduan']."', '".$tgl."', '".$_POST['tanggapan']."', '$namabukti', '".$_SESSION['data']['id_petugas']."')");

                                                if($query){
                                                    $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='ditolak' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                                    if($update){
                                                        echo "<script>alert('Tanggapan Terkirim')</script>";
                                                        echo "<script>location='index.php?p=pengaduan';</script>";
                                                    }
                                                }
                                            } else {
                                                echo "<script>alert('Ukuran Gambar Tidak Lebih Dari 100KB')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('Format File Tidak Di Dukung')</script>";
                                        }
                                    } else {
                                        $query = mysqli_query($koneksi, "INSERT INTO tanggapan VALUES (NULL, '".$r['id_pengaduan']."', '".$tgl."', '".$_POST['tanggapan']."', 'noImage.png', '".$_SESSION['data']['id_petugas']."')");
                                        if($query){
                                            $update = mysqli_query($koneksi, "UPDATE pengaduan SET status='ditolak' WHERE id_pengaduan='".$r['id_pengaduan']."'");
                                            if($update){
                                                echo "<script>alert('Tanggapan Terkirim')</script>";
                                                echo "<script>location='index.php?p=pengaduan';</script>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="modal-footer col s12">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>
                    </div>
                </tr>
            <?php } ?>
        </tbody>
    </table>        

    <script>
        $(document).ready(function() {
            $('.select-dropdown').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var selectedText = selectedOption.text();
                var selectedColor = selectedOption.data('color'); // Assuming you store the color in a data attribute
                $(this).css('color', selectedColor);
            });

            $('.filter_status').change(function() {
                var id_pengaduan = $(this).data('id-pengaduan');
                var priority = $(this).val();
                
                $.ajax({
                    url: 'update_priority.php',
                    method: 'POST',
                    data: { id_pengaduan: id_pengaduan, priority: priority },
                    success: function(response) {
                        console.log(response);
                        // Reload the page after a successful update
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating priority: ' + error);
                    }
                });
            });

            // Initialize all modals
            $('.modal').modal();
        });
    </script>
</body>
</html>