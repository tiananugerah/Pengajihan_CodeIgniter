<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('konfirmasi/kirim'),'kirim Semua', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('konfirmasi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('konfirmasi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gaji Pokok</th>
                <th>Konfirmasi</th>
                <th>Kirim</th>
                <th>Action</th>
            </tr><?php
            if ($konfirmasi_data->num_rows() > 0) {
            foreach ($konfirmasi_data->result() as $konfirmasi)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $konfirmasi->konfirmasi ?></td>
            <td><?php echo $konfirmasi->gapok ?></td>
            <td><?php echo $konfirmasi->tukel ?></td>
            <td><?php echo $konfirmasi->tukes ?></td>
            <td><?php echo $konfirmasi->tutra ?></td>
            <td><?php echo $konfirmasi->tupen ?></td>
            <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('konfirmasi/update/'.$konfirmasi->id_konfirmasi),'Update'); 
                echo ' | '; 
                echo anchor(site_url('konfirmasi/delete/'.$konfirmasi->id_konfirmasi),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                ?>
            </td>
        </tr>
                <?php
            }
            } else {
                ?>
                <tr>
                    <th colspan="8"><center>DATA TIDAK DI TEMUKAN</center></th>
                </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>