<?php

if(isset($_POST['btnInputBuku'])){

    $judul = htmlspecialchars($_POST['judul']);
    $pengarang = htmlspecialchars($_POST['pengarang']);
    $penerbit = htmlspecialchars($_POST['penerbit']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $sinopsis = htmlspecialchars($_POST['sinopsis']);
    
    $data = [
    'judul' => $judul,
    'pengarang' => $pengarang ,
    'penerbit' => $penerbit ,
    'kategori' => $kategori ,
    'sinopsis' => $sinopsis ,
    ];

    $validasi = validasiBarang($data);

    if ($validasi === 0){
        $result = inputBarang($data, $koneksi);

        if($result)
        {
            header("Location:input.php?succsess=1");
            // $dir = $_SERVER['DOCUMENT_ROOT'].'/universitas_brawijaya/upload/gambar';
            // $upload = tambahGambar($dir, $_FILES['gambar']);
            // $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); 
            // if($upload)header("Location:input.php?succsess=1");
        } 
        else header ("Location:input.php?errno=1");
        
    }
    else {
         ("Location:input.php?error=missing_field&field=" . $validasi);
    }
    exit();
    
}