<?php
    //koneksi database

    $conn = mysqli_connect("localhost","root","","sungai");

    //baca data dari tabel sensor
    $sql = mysqli_query($conn,"select * from monitoring order by id desc");

    $data = mysqli_fetch_array($sql);

    $elektrik = $data['elektrik'];

    //uji

    if($elektrik == "")$elektrik =0;

    echo $elektrik;

?>