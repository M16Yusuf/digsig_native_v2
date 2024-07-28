<div class="container d-flex justify-content-center align-items-center">
    <!-- card begin -->
    <div class="card w-100 w-md-75 w-lg-50">

        <div class="card-header">
            <form action="<?= BASEURL; ?>/tandatangan/cari" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari berdasar subjek ..." name="key_subjek" id="key_subjek">
                    <button class="btn btn-primary" type="submit" id="cari_subjek"><i class="lni lni-search-alt"></i></button>
                </div>
            </form>
        </div>

        <!-- pegencekan jabatan -->
        <?php if ($_SESSION['jabatan'] !== 'dosen') { ?>
            <div class="card-body scrollable-list">
                <!-- flasher output informasi -->
                <?php Flasher::flash(); ?>
                <?php $i = 1; ?>
                <?php foreach ($data['data_pengajuan'] as $k) : ?>
                    <div class="list-group">
                        <a href="<?= BASEURL; ?>/tandatangan/detail/<?= $k['id_lembar']; ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="p-1">
                                    <h6 class="card-text"> <?= $k['subjek']; ?></h6>
                                    <p class="card-text fs-6 text-body-secondary">
                                        Pengaju : <?= $k['nama']; ?>
                                        NIP : <?= $k['nip']; ?>
                                    </p>
                                </div>

                                <div class="p-1">
                                    <div class="d-flex justify-content-end">
                                        <div class="p-1">
                                            <small class="card-text text-body-secondary">
                                                <?php
                                                $date = date_create($k['created_at']);
                                                echo date_format($date, 'H:i, D d M Y');
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="p-1">
                                            <h6 class="card-text">
                                                <?php
                                                if ($_SESSION['jabatan'] == 'kaprodi') {
                                                    if ($k['ttd_kaprodi'] == 0) {
                                                        echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> Belum ditandatangan';
                                                    } else {
                                                        echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> Sudah ditandatangan';
                                                    }
                                                } elseif ($_SESSION['jabatan'] == 'dekan') {
                                                    if ($k['ttd_dekan'] == 0) {
                                                        echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> Belum ditandatangan';
                                                    } else {
                                                        echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> Sudah ditandatangan';
                                                    }
                                                } elseif ($_SESSION['jabatan'] == 'ketua divisi') {
                                                    if ($k['ttd_divisi'] == 0) {
                                                        echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> Belum ditandatangan';
                                                    } else {
                                                        echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> Sudah ditandatangan';
                                                    }
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php } else {
            echo '
            <div class="card-body p-5 text-center">
                <h5 class="card-title">Sistem penandatanganan Pengajuan P2M</h5>
                <p class="card-text">Hanya Kaprodi, dekan, dan ketua Divisi yang menandatangani.</p>
            </div>
        ';} ?>
    </div>
</div>
