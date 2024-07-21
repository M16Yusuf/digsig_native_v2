<div class="container">
    <h2 class="mt-2">Detail Lembar Tandatangan yang Diajukan</h2>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-5">
                <iframe src="<?= BASEURL; ?>/uploads/lembar/<?= $data['data_pengajuan']['path']; ?>" width="300" height="450" name="pdfframe">
                    <p>This browser does not support PDF!</p>
                </iframe>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['data_pengajuan']['judul']; ?></h5>
                    <p class="card-text">path : <?= $data['data_pengajuan']['path']; ?></p>
                    <p class="card-text"><small class="text-body-secondary"> Tanggal diajukan : <?= $data['data_pengajuan']['created_at']; ?></small></p>
                    <p class="card-text"><small class="text-body-secondary"> Terakhir diupdate : <?= $data['data_pengajuan']['updated_at']; ?></small></p>
                    <?php Flasher::flash(); ?>
                    <a href="<?= BASEURL; ?>/tandatangan/tandatangan/<?= $data['data_pengajuan']['id_lembar']; ?>" class="btn btn-primary mb-3">Tandatangan</a>

                </div>
            </div>
        </div>
    </div>
</div>