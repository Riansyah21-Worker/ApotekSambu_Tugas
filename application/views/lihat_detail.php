
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            <form>
              <div class="row mb-1">
                <div class="col-md-3">
                  <h2><strong>DETAIL PEMBELIAN</strong></h2>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Tanggal Transaksi</div>
                <div class="col-md-3">
                  <input type="text" value="<?= $detail['tanggal_transaksi']; ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Nama</div>
                <div class="col-md-3">
                  <input type="text" value="<?= $detail['nama']; ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Keluhan</div>
                <div class="col-md-3">
                  <textarea readonly class="form-control"><?= $detail['keluhan']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Obat</div>
                <div class="col-md-3">
                  <textarea readonly class="form-control"><?= $detail['obat']; ?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">PCS</div>
                <div class="col-md-3">
                  <input type="text" value="<?= $detail['jumlah_pcs']; ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Harga Satuan</div>
                <div class="col-md-3">
                  <input type="text" value="<?= format_rupiah($detail['harga_satuan']); ?>" readonly class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">Total Harga</div>
                <div class="col-md-3">
                  <input type="text" value="<?= format_rupiah($detail['total_harga']); ?>" readonly class="form-control">
                </div>
                <div class="form-group row">
                  <div class="col-md-3"></div>
                  <div class="col-md-3">
                    <a href="<?= base_url('index.php/C_laporan/struk_pdf/' . $detail['id']); ?>" class="btn btn-sm bg-gradient-primary">
                      <i class="fas fa-print" style="font-size: 12px;"></i> Cetak Struk
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <style>
    .card-content {
      padding: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 5px;
      padding: 10px;
    }
  </style>