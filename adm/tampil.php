<?php
include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--untuk menginclude kan icon di title bar windows -->
    <link rel="icon" href="../img/logo.ico" type="image/x-icon" />

    <!-- Bootstrap CSS yang sudah di pindah ke lokal, tidak lagi membutuhkan akses online-->
    <link rel="stylesheet" href="../css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- fontawesome adalah font yang digunakan untuk 'icon-icon' seperti icon social media, icon amplop, arrow (di bagian footer) dll akses online -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Official Website Universitas Brawijaya</title>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Kategori</th>
                <th scope="col">Sinopsis</th>
                <!-- <th scope="col">Gambar</th> -->
            </tr>
            <?php
            $barang = tampilBarang($koneksi);
            if ($barang == false) {
                echo 'Tidak Ada Barang';
            } else {
                $no = 1;
                foreach ($barang as $rec) {
                    ?>
                </thead>
                <tbody>

                    <tr>
                        <th scope="col"><?= $no ?></th>
                        <td><?= $rec['judul'] ?></td>
                        <td><?= $rec['pengarang'] ?></td>
                        <td><?= $rec['penerbit'] ?></td>
                        <td><?= $rec['kategori'] ?></td>
                        <td><?= $rec['sinopsis'] ?></td>

                        
                        <td><a href="update_data.php?id=<?= $rec['id'] ?>">Edit</a></td>

                        <td>
                        <form action="" method="POST">
                            <!-- data id barang disimpan dalam tag input type hidden dengan valuenya
                                 adalah id dari record/data terpilih  -->
                            <input type="hidden" name="id" value="<?= $rec['id'] ?>">
                            <button type="submit" class="btn" name='del'>Delete</button>
                        </form>
                        
                        </td>

                    </tr>
                </tbody>
                <?php $no++;


                }
            }
            ?>
    </table>
</body>