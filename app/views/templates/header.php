<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- online booststrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- mycss custom -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">
    <!-- judul -->
    <title> <?= $data['title']; ?> </title>
</head>

<body>
    <!-- begin global wrapper-->
    <div class="container-fluid p-0 d-flex h-100 overflow-hidden">
        <!-- begin sidebar -->
        <div id="bdSidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white offcanvas-md offcanvas-start">
            <div class="navbar bg-dark">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand text-white fw-bolder">
                        <img src="<?= BASEURL; ?>/img/logo_unikom.png" class="d-inline-block align-text-top" style="width: 25px;">
                        UNIKOM DIGSIG
                    </a>
                </div>
            </div>

            <hr />

            <!-- list sidebar -->
            <ul class="mynav nav nav-pills flex-column mb-auto">
                <!-- fist list -->
                <li class="nav-item mb-1">
                    <a href="#" class="sidebar-link">
                        <i class="fa-regular fa-user"></i>
                        <span class="topic"><?= $_SESSION['nama']; ?> </span>
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="#" class="sidebar-link">
                        <i class="fa-regular fa-user"></i>
                        <span class="topic"><?= $_SESSION['nip']; ?> </span>
                    </a>
                </li>
                <hr />
                <!-- menu pertama pengajuan -->
                <li class="nav-item mb-1">
                    <a href="<?= BASEURL; ?>/pengajuan" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span> Pengajuan </span>
                    </a>
                </li>

                <!-- menu kedua penandatanganan -->
                <li class="nav-item mb-1">
                    <a href="<?= BASEURL; ?>/tandatangan" class="sidebar-link">
                        <i class="lni lni-write"></i>
                        <span> Penandatanganan</span>
                    </a>
                </li>

                <!-- menu ketiga logout -->
                <li class="nav-item mb-1">
                    <a href="<?= BASEURL; ?>/login/logout" class="sidebar-link">
                        <i class="fas fa-sign-out-alt pe-2"></i>
                        <span class="topic">Log Out</span>
                    </a>
                </li>
            </ul>
            <hr />
            <!-- footer sidebar -->
            <div class="d-flex">
                <i class="fa-solid fa-book me-2"></i>
                <span>
                    <h6 class="mt-1 mb-0">Divisi P2M UNIKOM </h6>
                </span>
            </div>
        </div>

        <!-- sidebar collase tittle  -->
        <div class="bg-light flex-fill">
            <div class="p-2 d-md-none d-flex text-white bg-dark">
                <a href="#" class="text-white" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar">
                    <i class="fa-solid fa-bars"></i>
                </a>
                <span class="ms-3"><?= $data['title']; ?></span>
            </div>


            <div class="p-4">
                <!-- start breadcrumb -->
                <!-- <nav style="--bs-breadcrumb-divider: '>'; font-size: 14px">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fa-solid fa-house"></i>
                        </li>
                        <li class="breadcrumb-item">Learning Content</li>
                        <li class="breadcrumb-item">Next Page</li>
                    </ol>
                </nav>  -->
                <!-- end breadcrunb -->
                <!-- <hr /> -->


                <div class="row">
                    <div class="col">
                        <!-- begin content -->