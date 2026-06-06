<?php
session_start();
include("../config/database.php");

// ================= EDIT DATA =================
$edit = null;

if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $edit_query = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id_edit'");
    $edit = mysqli_fetch_assoc($edit_query);
}

// ================= SIMPAN & UPDATE =================
if (isset($_POST['save'])) {

    $id                = $_POST['id'];
    $no_rm             = $_POST['no_rm'];
    $nama_pasien       = $_POST['nama_pasien'];
    $tanggal_masuk     = $_POST['tanggal_masuk'];
    $tanggal_lahir     = $_POST['tanggal_lahir'];
    $umur              = $_POST['umur'];
    $jenis_kelamin     = $_POST['jenis_kelamin'];
    $no_sep            = $_POST['no_sep'];
    $no_peserta_bpjs   = $_POST['no_peserta_bpjs'];
    $ktp               = $_POST['ktp'];
    $jaminan           = $_POST['jaminan'];
    $no_telepon        = $_POST['no_telepon'];
    $poliklinik        = $_POST['poliklinik'];
    $cara_masuk        = $_POST['cara_masuk'];
    $id_petugas        = $_POST['id_petugas'];
    $tanggal_monitoring = $_POST['tanggal_monitoring'];
    $billing           = $_POST['billing'];
    $sbpk              = $_POST['sbpk'];
    $lip               = $_POST['lip'];
    $penunjang         = $_POST['penunjang'];
    $presentase        = $_POST['presentase'];
    $status            = $_POST['status'];
    $penyerahan        = $_POST['penyerahan'];
    $pengembalian      = $_POST['pengembalian'];
    $lama              = $_POST['lama'];

    if ($id == "") {

        $query = mysqli_query($conn, "INSERT INTO pasien (
            no_rm,
            nama_pasien,
            tanggal_masuk,
            tanggal_lahir,
            umur,
            jenis_kelamin,
            no_sep,
            no_peserta_bpjs,
            ktp,
            jaminan,
            no_telepon,
            poliklinik,
            cara_masuk,
            id_petugas,
            tanggal_monitoring,
            billing,
            sbpk,
            lip,
            penunjang,
            presentase,
            status,
            penyerahan,
            pengembalian,
            lama
        )

        VALUES
        (
            '$no_rm',
            '$nama_pasien',
            '$tanggal_masuk',
            '$tanggal_lahir',
            '$umur',
            '$jenis_kelamin',
            '$no_sep',
            '$no_peserta_bpjs',
            '$ktp',
            '$jaminan',
            '$no_telepon',
            '$poliklinik',
            '$cara_masuk',
            '$id_petugas',
            '$tanggal_monitoring',
            '$billing',
            '$sbpk',
            '$lip',
            '$penunjang',
            '$presentase',
            '$status',
            '$penyerahan',
            '$pengembalian',
            '$lama'
        )");
        if(!$query){
           die(mysqli_error($conn));
        }

    } else {

        mysqli_query($conn, "UPDATE pasien SET

            no_rm='$no_rm',
            nama_pasien='$nama_pasien',
            tanggal_masuk='$tanggal_masuk',
            tanggal_lahir='$tanggal_lahir',
            umur='$umur',
            jenis_kelamin='$jenis_kelamin',
            no_sep='$no_sep',
            no_peserta_bpjs='$no_peserta_bpjs',
            ktp='$ktp',
            jaminan='$jaminan',
            no_telepon='$no_telepon',
            poliklinik='$poliklinik',
            cara_masuk='$cara_masuk',
            id_petugas='$id_petugas',
            tanggal_monitoring='$tanggal_monitoring',
            billing='$billing',
            sbpk='$sbpk',
            lip='$lip',
            penunjang='$penunjang',
            presentase='$presentase',
            status='$status',
            penyerahan='$penyerahan',
            pengembalian='$pengembalian',
            lama='$lama'

            WHERE id='$id'
        ");
    }

    header("Location: pasien.php");
}

// ================= HAPUS =================
if (isset($_GET['hapus'])) {

    $hapus = $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM pasien WHERE id='$hapus'");

    header("Location: pasien.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="table-title">
    Daftar Data Pasien
</div>
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f1f5f9;
    padding:30px;
    color:#333;
}

/* CONTAINER */
.container{
    max-width:1200px;
    margin:auto;
    background:#ffffff;
    border-radius:16px;
    padding:35px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* TOP BUTTON */
.top-button{
    margin-bottom:25px;
}

.top-button a{
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-size:14px;
    transition:0.3s;
}

.top-button a:hover{
    background:#1e40af;
}

/* TITLE */
.title{
    text-align:center;
    font-size:28px;
}

/* GRID */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,minmax(300px,500px));
    justify-content: center;
    gap:20px;
}

/* CARD FORM */
.form-column{
    background:#f8fafc;
    padding:25px;
    border-radius:12px;
    border:1px solid #e2e8f0;
}

/* FORM GROUP */
.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#334155;
}

.form-group input,
.form-group select{
    width:100%;
    max-width: 100%;
    padding:10px 12px;
    
}

.form-group input:focus,
.form-group select:focus{
    border-color:#2563eb;
    outline:none;
    box-shadow:0 0 0 3px rgba(37,99,235,0.15);
}

/* RADIO */
.radio-group{
    display:flex;
    gap:25px;
    margin-top:5px;
}

/* BUTTON */
.button-group{
    text-align:center;
    margin-top:30px;
}

.button-group button{
    border:none;
    padding:12px 24px;
    border-radius:8px;
    color:white;
    font-weight:600;
    cursor:pointer;
    margin:5px;
    transition:0.3s;
    font-size:14px;
}

.btn-save{
    background:#22c55e;
}

.btn-save:hover{
    background:#16a34a;
}

.btn-edit{
    background:#f59e0b;
}

.btn-edit:hover{
    background:#d97706;
}

.btn-delete{
    background:#ef4444;
}

.btn-delete:hover{
    background:#dc2626;
}

.btn-cancel{
    background:#64748b;
}

.btn-cancel:hover{
    background:#475569;
}

/* TABLE */
.table-title{
    margin-top:45px;
    margin-bottom:20px;
    font-size:24px;
    font-weight:700;
    color:#1e293b;
}

table{
    width:100%;
    max-width: 1100px;
    margin: auto;
}

table th{
    background:#2563eb;
    color:white;
    padding:14px;
    font-size:14px;
    text-align:left;
}

table td{
    padding:14px;
    border-bottom:1px solid #e2e8f0;
    font-size:14px;
}

table tr:hover{
    background:#f8fafc;
}

/* ACTION BUTTON */
.action-btn{
    padding:8px 14px;
    border:none;
    border-radius:6px;
    color:white;
    cursor:pointer;
    font-size:12px;
}

.edit-btn{
    background:#f59e0b;
}

.delete-btn{
    background:#ef4444;
}

/* RESPONSIVE */
@media(max-width:900px){

    body{
        padding:15px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .title{
        font-size:28px;
    }

}

</style>
<script>

// ================= HITUNG UMUR =================
function hitungUmur(){

    let tgl = document.getElementById("tanggal_lahir").value;

    if(tgl){

        let lahir = new Date(tgl);
        let today = new Date();

        let umur = today.getFullYear() - lahir.getFullYear();

        document.getElementById("umur").value = umur;
    }
}

// ================= HITUNG PRESENTASE =================
function hitungPresentase(){

    let fields = ['billing','sbpk','lip','penunjang'];

    let lengkap = 0;

    fields.forEach(function(item){

        let value = document.getElementById(item).value;

        if(value == "Lengkap"){
            lengkap++;
        }

    });

    let persen = (lengkap / fields.length) * 100;

    document.getElementById("presentase").value = persen;

    if(lengkap == 4){
        document.getElementById("status").value = "Lengkap";
    }else{
        document.getElementById("status").value = "Tidak Lengkap";
    }
}

// ================= HITUNG LAMA =================
function hitungLama(){

    let penyerahan = document.getElementById("penyerahan").value;
    let pengembalian = document.getElementById("pengembalian").value;

    if(penyerahan && pengembalian){

        let tgl1 = new Date(penyerahan);
        let tgl2 = new Date(pengembalian);

        let selisih = Math.floor((tgl2 - tgl1) / (1000 * 60 * 60 * 24));

        document.getElementById("lama").value = selisih + " Hari";
    }
}

</script>

</head>

<body>

<div class="container">

<div class="top-button">
    <a href="dashboard.php">Kembali ke Dashboard</a>
</div>

<div class="title">
    Data Pasien Rawat Jalan
</div>
<form method="POST">

<input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

<div class="form-grid">

<!-- ================= KOLOM KIRI ================= -->
<div class="form-column">

<div class="form-group">
<label>No. RM:</label>
<input type="text" name="no_rm" maxlength="6" required
value="<?= $edit['no_rm'] ?? '' ?>">
</div>

<div class="form-group">
<label>Nama Pasien:</label>
<input type="text" name="nama_pasien"
value="<?= $edit['nama_pasien'] ?? '' ?>">
</div>

<div class="form-group">
<label>Tanggal Masuk:</label>
<input type="date" name="tanggal_masuk"
value="<?= $edit['tanggal_masuk'] ?? '' ?>">
</div>

<div class="form-group">
<label>Tanggal Lahir:</label>
<input type="date" name="tanggal_lahir" id="tanggal_lahir"
onchange="hitungUmur()"
value="<?= $edit['tanggal_lahir'] ?? '' ?>">
</div>

<div class="form-group">
<label>Umur:</label>
<input type="text" name="umur" id="umur" readonly
value="<?= $edit['umur'] ?? '' ?>">
</div>

<div class="form-group">

<label>Jenis Kelamin:</label>

<div class="radio-group">

<label>
<input type="radio" name="jenis_kelamin" value="Pria"> Pria
</label>

<label>
<input type="radio" name="jenis_kelamin" value="Wanita"> Wanita
</label>

</div>

</div>

<div class="form-group">
<label>No SEP</label>
<input type="text" name="no_sep"
value="<?= $edit['no_sep'] ?? '' ?>">
</div>

<div class="form-group">
<label>No Peserta BPJS</label>
<input type="text" name="no_peserta_bpjs"
value="<?= $edit['no_peserta_bpjs'] ?? '' ?>">
</div>

<div class="form-group">
<label>KTP</label>
<input type="text" name="ktp" maxlength="16"
value="<?= $edit['ktp'] ?? '' ?>">
</div>

<div class="form-group">
<label>Jaminan</label>
<select name="jaminan">
<option value="BPJS PBI">BPJS PBI</option>
<option value="BPJS Ketenagakerjaan">BPJS Ketenagakerjaan</option>
<option value="BPJS Mandiri">BPJS Mandiri</option>
</select>
</div>

<div class="form-group">
<label>No Telepon</label>
<input type="text" name="no_telepon"
value="<?= $edit['no_telepon'] ?? '' ?>">
</div>

<div class="form-group">
<label>Poliklinik</label>
<select name="poliklinik">
<option value="Umum">Umum</option>
<option value="Gigi">Gigi</option>
<option value="THT">THT</option>
<option value="Anak">Anak</option>
<option value="Jiwa">Jiwa</option>
<option value="Jantung">Jantung</option>
<option value="Saraf">Saraf</option>
<option value="Orthopedi">Orthopedi</option>
</select>
</div>

<div class="form-group">
<label>Cara Masuk</label>
<select name="cara_masuk">
<option value="BPJS">BPJS</option>
<option value="UMUM">UMUM</option>
<option value="Datang Sendiri">Datang Sendiri</option>
<option value="Rujukan">Rujukan</option>
</select>
</div>

</div>


<!-- ================= KOLOM KANAN ================= -->
<div class="form-column">

<div class="form-group">
<label>ID Petugas</label>

<select name="id_petugas">

<option value="">-- Pilih Petugas --</option>

<?php

$petugas = mysqli_query($conn,"SELECT * FROM petugas");

while($p = mysqli_fetch_array($petugas)){

?>

<option value="<?= $p['id']; ?>">
<?= $p['id']; ?> - <?= $p['nama_petugas']; ?>
</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Tanggal Monitoring</label>
<input type="date" name="tanggal_monitoring"
value="<?= $edit['tanggal_monitoring'] ?? '' ?>">
</div>

<div class="form-group">
<label>Billing</label>
<select name="billing" id="billing" onchange="hitungPresentase()">
<option value="Lengkap">Lengkap</option>
<option value="Tidak Lengkap">Tidak Lengkap</option>
</select>
</div>

<div class="form-group">
<label>SBPK</label>
<select name="sbpk" id="sbpk" onchange="hitungPresentase()">
<option value="Lengkap">Lengkap</option>
<option value="Tidak Lengkap">Tidak Lengkap</option>
</select>
</div>

<div class="form-group">
<label>LIP</label>
<select name="lip" id="lip" onchange="hitungPresentase()">
<option value="Lengkap">Lengkap</option>
<option value="Tidak Lengkap">Tidak Lengkap</option>
</select>
</div>

<div class="form-group">
<label>Penunjang</label>
<select name="penunjang" id="penunjang" onchange="hitungPresentase()">
<option value="Lengkap">Lengkap</option>
<option value="Tidak Lengkap">Tidak Lengkap</option>
</select>
</div>

<div class="form-group">
<label>Presentase</label>
<input type="text" name="presentase" id="presentase" readonly>
</div>

<div class="form-group">
<label>Status</label>
<input type="text" name="status" id="status" readonly>
</div>

<div class="form-group">
<label>Penyerahan</label>
<input type="date" name="penyerahan" id="penyerahan"
onchange="hitungLama()">
</div>

<div class="form-group">
<label>Pengembalian</label>
<input type="date" name="pengembalian" id="pengembalian"
onchange="hitungLama()">
</div>

<div class="form-group">
<label>Lama</label>
<input type="text" name="lama" id="lama" readonly>
</div>

</div>

</div>

<!-- KOLOM KANAN -->
<div class="form-column"></div>
<div class="button-group">

<button type="submit" name="save" class="btn-save">
SIMPAN
</button>

<button type="submit" class="btn-edit">
EDIT
</button>

<a href="pasien.php?hapus=<?= $edit['id']; ?>"
 onclick="return confirm('Yakin hapus data?')">

 <button type="button" class="btn-delete">HAPUS</button>

 </a>
 <a href="pasien.php">

 <button type="button" class="btn-cancel">BATAL</button>
</a>
</div>
</form>

<!-- ================= TABEL DATA ================= -->

<h2 style="margin-top:40px;">Daftar Data Pasien</h2>

<table>

<tr>
<th>No</th>
<th>No RM</th>
<th>Nama Pasien</th>
<th>Poliklinik</th>
<th>Status</th>
<th>Presentase</th>
<th>Aksi</th>
</tr>


<?php

$no = 1;

$data = mysqli_query($conn,"SELECT * FROM pasien ORDER BY id ASC");

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?= $no++; ?></td>
<td><?= $d['no_rm']; ?></td>
<td><?= $d['nama_pasien']; ?></td>
<td><?= $d['poliklinik']; ?></td>
<td><?= $d['status']; ?></td>
<td><?= number_format($d['presentase'], 0); ?>%</td>

<td>

<a href="pasien.php?edit=<?= $d['id']; ?>">
<button class="action-btn-edit-btn">Edit</button>
</a>

<a href="pasien.php?hapus=<?= $d['id']; ?>" onclick="return confirm('Yakin hapus data?')">
<button class="action-btn-delete-btn">Hapus</button>
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>