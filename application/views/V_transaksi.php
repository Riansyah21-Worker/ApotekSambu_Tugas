

<?php $this->load->view('template/headbar'); ?>
<?php $url = base_url(); ?>
<!-- Alert Flashdata -->
<?php if ($this->session->flashdata('success')): ?>
    <div id="custom-alert" style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px; position: relative; text-align: center;">
        <?= $this->session->flashdata('success'); ?>
        <button id="close-alert" style="background-color: transparent; border: none; color: #155724; font-weight: bold; cursor: pointer; margin-left: 15px;">OK</button>
    </div>
<?php endif; ?>

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
                        <form action="<?= base_url('index.php/master/C_transaksi/simpan') ?>" method="post" id="master_transaksi" name="master_transaksi">
                            <div class="row mb-1">
                                <div class="col-md-3">
                                    <h2><strong>INPUT PEMBELIAN</strong></h2>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <?php if (isset($message)) { ?>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Warning!</h4>
                                                <p class="mb-0"> <?php echo $message; ?> </p>
                                            </div>
                                        <?php } ?>
                                    </p>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Nama</label>
                                        <div class="col-md-3">
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Keluhan</label>
                                        <div class="col-md-3">
                                            <input type="text" name="keluhan" id="keluhan" class="form-control" required>
                                        </div>
                                    </div>

                                    <!-- Input Obat -->
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Obat</label>
                                        <div class="col-md-3">
                                            <select name="obat" id="id_obat" class="form-control" required>
                                                <option value="" disabled selected>- Pilih Obat -</option>
                                                <?php foreach ($dtobat as $dtobat_row): ?>
                                                    <option 
                                                    value="<?= htmlspecialchars($dtobat_row->id, ENT_QUOTES, 'UTF-8'); ?>"  
                                                    data-nama="<?= htmlspecialchars($dtobat_row->nama_obat, ENT_QUOTES, 'UTF-8'); ?>"
                                                    data-harga="<?= htmlspecialchars($dtobat_row->harga_satuan, ENT_QUOTES, 'UTF-8'); ?>" 
                                                    data-stock="<?= htmlspecialchars($dtobat_row->stock, ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?= htmlspecialchars($dtobat_row->nama_obat, ENT_QUOTES, 'UTF-8'); ?> 
                                                    (Stok: <?= htmlspecialchars($dtobat_row->stock, ENT_QUOTES, 'UTF-8'); ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                                <input type="hidden" name="nama_obat" id="nama_obat">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">PCS</label>
                                    <div class="col-md-3">
                                        <input type="number" name="pcs" id="pcs" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Harga Satuan</label>
                                    <div class="col-md-3">
                                        <input type="text" name="harga_satuan" id="harga_satuan" class="form-control" value="" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Total Harga</label>
                                    <div class="col-md-3">
                                        <input type="text" name="total_harga" id="total_harga" class="form-control" value="" readonly>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <button type="submit" class="btn bg-gradient-primary" id="btn_simpan">
                                            <i class="feather icon-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <tfoot>
                    <tr>
                        <td class="table-primary align-middle text-center" colspan="6"> </td>
                    </tr>
                </tfoot>
            </div>
        </div>
    </div>
</div>
</section>
<?php $this->load->view('template/footbar'); ?>

<script>
    $(document).ready(function() {

      $(document).on('input', '.harga_satuan, .total_harga', function() {
        let value = $(this).val().trim().replace(/[^0-9]/g, ''); 
        if (value !== '') {
          value = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
          $(this).val(value);
      }
  });

  // Hitung Total Harga
      $('#pcs, #harga_satuan').on('input', function() {
    var pcs = parseInt($('#pcs').val()) || 0; // Ambil jumlah pcs
    var hargaSatuan = parseInt($('#harga_satuan').val().replace(/Rp|\./g, '')) || 0; 
    var totalHarga = pcs * hargaSatuan;

    $('#total_harga').val('Rp ' + totalHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
});


      $('#id_obat').change(function() {
        const selectedOption = this.options[this.selectedIndex];
        const hargaSatuan = selectedOption.getAttribute('data-harga'); 
        const stok = selectedOption.getAttribute('data-stock'); 
        const hargaSatuanParsed = parseInt(hargaSatuan.replace(/\D/g, '')) || 0; 
        const formattedHargaSatuan = hargaSatuanParsed.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        $('#harga_satuan').val('Rp ' + formattedHargaSatuan);
        $('#pcs').on('input', function () {
            const jumlahPcs = parseInt($(this).val());
            if (jumlahPcs > stok) {
                alert('Stok tidak mencukupi. Maksimal stok: ' + stok);
                $(this).val(stok);
            }
        });
    });
      $('#form').submit(function(e) {
        e.preventDefault(); 

        var hargaSatuan = $('#harga_satuan').val().replace(/Rp|\./g, ''); 
        var totalHarga = $('#total_harga').val().replace(/Rp|\./g, ''); 
        $.ajax({
            type: 'POST',
            url: '<?= base_url('index.php/transaksi/simpan') ?>',
            data: {
                nama: $('#nama').val(),
                keluhan: $('#keluhan').val(),
                obat: $('#obat').val(),
                pcs: $('#pcs').val(),
                harga_satuan: hargaSatuan,
                total_harga: totalHarga
            },
            success: function(response) {
                console.log(response); 

                if(response.status === 'success') {
                    alert('Data berhasil disimpan!'); 
                    $('#form')[0].reset(); 

                    window.location.href = '<?= base_url('master/C_transaksi') ?>'; 
                } else {
                    alert('Terjadi masalah saat menyimpan data.'); 
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    });

  });

        $// 
        $('#id_obat').change(function () {
            const selectedOption = this.options[this.selectedIndex];
            const namaObat = selectedOption.getAttribute('data-nama');
            const hargaSatuan = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stock');
    $('#nama_obat').val(namaObat); // Update nama obat di hidden input
    $('#harga_satuan').val('Rp ' + parseInt(hargaSatuan).toLocaleString());
    $('#pcs').on('input', function () {
        const jumlahPcs = parseInt($(this).val());
        if (jumlahPcs > stok) {
            alert('Stok tidak mencukupi. Maksimal stok: ' + stok);
            $(this).val(stok); 
        }
    });
    $('#nama_obat').val(namaObat); 
});


        document.getElementById('id_obat').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const hargaSatuan = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stock');

        // Tampilkan harga satuan dalam format Rupiah
            document.getElementById('harga_satuan').value = formatRupiah(hargaSatuan);
            document.getElementById('jumlah_pcs').max = stok;
        });

        document.addEventListener('DOMContentLoaded', function () {
            const closeAlertButton = document.getElementById('close-alert');
            const alertBox = document.getElementById('custom-alert');

            if (closeAlertButton && alertBox) {
                closeAlertButton.addEventListener('click', function () {
                    alertBox.style.display = 'none'; 
                });
            }
        });




    </script>
    <?php $this->load->view('template/footbarend'); ?>




