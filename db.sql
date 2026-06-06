-- Tabel Users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    confirm_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Petugas
CREATE TABLE petugas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_petugas VARCHAR(100) NOT NULL,
    pekerjaan ENUM('Dokter', 'Perekam Medis', 'Perawat') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Pasien
CREATE TABLE pasien (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL UNIQUE,
    nama_pasien VARCHAR(100),
    tanggal_masuk DATE,
    tanggal_lahir DATE,
    umur INT,
    jenis_kelamin ENUM('Pria','Wanita'),
    no_sep VARCHAR(50),
    no_peserta_bpjs VARCHAR(50),
    ktp CHAR(16),
    jaminan ENUM('BPJS PBI','BPJS Ketenagakerjaan','BPJS Mandiri'),
    no_telepon VARCHAR(20),
    poliklinik ENUM('Umum','Gigi','Poli dalam','Poli THT','KIA','Poli Saraf'),
    cara_masuk ENUM('BPJS','UMUM','Datang Sendiri','Rujukan'),
    id_petugas INT,
    tanggal_monitoring DATE,
    billing ENUM('Lengkap','Tidak Lengkap'),
    sbpk ENUM('Lengkap','Tidak Lengkap'),
    lip ENUM('Lengkap','Tidak Lengkap'),
    penunjang ENUM('Lengkap','Tidak Lengkap'),
    presentase DECIMAL(5,2),
    status ENUM('Lengkap','Tidak Lengkap'),
    penyerahan DATE,
    pengembalian DATE,
    lama VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_petugas) REFERENCES petugas(id)
);

-- Tabel Laporan
CREATE TABLE laporan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_rm VARCHAR(20) NOT NULL,
    nama_pasien VARCHAR(100),
    tanggal_masuk DATE,
    id_dokter INT,
    tanggal_monitoring DATE,
    id_petugas INT,
    presentase DECIMAL(5,2),
    status ENUM('Lengkap','Tidak Lengkap'),
    penyerahan DATE,
    pengembalian DATE,
    lama VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (no_rm) REFERENCES pasien(no_rm),
    FOREIGN KEY (id_dokter) REFERENCES petugas(id),
    FOREIGN KEY (id_petugas) REFERENCES petugas(id)
);