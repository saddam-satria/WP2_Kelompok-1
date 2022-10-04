<!DOCTYPE html>
<html lang="en">

<head>

    <title>Web Prog II | Merancang Template sederhana dengan
    codeigniter</title>
    <link rel=”stylesheet” type=”text/css” href=”<?=
    base_url("assets/css/stylebuku.css") ?>”>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="<?= base_url("assets/style.css")?>"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= isset($title) ? $title : "web programming 2 | pertemuan 4"; ?></title>
</head>

<body>
    <div class="p-4" style="background-color: #232323;">
        <div class="d-flex align-items-center">
            <div style="flex: 0.7;">
                <h1 style="color: #eee;">RentalBuku.net</h1>
                <h3 style="color: #eee;">Membuat Template Sederhana dengan
                CodeIgniter</h3>
            </div>
            <div class="d-flex" style="flex: 0.3; justify-content: end;">
                <ul class="d-flex" style="list-style: none;">
                    <li class="px-2"><a href=”<?=
                    base_url("/web") ?>” class="text-decoration-none text-white">Home</a></li>
                    <li><a href=”<?=
                    base_url("/about") ?>” class="text-decoration-none text-white">About</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?= $this->renderSection("content"); ?>
    </div>

    <footer style="background-color: #232323;" class="p-4">
        <a href=”http://www.RentalBuku.com” class="text-decoration-none text-white">RentalBuku</a>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>