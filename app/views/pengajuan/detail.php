<div class="container d-flex justify-content-center align-items-center">
    <div class="card w-100 w-md-75 w-lg-50">
        <!-- card header -->
        <div class="card-header d-flex justify-content-between">
            <div class="p-0">
                <h5 class="fs-5">Detail Lembar Tandatangan yang Diajukan</h5>
            </div>
            <div class="p-0">
                <a href="<?= BASEURL; ?>/pengajuan/hapus/<?= $data['data_pengajuan']['id_lembar']; ?>" class="btn btn-outline-danger" onclick="return confirm('Data yang sudah dihapus tidak bisa dipulihkan, Yakin dihapus?')">
                    <i class="fa-regular fa-trash-can"></i>
                </a>
            </div>
        </div>
        <!-- card body -->
        <div class="card-body scrollable-list">
            <div class="row">
                <div class="col-md-5">
                    <iframe src="<?= BASEURL; ?>/uploads/lembar/<?= $data['data_pengajuan']['path']; ?>" width="340" height="485" name="pdfframe">
                        <p>This browser does not support PDF!</p>
                    </iframe>
                </div>
                <div class="col-md-7">
                    <!-- card pertama informasi lembar-->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body text-bg-light">
                                    <h6 class="card-title text-center"><?= $data['data_pengajuan']['subjek']; ?> </h6>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card kedua : list tandatangan -->
                    <div class="row pt-3">
                        <div class="col">
                            <div class="card">
                                <div class="card-body text-bg-light">
                                    <h6 class="card-subtitle text-body-secondary">List tandatangan </h6>
                                    <?php foreach ($data['ttd_pengajuan'] as $k) : ?>
                                        <div class="list-group ">
                                            <a href="<?= BASEURL ?>/verifikasi/<?= $k['token'] ?>" target="_blank" class="list-group-item list-group-item-action">
                                                <h6 class="card-subtitle">
                                                    <?= $k['jabatan']; ?>
                                                </h6>
                                                <table>
                                                    <tr>
                                                        <td>Nama </td>
                                                        <td> : <?= $k['nama']; ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIP </td>
                                                        <td> : <?= $k['nip']; ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal tandatangan </td>
                                                        <td> :
                                                            <?php
                                                            $date = date_create($k['signed_at']);
                                                            echo date_format($date, 'H:i, D d M Y');
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <h6 class="card-subtitle text-body-secondary mt-2">
                                                    Signature
                                                </h6>
                                                <p class="text-body-secondary">
                                                    <?= $k['signature']; ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>