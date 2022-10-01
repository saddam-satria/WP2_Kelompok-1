<?= $this->extend("layouts/main"); ?>

<?= $this->section("content"); ?>
<div class="py-2">
    <h5> Form Input Data Mata Kuliah</h5>
</div>
<div class="my-3" style="background-color: #eee; height: 1px; width: 100%;">

</div>
<div class="row ">
    <div class="col-md-8 col-sm-12">
        <form action="<?= base_url('matakuliah/new'); ?>" method="POST">
            <div class="mb-3">
                <label for="kode" class="form-label">Kode MTK</label>
                <input type="text" name="kode" class="form-control" id="kode">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama MTK</label>
                <input type="text" name="nama" class="form-control" id="nama">
            </div>

            <div class="mb-3">
                <label for="sks" class="form-label">SKS</label>
                <select name="sks" class="form-select" aria-label="Default select example">
                    <option selected>Pilih SKS</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>



<?= $this->endSection(); ?>