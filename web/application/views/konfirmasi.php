        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Konfirmasi</th>
                <th>Status Gaji</th>
            </tr>
                <?php
                    foreach ($rw->result() as $gaji)
                    {
                ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td><?php echo $gaji->tgl; ?></td>
                <td>
                    <?php 
                        if ( $gaji->konfirmasi != NULL) {
                            echo "Sudah DiKonfirmasi";
                        } else {
                            echo anchor(site_url('app/update_konfirmasi/'.$gaji->nik.'/'.$gaji->id_karyawan.'/'.$gaji->tgl.'/1'),'Benar');
                            echo ' | '; 
                            echo anchor(site_url('app/update_konfirmasi/'.$gaji->nik.'/'.$gaji->id_karyawan.'/'.$gaji->tgl.'/0'),'Tidak'); 
                        }
                    ?>
                </td>
                <td>       
                    <?php 
                        if ( $gaji->kirim == "0") {
                            echo "Belum Terkirim";
                        } else {
                            echo "Terkirim";
                        }
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>