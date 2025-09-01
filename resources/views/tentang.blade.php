<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bpjs-start-color: #008080; /* Biru kehijauan tua */
            --bpjs-end-color: #009944; /* Hijau terang */
        }
        {
           --bpjs-bg-light-1: #f0fdf4;
            --bpjs-bg-light-2: #d1fae5;
        }
        body {
             font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom, var(--bpjs-bg-light-1), var(--bpjs-bg-light-2));
            background-color: #d1fae5;
            min-height: 100vh;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--bpjs-start-color), var(--bpjs-end-color)) !important;
            color: white;
            padding: 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .card-body {
            padding: 2.5rem;
            line-height: 1.8;
            color: #333;
        }

        .list-check {
            list-style-type: none;
            padding-left: 0;
        }
        
        .list-check li {
            position: relative;
            margin-bottom: 0.75rem;
            padding-left: 2rem;
        }

        .list-check li::before {
            content: "\f058"; /* FontAwesome check-circle solid */
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: var(--bpjs-end-color);
            position: absolute;
            left: 0;
            top: 0.1rem;
        }
        
        .btn-bpjs-green {
            background: linear-gradient(to right, var(--bpjs-start-color), var(--bpjs-end-color));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0, 153, 68, 0.3);
            transition: background 0.3s, transform 0.2s, box-shadow 0.3s;
        }
        
        .btn-bpjs-green:hover {
            background: linear-gradient(to right, #005f5f, #007739);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 153, 68, 0.5);
            color: white;
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px);">
    <div class="card w-100" style="max-width: 800px;">~
        <div class="card-header text-center">
            <h2 class="fw-bold mb-0">Tentang Aplikasi Ini</h2>
        </div>
        <div class="card-body">
            <p class="lead text-center mb-4">Aplikasi ini dikembangkan sebagai proyek PKL di BPJS Ketenagakerjaan Medan Kota. Tujuannya adalah untuk mempermudah manajemen dalam mengelola dan mendata penugasan karyawan untuk kunjungan ke berbagai wilayah.</p>
            
            <hr class="my-4">
            
            <h5 class="fw-bold text-center mb-3 text-secondary">Fitur Utama</h5>
            <ul class="list-check">
                <li>Formulir yang interaktif untuk memasukkan data penugasan.</li>
                <li>Pilihan dinamis kabupaten dan kecamatan yang terintegrasi.</li>
                <li>Tampilan daftar penugasan yang sudah dibuat secara terorganisir.</li>
            </ul>

            <div class="mt-5 d-flex justify-content-between align-items-center">
                <!-- Logika dinamis untuk tombol kembali -->
                <a href="{{ Auth::user()->role === 'admin' ? route('bpjs.ketenagakerjaan') : route('bpjs.ketenagakerjaanuser') }}"
                   class="btn btn-bpjs-green">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <p class="text-end text-muted mb-0"><strong>Pengembang:</strong> Tim PKL BPJS Ketenagakerjaan Medan Kota</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
