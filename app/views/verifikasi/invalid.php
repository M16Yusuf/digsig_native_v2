<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- online booststrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <!-- css custom -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <!-- judul -->
    <title> <?= $data['title']; ?> </title>
</head>

<body>

    <div class="container">
        <!-- baris -->
        <!-- judul -->
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="p-2 navbar">
                        <img src="<?= BASEURL; ?>/img/unikom.png" class="d-inline-block align-text-top" style="width: 200px;">
                    </div>
                    <div class="p-2">
                        <h5 class="text-right">Verifikasi Digital Signature</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- content -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Divisi P2M Universitas Komputer Indonesia</h4>
                        <ul class="list-group">
                            <li class="list-group-item border-0">
                                <?php Flasher::flash(); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end baris  -->
    </div>

    <!-- JS custom -->
    <script src="<?= BASEURL; ?>/js/script.js"></script>
    <!-- Online JS bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>