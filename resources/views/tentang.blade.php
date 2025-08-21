<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

 @include('layouts.navigation')

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