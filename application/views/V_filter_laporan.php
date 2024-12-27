  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <div class="row" data-aos="fade-up" data-aos-delay="100">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="mt-2 mb-1 d-flex justify-content-center">
            <div class="card-body">
                <h1 class="judul">PEMBELIAN</h1>
                <form method="post" action="<?= base_url('index.php/C_laporan/hasil_laporan'); ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <label class="label-tebal" style="width: 100px;" for="periode">Periode:</label>
                            <input type="date" name="start_date" id="start_date" class="input-tanggal" required>
                            <span class="label-tebal" style="margin: 0 10px;">s/d</span>
                            <input type="date" name="end_date" id="end_date" class="input-tanggal" required>
                            <button type="submit" class="btn-tampil">
                                <i class="fas fa-folder-open"></i> Tampil
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</html>
<style>
    .judul {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
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

    .card-content {
        padding: 20px;
    }
</style>