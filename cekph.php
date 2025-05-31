<?php
    //koneksi database

    $conn = mysqli_connect("localhost","root","","sungai");

    //baca data dari tabel sensor
    $sql = mysqli_query($conn,"select * from monitoring order by id desc");

    $data = mysqli_fetch_array($sql);

    $ph = $data['ph'];

    //uji

    if($ph == "")$ph =0;

    echo $ph;

?>