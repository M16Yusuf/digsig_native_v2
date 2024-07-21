    
    <div class="container d-flex justify-content-center align-items-center">    
        <div class="card w-100 w-md-75 w-lg-50">
            <!-- card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="p-1">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Pengajuan Baru +
                        </button>
                    </div>
                    <div class="p-1">
                        <form action="<?= BASEURL; ?>/pengajuan/cari" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari subjek ..." name="key_subjek" id="key_subjek">
                                <button class="btn btn-primary" type="submit" id="cari_subjek"><i class="lni lni-search-alt"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php Flasher::flash(); ?>
            </div>
            <!-- card body -->
            <div class="card-body scrollable-list">
                <!-- test list -->
                <?php $i = 1; ?>
                <?php foreach ($data['data_pengajuan'] as $k) : ?>
                    <div class="list-group">
                        <a href="<?= BASEURL; ?>/pengajuan/detail/<?= $k['id_lembar']; ?>" class="list-group-item list-group-item-action">
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
                                                if ($k['ttd_kaprodi'] == 0) {
                                                    echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> Kaprodi';
                                                } else {
                                                    echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> Kaprodi';
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="p-1">
                                            <h6 class="card-text">
                                                <?php
                                                if ($k['ttd_dekan'] == 0) {
                                                    echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> Dekan';
                                                } else {
                                                    echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> Dekan';
                                                }
                                                ?>
                                            </h6>
                                        </div>
                                        <div class="p-1">
                                            <h6 class="card-text">
                                                <?php
                                                if ($k['ttd_divisi'] == 0) {
                                                    echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> ketua Divisi';
                                                } else {
                                                    echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> ketua Divisi';
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
        </div>
    </div>

    <!-- modal box content -->
    <div class="modal fade modal-lg" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajukan pengajuan tandatangan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= BASEURL; ?>/pengajuan/tambah" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label"> Subjek lembar yang akan ditandatangan </label>
                            <input type="text" class="form-control" id="subjek" name="subjek">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Upload file lembar yang akan ditandatangan </label>
                            <input type="file" class="form-control" id="file_input" name="file_input">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
                </form>
            </div>
        </div>
    </div>