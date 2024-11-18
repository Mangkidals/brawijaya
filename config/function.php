<?php

function validasiBarang ($data){

    foreach ($data as $barang => $value){

        $value = trim($value);
        if ($value === '' || $value === null || $value === false)
        return $barang;
    }
    return 0;
}


// input data ke tabel

function inputBarang ($data, $koneksi){
    
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $penerbit = $data['penerbit'];
    $kategori = $data['kategori'];
    $sinopsis = $data['sinopsis'];

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, kategori, sinopsis) VALUES (?, ?, ?, ?, ?)";  
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt === false){
        return "Failed to prepare statement".mysqli_error($koneksi);
    }
    mysqli_stmt_bind_param($stmt, 'sssss', $judul, $pengarang, $penerbit, $kategori, $sinopsis);
    $result = mysqli_stmt_execute($stmt);


    if (!$result){
        echo "Error executing statement : ". mysqli_stmt_error($stmt);
        return false;
    }


    mysqli_stmt_close($stmt);
    return true;

}

function tampilBarang($koneksi){
    $sql  = "SELECT * FROM buku"; // query untuk menampilkan semua data 
    $stmt = mysqli_query($koneksi, $sql);

    // $result = mysqli_fetch_array($stmt);

    if(mysqli_num_rows($stmt) > 0) return mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    else return false;
}
// baru ditambahkan, 
// fungsi untuk menghapus data yang terpilih