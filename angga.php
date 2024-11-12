<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Fotokopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center bg-dark text-white">
            <h4>Perhitungan Harga Fotokopi</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="langganan">Langganan</option>
                        <option value="bukan_langganan">Bukan Langganan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_lembar" class="form-label">Jumlah Lembar</label>
                    <input type="number" class="form-control" id="jumlah_lembar" name="jumlah_lembar" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Hitung</button>
            </form>

            <?php
            // Cek jika form disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Ambil data dari form
                $status = $_POST['status'];
                $jumlah_lembar = $_POST['jumlah_lembar'];

                // Variabel untuk harga
                $harga_per_lembar = 0;
                $total_harga = 0;

                // Logika perhitungan harga
                if ($status == 'langganan') {
                    // Langganan, harga perlembar Rp. 75
                    $harga_per_lembar = 75;
                } else {
                    // Bukan langganan
                    if ($jumlah_lembar < 100) {
                        $harga_per_lembar = 100; // Harga per lembar Rp. 100
                    } else {
                        $harga_per_lembar = 85; // Harga per lembar Rp. 85
                    }
                }

                // Hitung total harga
                $total_harga = $harga_per_lembar * $jumlah_lembar;

                // Tampilkan hasil
                echo "<div class='mt-4 alert alert-info'>";
                echo "<strong>Total Harga: Rp. " . number_format($total_harga, 0, ',', '.') . "</strong>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
