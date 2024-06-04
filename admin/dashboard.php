<div class="d-flex justify-content-center align-items-center" style="height: 0vh;margin-left: 50vh;">
    <div class="col-sm-6 text-center">
        <h3 style="color: white;">Dashboard Ketua RT</h3>
        <p style="color: white;" class="text-center">Data Pengajuan</p>
        <table class="table table-bordered table-hover" style="margin: 0 auto;">
            <!-- <tr style="background-color: #d1e7dd;">
                <td colspan="2" class="text-center"><strong>Data Pengajuan</strong></td>
            </tr> -->
            <tr style="background-color: #f8d7da;">
                <?php 
                    $query = mysqli_query($koneksi,"SELECT * FROM pengaduan");
                    $jlmmember = mysqli_num_rows($query);
                    if($jlmmember < 1){
                        $jlmmember = 0;
                    }
                ?>
                <td>Laporan Masuk</td>
                <td align="center"><?php echo $jlmmember; ?></td>
            </tr>
            <tr style="background-color: #d4edda;">
                <?php 
                    $query = mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE status='selesai'");
                    $jlmmember = mysqli_num_rows($query);
                    if($jlmmember < 1){
                        $jlmmember = 0;
                    }
                ?>
                <td>Laporan Selesai</td>
                <td align="center"><?php echo $jlmmember; ?></td>
            </tr>
        </table>
    </div>
</div>
