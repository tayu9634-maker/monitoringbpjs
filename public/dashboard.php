<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Monitoring BPJS</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f1f5f9;
}

/* ===== HEADER ===== */
.header{
    width:100%;
    background:linear-gradient(135deg,#2563eb,#1e40af);
    padding:40px 20px;
    color:white;
    border-bottom-left-radius:25px;
    border-bottom-right-radius:25px;
    box-shadow:0 4px 15px rgba(0,0,0,0.2);
}

.header-content{
    max-width:1200px;
    margin:auto;
}

.header h1{
    font-size:38px;
    margin-bottom:10px;
}

.header p{
    font-size:17px;
    opacity:0.9;
}

/* ===== MENU CARD ===== */
.container{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

.card-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

.card{
    background:white;
    border-radius:18px;
    padding:30px 25px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    transition:0.3s;
    text-decoration:none;
    color:#111;
    border:1px solid #e5e7eb;
}

.card:hover{
    transform:translateY(-6px);
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.icon{
    width:70px;
    height:70px;
    border-radius:15px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    margin-bottom:20px;
}

/* WARNA ICON */
.blue{
    background:#dbeafe;
    color:#2563eb;
}

.green{
    background:#dcfce7;
    color:#16a34a;
}

.orange{
    background:#ffedd5;
    color:#ea580c;
}

.red{
    background:#fee2e2;
    color:#dc2626;
}

.card h2{
    font-size:24px;
    margin-bottom:10px;
}

.card p{
    font-size:14px;
    color:#666;
    line-height:1.6;
}

/* ===== FOOTER ===== */
.footer{
    text-align:center;
    margin-top:50px;
    color:#777;
    font-size:14px;
    padding-bottom:20px;
}

@media(max-width:768px){

    .header h1{
        font-size:28px;
    }

}

</style>

</head>

<body>

<!-- ===== HEADER ===== -->
<div class="header">

    <div class="header-content">

        <h1>
            Selamat Datang,
            <?php echo $_SESSION['username']; ?> 👋
        </h1>

        <p>
            Sistem Informasi Monitoring Kelengkapan Berkas Klaim Rawat Jalan
        </p>

    </div>

</div>

<!-- ===== MENU ===== -->
<div class="container">

    <div class="card-grid">

        <!-- PASIEN -->
        <a href="pasien.php" class="card">

            <div class="icon blue">
                🧑‍⚕️
            </div>

            <h2>Data Pasien</h2>

            <p>
                Kelola data pasien rawat jalan,
                monitoring berkas dan status kelengkapan klaim.
            </p>

        </a>

        <!-- PETUGAS -->
        <a href="petugas.php" class="card">

            <div class="icon green">
                👨‍💼
            </div>

            <h2>Data Petugas</h2>

            <p>
                Mengelola data petugas rumah sakit,
                dokter, perawat dan perekam medis.
            </p>

        </a>

        <!-- LAPORAN -->
        <a href="laporan.php" class="card">

            <div class="icon orange">
                📊
            </div>

            <h2>Laporan</h2>

            <p>
                Melihat rekap laporan monitoring,
                presentase dan status kelengkapan berkas.
            </p>

        </a>

        <!-- LOGOUT -->
        <a href="logout.php" class="card">

            <div class="icon red">
                🚪
            </div>

            <h2>Logout</h2>

            <p>
                Keluar dari sistem aplikasi monitoring
                dan kembali ke halaman login.
            </p>

        </a>

    </div>

    <div class="footer">
        © 2026 Monitoring BPJS Rawat Jalan
    </div>

</div>

</body>
</html>