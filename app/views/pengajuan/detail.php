<div class="container">
    <h2 class="mt-2">Detail Lembar Tandatangan yang Diajukan</h2>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-5">
                <iframe src="<?= BASEURL; ?>/uploads/lembar/<?= $data['data_pengajuan']['path']; ?>" width="250" height="390" name="pdfframe">
                    <p>This browser does not support PDF!</p>
                </iframe>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['data_pengajuan']['subjek']; ?></h5>
                    <p class="card-text">path : <?= $data['data_pengajuan']['path']; ?></p>
                    <p class="card-text"><small class="text-body-secondary"> Tanggal diajukan : <?= $data['data_pengajuan']['created_at']; ?></small></p>
                
                    <a href="<?= BASEURL; ?>/pengajuan/hapus/<?= $data['data_pengajuan']['id_lembar']; ?>" class="btn btn-danger" onclick="return confirm('Data yang sudah dihapus tidak bisa dipulihkan, Yakin dihapus?')">Hapus</a>

                </div>
            </div>
        </div>
    </div>
</div>