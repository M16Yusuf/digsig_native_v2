<div class="container d-flex justify-content-center align-items-center">
    <div class="card w-100 w-md-75 w-lg-50">
        <!-- card header -->
        <div class="card-header">
            <h5 class="mt-2 fw-bolder">Penandatangan Lembar Pengajuan P2M</h5>
        </div>

        <!-- card body -->
        <div class="card-body scrollable-list">
            <div class="row">
                <div class="col-md-5">
                    <object class="pdf" data="<?= BASEURL; ?>/uploads/lembar/<?= $data['data_pengajuan']['path']; ?>" width="360" height="485" name="pdfframe">
                        <p>This browser does not support PDF!</p>
                    </object>
                </div>
                <div class="col-md-7">

                    <!-- card pertama : informasi lembar -->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body small">
                                    <h6 class="card-title fw-bolder text-center mb-3"><?= $data['data_pengajuan']['subjek']; ?> </h6>
                                    <table>
                                        <tr>
                                            <td>Pengaju </td>
                                            <td>: <?= $data['data_pengajuan']['nama']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>NIP </td>
                                            <td>: <?= $data['data_pengajuan']['nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="white-space: nowrap; vertical-align: top;">Tanggal diajukan </td>
                                            <td> :
                                                <?php
                                                $date = date_create($data['data_pengajuan']['created_at']);
                                                echo date_format($date, 'H:i, D d M Y');
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="white-space: nowrap; vertical-align: top;">nama dokumen </td>
                                            <td>: <?= $data['data_pengajuan']['path']; ?></td>
                                        </tr>
                                    </table>
                                    <form action="<?= BASEURL; ?>/tandatangan/tandatangan/<?= $data['data_pengajuan']['id_lembar']; ?>" method="post">
                                        <!-- pengecekan  urutan tandatangan -->
                                        <!-- pengecekan jika $_session['jabatan'] baik itu prodi, dekan, 
                                        atau ketua divisi sudah tandatangan maka disable button-->
                                        <?php
                                        if ($_SESSION['jabatan'] == 'kaprodi') {
                                            if ($data['data_pengajuan']['ttd_kaprodi'] == 0) {
                                                echo '<button class="btn btn-primary mt-3" type="submit">Tandatangan</button>';
                                            } else {
                                                echo '<button class="btn btn-secondary mt-3" type="submit" disabled> Sudah di tandatangan</button>';
                                            }
                                        } elseif ($_SESSION['jabatan'] == 'dekan') {
                                            if ($data['data_pengajuan']['ttd_kaprodi'] == 0) {
                                                echo '<button class="btn btn-secondary mt-3" type="submit" disabled> tandatangan</button>
                                                    <h6 class="text-danger"> Kaprodi belum tandatangan.</h6>';
                                            } else {
                                                if ($data['data_pengajuan']['ttd_dekan'] == 0) {
                                                    echo '<button class="btn btn-primary mt-3" type="submit">Tandatangan</button>';
                                                } else {
                                                    echo '<button class="btn btn-secondary mt-3" type="submit" disabled> Sudah di tandatangan</button>';
                                                }
                                            }
                                        } elseif ($_SESSION['jabatan'] == 'ketua divisi') {
                                            if ($data['data_pengajuan']['ttd_kaprodi'] == 0) {
                                                echo '<button class="btn btn-secondary mt-3" type="submit" disabled> tandatangan</button>
                                                    <h6 class="text-danger"> Kaprodi dan Dekan belum tandatangan.</h6>';
                                            } else {
                                                if ($data['data_pengajuan']['ttd_dekan'] == 0) {
                                                    echo '<button class="btn btn-secondary mt-3" type="submit" disabled> tandatangan</button>
                                                        <h6 class="text-danger"> Dekan belum tandatangan.</h6>';
                                                } else {
                                                    if ($data['data_pengajuan']['ttd_divisi'] == 0) {
                                                        echo '<button class="btn btn-primary mb-3" type="submit">Tandatangan</button>';
                                                    } else {
                                                        echo '<button class="btn btn-secondary mb-3" type="submit" disabled> Sudah di tandatangan</button>';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </form>
                                    <!-- flasher message -->
                                    <?php Flasher::flash(); ?>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- card kedua : list tandatangan -->
                    <div class="row pt-3">
                        <div class="col">
                            <div class="card">
                                <div class="card-body text-bg-light small">
                                    <p class="fw-bolder text-muted mb-1">LIST TANDATANGAN </p>
                                    <?php foreach ($data['ttd_pengajuan'] as $k) : ?>
                                        <div class="list-group ">
                                            <a href="<?= BASEURL ?>/verifikasi/<?= $k['token'] ?>" target="_blank" class="list-group-item list-group-item-action">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="p-0">
                                                        <h6 class="card-subtitle fw-bolder text-muted">
                                                            <?= $k['jabatan']; ?>
                                                        </h6>
                                                    </div>
                                                    <div class="p-0">
                                                        <p class="small fw-bolder text-muted mb-0"> Nama : </p>
                                                        <p class="mb-0"> <?= $k['nama']; ?> </p>
                                                    </div>
                                                    <div class="p-0">
                                                        <p class="small fw-bolder text-muted mb-0"> NIP :</p>
                                                        <p class="mb-0"> <?= $k['nip']; ?> </p>
                                                    </div>
                                                    <div class="p-0">
                                                        <p class="small fw-bolder text-muted mb-0">Tanggal tandatangan </p>
                                                        <p class="mb-0">
                                                            <?php
                                                            $date = date_create($k['signed_at']);
                                                            echo date_format($date, 'H:i, D d M Y');
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <p class="card-subtitle small fw-bolder text-body-secondary mt-1">
                                                    Signature
                                                </p>
                                                <p class="small text-body-secondary mb-0">
                                                    <?= $k['signature']; ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>
</div>