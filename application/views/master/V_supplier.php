<?php $this->load->view('template/headbar'); ?>

<section id="basic-datatable">
    <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="mt-2 mb-1 d-flex justify-content-center">
                        <img style="width: 100px;" src="<?php echo base_url('assets/images/apoteksambu.png') ?>" />
                        <img style="width: 75px;" src="<?php echo base_url('assets/images/logo-baru.png') ?>" />
                    </div>
                    <div class="d-flex justify-content-center">
                        <h2><?php echo $this->config->item("nama_perusahaan"); ?></h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('index.php/master/C_supplier/simpan') ?>" id="master_supplier" name="master_supplier" method="post" role="form" enctype="multipart/form-data">
                            <div class="row mb-1">
                                <div class="col-md-3">
                                    <strong>Tambah Supplier</strong>
                                </div>
                                <div class="col-md-12">
                                    <?php if (isset($message)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Warning!</h4>
                                            <p class="mb-0">
                                                <?php echo $message; ?>
                                            </p>
                                        </div>
                                    <?php } ?>

                                    <div class="form-group row">
                                        <div class="col-md-3">Supplier Name</div>
                                        <div class="col-md-3">
                                            <input type="text" name="supplier" id="supplier" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3">Updated By</div>
                                        <div class="col-md-3">
                                            <select name="updated_by" id="updated_by" class="form-control" style="text-align:center;" required>
                                                <option value=""> - Pilih -</option>
                                                <option value="<?= $dtpersonil ?>"> <?= $dtpersonil ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-3" align="right">
                                            <button type="submit" class="btn bg-gradient-primary" id="btnsimpan"><i class="feather icon-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>
