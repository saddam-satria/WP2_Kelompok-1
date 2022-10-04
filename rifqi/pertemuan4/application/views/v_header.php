<!DOCTYPE html>
<html>
<head>
 <meta charset=”utf-8”>
 <title>Web Prog II | Merancang Template sederhana dengan 
codeigniter</title>
 <link rel=”stylesheet” type=”text/css” href=”<?php echo 
base_url() ?>assets/css/stylebuku.css”>
</head>
<body>
 <div>
 <header style="background: #232323; display: flex; align-items:center; padding: 20px">
    <div>
        <h1 style="color: white; ">RentalBuku.net</h1>
        <h3 style="color: white;">Membuat Template Sederhana dengan 
        CodeIgniter</h3>
    </div>
    <nav style="display: flex; flex: 1; justify-content: end;">
        <ul style="display: flex; list-style:none;">
            <li style="padding: 0px 10px"><a href=”<?php echo 
            base_url().'index.php/web' ?>” style="color: #eee; text-decoration: none;">Home</a></li>
            <li><a href=”<?php echo 
            base_url().'index.php/web/about' ?>” style="color: #eee; text-decoration: none;">About</a></li>
        </ul>
    </nav>
<div class=”clear”></div>
</header>
</div>