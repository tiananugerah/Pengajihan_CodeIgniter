<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('konfirmasi/create'),'Kirim Semua', 'class="btn btn-primary"'); ?>
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
                <td>Nik</td>
                <td>Tanggal</td>
                <th>Gajih Sesuai Atau Tidak</th>
                <th>Kirim Gaji</th>
                <th>Action</th>
            </tr>
                <?php
                    foreach ($konfirmasi_data as $gaji)
                    {
                ?>
            <tr>
                <td width="80px"><?php echo ++$start ?></td>
                <td width="80px"><?php echo $gaji->nik; ?></td>
                <td><?php echo $gaji->tgl; ?></td>
                <td>
                    <?php 
                        if ( $gaji->konfirmasi == "0") {
                            echo "Tidak";
                        } else if ( $gaji->konfirmasi == "1"){
                            echo "Benar";
                        } else {
                            echo "Belum DiKonfirmasi";
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
                <td style="text-align:center" width="200px">
                    <?php  
                    echo anchor(site_url('app/slip_konfirmasi/'.$gaji->nik.'/'.$gaji->tgl),'Kirim'); 
                    ?>
                </td>
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