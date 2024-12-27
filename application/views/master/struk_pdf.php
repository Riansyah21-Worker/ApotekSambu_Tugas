
<html>
<head>
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }


        table th {
            background-color: #161876E1;
            font-weight: bold;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: white;
        }

        table tr:nth-child(odd) {
            background-color: #fff;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
        }
    </style>

</head>
<body>
    <div style="width: 300px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="text-align: center;">
            <?php
            $imagePath1 = base_url('assets/images/apoteksambu.png');
            $imageData1 = base64_encode(file_get_contents($imagePath1));
            $src1 = 'data:image/png;base64,' . $imageData1;

            $imagePath2 = base_url('assets/images/logo-baru.png');
            $imageData2 = base64_encode(file_get_contents($imagePath2));
            $src2 = 'data:image/png;base64,' . $imageData2;
            ?>
            <img style="width: 100px;" src="<?php echo $src1; ?>" />
            <img style="width: 75px;" src="<?php echo $src2; ?>" />
            <h1>Struk Pembelian</h1>
        </div>
        <div style="margin-top: 20px;">
            <table style="width: 100%;">
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td><?= $detail['tanggal_transaksi'] ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?= $detail['nama'] ?></td>
                </tr>
                <tr>
                    <th>Keluhan</th>
                    <td><?= $detail['keluhan'] ?></td>
                </tr>
                <tr>
                    <th>Obat</th>
                    <td><?= $detail['obat'] ?></td>
                </tr>
                <tr>
                    <th>PCS</th>
                    <td><?= $detail['jumlah_pcs'] ?></td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td><?= format_rupiah($detail['harga_satuan']); ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td><?= format_rupiah($detail['total_harga']); ?></td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px; text-align: center;">
            <p>Terima kasih atas pembelian Anda!</p>
            <p>Lunas!</p>
            <p><?= date('Y-m-d H:i:s') ?></p>
        </div>
    </div>
</body>
</html>