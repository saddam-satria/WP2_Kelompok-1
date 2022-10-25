<?= $this->extend("layouts/main");?>


<?= $this->section("content");?>

<div class="mt-5">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <form action="<?= base_url("auth/login")?>" method="POST"> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-white">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text-white">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
               <div class="d-flex">
                   <div class="ms-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                   </div>
               </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection();?>