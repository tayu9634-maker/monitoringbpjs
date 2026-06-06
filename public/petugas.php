<?php
session_start();
include("../config/database.php");

// --- CREATE / UPDATE ---
if (isset($_POST['save'])) {

    $id = $_POST['id'] ?? '';
    $nama_petugas = $_POST['nama_petugas'];
    $pekerjaan = $_POST['pekerjaan'];

    if ($id != '') {

        $sql = "UPDATE petugas 
                SET nama_petugas='$nama_petugas',
                    pekerjaan='$pekerjaan'
                WHERE id='$id'";

    } else {

        $sql = "INSERT INTO petugas (nama_petugas, pekerjaan)
                VALUES ('$nama_petugas','$pekerjaan')";
    }

    mysqli_query($conn, $sql);

    header("Location: petugas.php");
    exit;
}

// --- DELETE ---
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM petugas WHERE id='$id'");

    header("Location: petugas.php");
    exit;
}

// --- SEARCH ---
$search = $_GET['search'] ?? '';

$query = "SELECT * FROM petugas
          WHERE nama_petugas LIKE '%$search%'
          OR pekerjaan LIKE '%$search%'
          ORDER BY id ASC";

$result = mysqli_query($conn, $query);

// --- EDIT ---
$edit = null;

if (isset($_GET['edit'])) {

    $id_edit = $_GET['edit'];

    $edit_query = mysqli_query($conn, "SELECT * FROM petugas WHERE id='$id_edit'");

    $edit = mysqli_fetch_assoc($edit_query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Petugas</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#eef2f7;
    padding:30px;
}

/* CONTAINER */

.container{
    max-width:1200px;
    margin:auto;
}

/* HEADER */

.header{
    background:linear-gradient(135deg,#2563eb,#1e3a8a);
    padding:30px;
    border-radius:15px;
    color:white;
    margin-bottom:30px;
    box-shadow:0 8px 25px rgba(0,0,0,0.15);
}

.header h1{
    font-size:35px;
    margin-bottom:10px;
}

.header p{
    opacity:0.9;
}

/* TOP BUTTON */

.top-menu{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.top-menu a{
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    font-size:14px;
    transition:0.3s;
}

.top-menu a:hover{
    background:#1d4ed8;
}

/* CARD */

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

/* SEARCH */

.search-box{
    display:flex;
    gap:10px;
}

.search-box input{
    flex:1;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}

.search-box button{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-weight:bold;
}

/* FORM */

.form-grid{
    display:grid;
    grid-template-columns:150px 1fr;
    gap:15px;
    align-items:center;
}

.form-grid input,
.form-grid select{
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}

/* BUTTON */

.button-group{
    margin-top:20px;
    text-align:right;
}

.button-group button{
    border:none;
    padding:12px 22px;
    border-radius:8px;
    color:white;
    cursor:pointer;
    font-weight:bold;
    margin-left:10px;
}

.btn-save{
    background:#16a34a;
}

.btn-reset{
    background:#6b7280;
}

/* TABLE */

.table-card{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#2563eb;
    color:white;
    padding:14px;
    text-align:left;
    font-size:14px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
    font-size:14px;
}

table tr:hover{
    background:#f5f7fb;
}

/* AKSI */

.action-btn{
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
    color:white;
    font-size:13px;
    margin-right:5px;
}

.btn-edit{
    background:#f59e0b;
}

.btn-delete{
    background:#ef4444;
}

/* RESPONSIVE */

@media(max-width:768px){

    .form-grid{
        grid-template-columns:1fr;
    }

    .top-menu{
        flex-direction:column;
        gap:15px;
        align-items:flex-start;
    }

}

</style>
</head>

<body>

<div class="container">

<!-- HEADER -->
<div class="header">
    <h1>Data Petugas</h1>
    <p>Sistem Monitoring Kelengkapan Berkas Klaim Rawat Jalan</p>
</div>

<!-- MENU -->
<div class="top-menu">

    <a href="dashboard.php">
        ← Kembali ke Dashboard
    </a>

</div>

<!-- SEARCH -->
<div class="card">

<form method="GET">

<div class="search-box">

<input type="text"
name="search"
placeholder="Cari nama petugas atau pekerjaan..."
value="<?= $search ?>">

<button type="submit">
Cari
</button>

</div>

</form>

</div>

<!-- FORM -->
<div class="card">

<form method="POST">

<input type="hidden"
name="id"
value="<?= $edit['id'] ?? '' ?>">

<div class="form-grid">

<label>Nama Petugas</label>

<input type="text"
name="nama_petugas"
required
value="<?= $edit['nama_petugas'] ?? '' ?>">

<label>Pekerjaan</label>

<select name="pekerjaan" required>

<option value="Dokter"
<?= (($edit['pekerjaan'] ?? '') == 'Dokter') ? 'selected' : '' ?>>
Dokter
</option>

<option value="Perekam Medis"
<?= (($edit['pekerjaan'] ?? '') == 'Perekam Medis') ? 'selected' : '' ?>>
Perekam Medis
</option>

<option value="Perawat"
<?= (($edit['pekerjaan'] ?? '') == 'Perawat') ? 'selected' : '' ?>>
Perawat
</option>

</select>

</div>

<div class="button-group">

<button type="submit"
name="save"
class="btn-save">
Simpan
</button>

<button type="reset"
class="btn-reset">
Batal
</button>

</div>

</form>

</div>

<!-- TABLE -->
<div class="card table-card">

<table>

<tr>
    <th>ID</th>
    <th>Nama Petugas</th>
    <th>Pekerjaan</th>
    <th>Dibuat</th>
    <th>Diupdate</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['nama_petugas']; ?></td>

<td><?= $row['pekerjaan']; ?></td>

<td><?= $row['created_at']; ?></td>

<td><?= $row['updated_at']; ?></td>

<td>

<a href="petugas.php?edit=<?= $row['id']; ?>"
class="action-btn btn-edit">
Edit
</a>

<a href="petugas.php?delete=<?= $row['id']; ?>"
class="action-btn btn-delete"
onclick="return confirm('Yakin hapus data?')">
Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>