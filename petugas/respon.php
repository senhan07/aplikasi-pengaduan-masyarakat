<table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Judul</th>
				<th>Petugas</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Ditanggapi</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas ORDER BY tanggapan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['judul']; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn blue modal-trigger" href="#more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">More</a> </td>
		

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
            	<p>Petugas : <?php echo $r['nama_petugas']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php if($r['foto']=="kosong"){ ?>
					<img src="../img/noImage.png" width="100">
				<?php } else { ?>
					<a href="../img/<?php echo $r['foto']; ?>" target="_blank">
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
					</a>
				<?php } ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<?php 
					// Decode JSON strings for tanggapan and bukti
					$tanggapanData = json_decode($r['tanggapan'], true);
					$buktiData = json_decode($r['bukti'], true);

					// Loop through tanggapan and bukti arrays and display them alternately
					$numTanggapan = count($tanggapanData);
					$numBukti = count($buktiData);
					$maxIterations = max($numTanggapan, $numBukti);
					for($i = 0; $i < $maxIterations; $i++) {
					$tanggapan = isset($tanggapanData[$i]) ? $tanggapanData[$i] : '';
					$bukti = isset($buktiData[$i]) ? $buktiData[$i]['nama'] : '';
					echo "<br><b>Tanggapan " . ($i + 1) . "</b><br>";
					echo "<br>";
					echo "<p>$tanggapan</p>";
					echo "<br><b>Bukti " . ($i + 1) . "</b><br>";
					echo "<a href='../img/$bukti' target='_blank'><img width='100' src='../img/$bukti'></a>";
					}
				?>
				 <!-- Feedback Section -->
				 <br><b>Penilaian</b>
				<p>
					<?php 
					// Assuming $r['penilaian'] contains the feedback fetched from the database
					echo $r['penilaian'] === "happy" ? "😊 Puas" : ($r['penilaian'] === "sad" ? "😞 Tidak Puas" : "No Feedback");
					?>
				</p>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        