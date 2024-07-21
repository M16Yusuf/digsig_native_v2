<div class="container">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <!-- flasher output informasi -->
                    <?php Flasher::flash(); ?>

                    <!-- table  -->
                    <div class="table-scroll">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Nama Pengaju</th>
                                    <th scope="col">tanggal pengajuan</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($data['data_pengajuan'] as $k) : ?>
                                    <tr>
                                        <th scope="col"> <?= $i++; ?></th>
                                        <td> <?= $k['subjek']; ?> </td>
                                        <td> <?= $k['nama']; ?></td>
                                        <td> <?= $k['created_at']; ?></td>
                                        <td> 
                                            <?php
                                            if ($k['ttd_kaprodi'] == 0) {
                                                echo '<i class="fa-solid fa-circle-xmark" style="color: grey;"></i> kaprodi belum';
                                            } else {
                                                echo '<i class="fa-solid fa-circle-check" style="color: green;"></i> kaprodi Sudah';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?= BASEURL; ?>/tandatangan/detail/<?= $k['id_lembar']; ?>" class="btn btn-primary mb-3"> detail </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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
                        <label class="form-label"> Judul lembar yang akan ditandatangan </label>
                        <input type="text" class="form-control" id="judul" name="judul">
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