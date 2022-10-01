<?= $this->extend("layouts/main"); ?>

<?= $this->section("content"); ?>
<table class="table table-striped">
    <tr>
        <th colspan="3">
            Tampil Data Mata Kuliah
        </th>
    </tr>
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>
    <tr>
        <th>Kode MTK</th>
        <th>:</th>
        <td>
            <?= $data["kode"]; ?>
        </td>
    </tr>
    <tr>
        <td>Nama MTK</td>
        <td>:</td>
        <td>
            <?= $data["nama"]; ?>
        </td>
    </tr>
    <tr>
        <td>SKS</td>
        <td>:</td>
        <td>
            <?= $data["sks"]; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <a class="text-decoration-none" href="<?= base_url('matakuliah/new'); ?>">Kembali</a>
        </td>
    </tr>
</table>

<?= $this->endSection(); ?>