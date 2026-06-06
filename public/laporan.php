<?php
session_start();
include("../config/database.php");

/*
====================================
PENCARIAN
====================================
*/

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

/*
====================================
QUERY LAPORAN
====================================
*/

$sql = "SELECT 
            pasien.id,
            pasien.no_rm,
            pasien.nama_pasien,
            pasien.tanggal_masuk,
            pasien.tanggal_monitoring,
            pasien.presentase,
            pasien.status,
            pasien.penyerahan,
            pasien.pengembalian,
            pasien.lama,
            petugas.nama_petugas
        FROM pasien
        LEFT JOIN petugas 
        ON pasien.id_petugas = petugas.id
        WHERE pasien.no_rm LIKE '%$search%'
        OR pasien.nama_pasien LIKE '%$search%'
        ORDER BY pasien.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Laporan Monitoring Pasien</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:#f1f5f9;
    padding:30px;
}

/* CONTAINER */
.container{
    max-width:1400px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* TITLE */
.title{
    text-align:center;
    font-size:32px;
    font-weight:700;
    color:#1e293b;
    margin-bottom:30px;
}

/* SEARCH */
.search-box{
    display:flex;
    justify-content:center;
    gap:12px;
    margin-bottom:30px;
    flex-wrap:wrap;
}

.search-box input{
    width:350px;
    padding:12px 15px;
    border:1px solid #cbd5e1;
    border-radius:10px;
    font-size:14px;
}

.search-box button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.search-box button:hover{
    background:#1d4ed8;
}

/* TABLE */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:1200px;
}

table th{
    background:#2563eb;
    color:white;
    padding:14px;
    text-align:center;
    font-size:14px;
}

table td{
    padding:12px;
    border-bottom:1px solid #e2e8f0;
    font-size:14px;
    text-align:center;
}

table tr:hover{
    background:#f8fafc;
}

/* STATUS */
.status-lengkap{
    background:#dcfce7;
    color:#166534;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.status-tidak{
    background:#fee2e2;
    color:#991b1b;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

/* RESPONSIVE */
@media(max-width:768px){

    .title{
        font-size:24px;
    }

    .search-box{
        flex-direction:column;
        align-items:center;
    }

    .search-box input{
        width:100%;
    }

}

</style>
</head>

<body>

<div class="container">

<div class="title">
    Laporan Monitoring Pasien
</div>

<!-- SEARCH -->
<form method="GET">

<div class="search-box">

<input type="text"
name="search"
placeholder="Cari No RM / Nama Pasien"
value="<?= $search; ?>">

<button type="submit">
Cari
</button>

</div>

</form>

<!-- TABLE -->
<div class="table-wrapper">

<table>

<tr>
<th>ID</th>
<th>No RM</th>
<th>Nama Pasien</th>
<th>Tanggal Masuk</th>
<th>Tanggal Monitoring</th>
<th>Petugas</th>
<th>Presentase</th>
<th>Status</th>
<th>Penyerahan</th>
<th>Pengembalian</th>
<th>Lama</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){

$no = 1;
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?= $no++; ?></td>

<td><?= $row['no_rm']; ?></td>

<td><?= $row['nama_pasien']; ?></td>

<td><?= $row['tanggal_masuk']; ?></td>

<td><?= $row['tanggal_monitoring']; ?></td>

<td><?= $row['nama_petugas']; ?></td>

<td><?= number_format($row['presentase'], 0); ?>%</td>

<td>

<?php if($row['status'] == "Lengkap"){ ?>

<span class="status-lengkap">
Lengkap
</span>

<?php } else { ?>

<span class="status-tidak">
Tidak Lengkap
</span>

<?php } ?>

</td>

<td><?= $row['penyerahan']; ?></td>

<td><?= $row['pengembalian']; ?></td>

<td><?= $row['lama']; ?></td>

</tr>

<?php
}
}else{
?>

<tr>
<td colspan="11">
Data tidak ditemukan
</td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>