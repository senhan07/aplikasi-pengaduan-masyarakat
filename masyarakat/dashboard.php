<table id="example" class="display responsive-table" border="2" style="width: 100%;">
			<thead>
              <tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Judul Laporan</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE pengaduan.nik='".$_SESSION['data']['nik']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nik']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['judul']; ?></td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">DETAIL</a> 

<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="orange-text">Detail</h4>
            <div class="col s12">
				<p>NIK : <?php echo $r['nik']; ?></p>
            	<p>Dari : <?php echo $r['nama']; ?></p>
				<p>Judul : <?php echo $r['judul']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_pengaduan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
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
				<div id="feedback-section" class="col s12">
					<button class="btn-flat" id="happy-button" onclick="sendFeedback('<?php echo $r['id_pengaduan']; ?>', 'happy')">😊 Puas</button>
					<button class="btn-flat" id="sad-button" onclick="sendFeedback('<?php echo $r['id_pengaduan']; ?>', 'sad')">😞 Tidak Puas</button>
				</div>
			</div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
		</td>
	</tr>
</table>

<script>
function sendFeedback(id_pengaduan, feedback) {
  console.log("id_pengaduan:", id_pengaduan);
  console.log("Feedback:", feedback);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "update_feedback.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert("Feedback sent successfully!");
    }
  };
  
  xhr.send("id_pengaduan=" + id_pengaduan + "&feedback=" + feedback);
}
</script>
