<?= $this->extend("layouts/main");?>

<?= $this->section("content");?>

<h1>Halo Kawan Yuk belajar web programming </h1>
<p>
        
    nilai1 = <?=$value1?>
    <br>
    nilai2 = <?=$value2?>
    <br>
    ini hasil dari pemodelan dengan metode penjumlahan yaitu 
    <?=$value1 . "+" . $value2 . "=" . $result; ?>

</p>


<?= $this->endSection();?>