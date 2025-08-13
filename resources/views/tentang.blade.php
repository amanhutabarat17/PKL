<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('penugasan.index') }}">BPJS Ketenagakerjaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penugasan.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('tentang') }}">Tentang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tentang Aplikasi Ini</h4>
        </div>
        <div class="card-body">
            <p>Aplikasi ini dikembangkan sebagai proyek PKL di BPJS Ketenagakerjaan Medan Kota. Tujuannya adalah untuk mempermudah manajemen dalam mengelola dan mendata penugasan karyawan untuk kunjungan ke berbagai wilayah.</p>
            <p>Sistem ini mencakup:</p>
            <ul>
                <li>Formulir untuk memasukkan data penugasan.</li>
                <li>Pilihan dinamis kabupaten dan kecamatan.</li>
                <li>Daftar penugasan yang sudah dibuat.</li>
            </ul>
            <p><strong>Pengembang:</strong> Tim PKL BPJS Ketenagakerjaan Medan Kota</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>