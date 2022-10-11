<?= $this->extend("layouts/main"); ?>



<?= $this->section("content"); ?>


<div id="wrapper">
    <?= view("components/sidebar"); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?= view("components/topbar"); ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= $this->renderSection("content"); ?>
            </div>

        </div>



        <!-- <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; DISKOPERINDAG 2022</span>
                </div>
            </div>
        </footer> -->

    </div>
</div>
<?= $this->endSection(); ?>