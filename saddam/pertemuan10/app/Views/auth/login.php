<?= $this->extend("layouts/main");?>


<?= $this->section("body");?>


<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" method="POST" action="<?=base_url("auth/login")?>">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="email" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="password">
                                </div>
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </a>
                               
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>


<?= $this->endSection();?>