<!DOCTYPE html>
<html>

<head>
    <title>Master Obat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
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
    <div class="logo">
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
            <h1>Data Obat</h1>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Supplier</th>
                <th>Stock</th>
                <th>Ditambahkan Oleh</th>
            </tr>
            <?php
            $no = 1;
            foreach ($content as $row) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row->nama_obat; ?></td>
                    <td><?= $row->supplier; ?></td>
                    <td><?= $row->stock; ?></td>
                    <td><?= $row->updated_by; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>

    </html>