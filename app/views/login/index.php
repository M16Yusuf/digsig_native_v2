<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-3/assets/css/login-3.css">
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
    <title>Login</title>
</head>

<body style="background-color: lavender;">
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card" style="max-width: 700px;">
                    <div class="row ">
                        <div class="col-md-4">
                            <img src="<?= BASEURL; ?>/img/depan_unikom.png" class="img-fluid rounded mx-auto my-0" loading="lazy" alt="gambar unikom" style="max-width:auto" />
                        </div>

                        <div class="col-md-7">
                            <div class="card-body">
                                <form action="<?= BASEURL; ?>/login/login" method="post">
                                    <div class="d-inline-flex align-items-center mb-3 pb-1">
                                        <div class="p-2">
                                            <img src="<?= BASEURL; ?>/img/logo_unikom.png" alt="logo Unikom" style="width: 70px; padding: 5px;"></img>
                                        </div>
                                        <div class="p-2">
                                            <span class="fs-5 fw-bold mb-0">
                                                Digital Signature <br>
                                                Divisi P2M Unikom
                                            </span>
                                        </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="text" name="nip" id="nip" placeholder="NIP" class="form-control form-control-md" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="password" name="password" id="password" placeholder="password" id="passwordid" class="form-control form-control-md" />
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <!-- tampilkan password -->
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Show Password
                                        </label>
                                        <script>
                                            function myFunction() {
                                                var x = document.getElementById("password");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                } else {
                                                    x.type = "password";
                                                }
                                            }
                                        </script>
                                    </div>
                                    <?php Flasher::flash(); ?>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>