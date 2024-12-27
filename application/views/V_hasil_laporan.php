<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <div class="row" data-aos="fade-up" data-aos-delay="100">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="mt-2 mb-1 d-flex justify-content-center">
            <form method="post" action="<?= base_url('index.php/C_laporan/hasil_laporan'); ?>">
                <h2 class="text-center mb-4">PEMBELIAN</h2>
                <!-- Filter Periode -->
                <div class="form-group">
                    <div class="input-group">
                        <label class="label-tebal" style="width: 100px;" for="periode">Periode:</label>
                        <!-- Set nilai start_date dan end_date di input date -->
                        <input type="date" name="start_date" id="start_date" class="input-tanggal" 
                        value="<?= isset($start_date) ? $start_date : date('Y-m-d'); ?>" required>
                        <span class="label-tebal" style="margin: 0 10px;">s/d</span>
                        <input type="date" name="end_date" id="end_date" class="input-tanggal" 
                        value="<?= isset($end_date) ? $end_date : date('Y-m-d'); ?>" required>
                        <button type="submit" class="btn-tampil">
                            <i class="fas fa-folder-open"></i> Tampil
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Tabel Laporan -->

        <div class="container mt-5">
            <div class="table-responsive">
                <table id="laporanTable" class="table table-bordered table-striped w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan)): ?>
                            <?php $no = 1; foreach ($laporan as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($row['tanggal_transaksi'])); ?></td>
                                <td><?= htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($row['keluhan'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/C_laporan/lihat_detail/' . $row['id']); ?>" 
                                       class="btn btn-primary btn-sm">
                                       <i class="fas fa-search" style="font-size: 12px;"></i> 
                                   </a>

                                   <a href="<?= base_url('index.php/C_laporan/struk_pdf/' . $row['id']); ?>" 
                                       class="btn btn-success btn-sm">
                                       <i class="fas fa-file-pdf" style="font-size: 12px;"></i> PDF
                                   </a>

                                   <a href="<?= base_url('index.php/C_laporan/delete_laporan/' . $row['id']); ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" 
                                       class="btn btn-danger btn-sm">
                                       <i class="fas fa-trash-alt" style="font-size: 12px;"></i> 
                                   </a>
                               </td> <!-- Penutupan td untuk aksi -->
                           </tr>
                       <?php endforeach; ?>
                   <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data laporan untuk ditampilkan.</td>
                    </tr>
                    

                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- Tambahkan JavaScript Bootstrap dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laporanTable').DataTable({
            responsive: true,
            autoWidth: false,
            lengthChange: true,
            pageLength: 10
        });
    });
</script>
</body>
</html>

<style> 
    table thead th {
        background-color: #2f4f7f; /* Warna biru gelap */
        color: #ffffff; /* Warna teks putih */
        text-align: center;
    }

    table tbody td {
        background-color: #ffffff; /* Warna latar putih */
        color: #000000; /* Warna teks hitam */
    }

    table tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Warna abu terang untuk baris genap */
    }

    .judul {
        text-align: center;
        margin-bottom: 40px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .input-group {
        display: flex;
        flex-direction: row;
        align-items: center;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        justify-content: center;
    }
    .label-tebal {
        font-weight: bold;
        margin-right: 10px;
        text-align: center;
    }
    .input-tanggal {
        width: 180px;
        margin-right: 10px;
    }
    .btn-tampil {
        background-color: #2f4f7f;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        margin-left: 10px;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .table-dark th {
        color: white !important;
    }


</style>
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>
