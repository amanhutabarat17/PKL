<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pengguna</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        /* CSS tambahan untuk membungkus teks panjang di dalam sel tabel */
        #excelTable td {
            white-space: normal;
            word-break: break-word;
            max-width: 250px;
            vertical-align: middle;
        }

        /* PERUBAHAN: Styling untuk konten di Status Modal (sekarang detail modal) */
        .details-container-modal {
            text-align: left;
            padding: 0 10px 10px 10px;
            /* Padding disesuaikan */
            background-color: #f7f7f7;
            /* Latar belakang abu-abu muda */
            border-radius: 8px;
            margin-top: 0px;
            /* Hapus margin atas agar menyatu dengan SweetAlert body */
            max-height: 450px;
            /* Tambah tinggi agar lebih banyak konten bisa dilihat */
            overflow-y: auto;
        }

        .details-container-modal:empty {
            min-height: 100px;
        }

        .details-container-modal ul {
            padding-left: 0;
            /* Hapus padding default Bootstrap list-unstyled */
            list-style: none;
        }

        /* PERUBAHAN BARU: Gaya untuk setiap kartu penugasan di dalam modal detail */
        .detail-card {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #ffffff;
            /* Latar belakang putih untuk kartu */
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s;
        }

        .detail-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .detail-card h6 {
            font-size: 1rem;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .detail-card h6 strong {
            color: #0d6efd;
            /* Biru Primary untuk Petugas */
            font-size: 1.1rem;
        }

        .detail-card h6 span {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .detail-card .list-unstyled {
            margin-top: 5px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .detail-card .list-unstyled strong {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
            /* Untuk perataan label */
            display: inline-block;
            margin-right: 5px;
        }

        /* Gaya untuk gambar bukti */
        .img-proof {
            max-height: 200px !important;
            object-fit: contain;
            /* Menggunakan contain agar gambar tidak terpotong */
            border: 1px solid #ccc;
            width: 100%;
            border-radius: 6px;
        }

        /* Tombol Unduh Foto Bukti */
        .btn-info-custom {
            background-color: #0dcaf0 !important;
            /* Cyan/Info color */
            border-color: #0dcaf0 !important;
            color: white !important;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }

        .btn-info-custom:hover {
            background-color: #0aa5c2 !important;
            border-color: #0aa5c2 !important;
            color: white !important;
            transform: translateY(-1px);
        }

        /* Gaya untuk tombol 'Tutup' SweetAlert */
        .swal2-confirm {
            background-color: #6c757d !important;
            /* Abu-abu secondary yang lebih solid */
            border: none !important;
            font-weight: 600 !important;
            padding: 10px 20px !important;
            font-size: 1.05rem !important;
        }

        .swal2-confirm:hover {
            background-color: #5a6268 !important;
        }

        /* Tampilan badge untuk status "Belum Diunggah" */
        .badge-not-uploaded {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            background-color: #dc3545;
            /* Merah */
            color: white;
            font-weight: 500;
            margin-top: 10px;
            font-size: 0.85rem;
        }

        /* SweetAlert icon adjustment */
        .swal2-icon.swal2-info {
            border-color: #0d6efd !important;
            color: #0d6efd !important;
        }

        /* Mengatasi penulisan tebal pada SweetAlert title yang default */
        .swal2-title {
            font-weight: 700 !important;
            color: #343a40 !important;
        }

        /* Mobile Responsive Table - Horizontal Scroll */
        @media (max-width: 768px) {
            .table-container {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border: 1px solid #dee2e6;
                border-radius: 0.375rem;
                margin-bottom: 1rem;
            }

            .table-container table {
                min-width: 800px;
                margin-bottom: 0;
            }

            .dataTables_wrapper {
                overflow-x: auto;
                width: 100%;
            }

            .dataTables_filter,
            .dataTables_length,
            .dataTables_info,
            .dataTables_paginate {
                margin: 10px 0;
            }

            .d-flex.gap-1 {
                white-space: nowrap;
            }

            /* RESPONSIF KHUSUS SWEETALERT MODAL DETAIL */
            .swal2-popup {
                width: 90% !important;
                /* Batasi lebar di HP */
                max-width: 450px !important;
                margin: 1em;
            }

            .swal2-content {
                padding: 0 !important;
            }

            .details-container-modal {
                max-height: 350px;
                /* Batasi tinggi sedikit lagi di HP */
                padding-bottom: 5px;
            }

            .detail-card .list-unstyled strong {
                min-width: 90px;
                /* Kurangi min-width label di HP */
                display: block;
                /* Buat deskripsi dan label berada di baris terpisah */
            }
        }

        /* Desktop - Normal behavior */
        @media (min-width: 769px) {
            .table-container {
                width: 100%;
                overflow: visible;
            }

            .table-container table {
                width: 100%;
            }

            /* Set lebar SweetAlert hanya di desktop/tablet */
            .swal2-popup {
                width: 650px;
            }
        }

        table.dataTable td {
            vertical-align: middle;
        }

        #excelTable_wrapper {
            margin-top: 20px;
        }

        /* Style for button next to search bar */
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Legend styling for mobile */
        .legend-container {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-left: auto;
        }

        @media (max-width: 768px) {
            .dataTables_filter {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
                order: 1;
                /* Pindahkan filter ke atas */
            }

            .legend-container {
                margin-left: 0;
                justify-content: center;
                order: 2;
                margin-top: 10px;
            }

            .dataTables_filter input {
                margin-left: 0 !important;
            }
        }

        /* Action buttons styling */
        .d-flex.gap-1 {
            display: inline-flex !important;
            align-items: center;
            gap: 4px;
        }

        /* Standardize size of all action buttons */
        .btn-aksi,
        .btnEdit,
        .btnMelihat {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            padding: 0;
            margin: 0;
            border-radius: 6px;
            font-size: 14px;
            line-height: 1;
            color: #fff !important;
            border: none !important;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease-in-out;
        }

        /* Hover effect */
        .btn-aksi:hover,
        .btnEdit:hover,
        .btnMelihat:hover {
            transform: scale(1.1);
        }


        /* Button colors */
        .btnEdit {
            background-color: #198754 !important; /* Warna hijau untuk proses */
        }

        .btnEdit:hover {
            background-color: #157347 !important;
        }

        .btnMelihat {
            background-color: #0d6efd !important;
        }

        .btnMelihat:hover {
            background-color: #0b5ed7 !important;
        }
    </style>
</head>

<body>

    @include('layouts.navigation')
    <div class="container-fluid p-4">

        @if(isset($error))
        <div class="alert alert-error">{{ $error }}</div>
        @endif

        @if(!empty($header) && !empty($rows))
        <div class="table-container">
            <table id="excelTable" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        @foreach($header as $head)
                        <th>{{ $head }}</th>
                        @endforeach
                        <th style="text-align: center; vertical-align: middle;"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $i => $row)
                    @php $rowColor = $rowColors[$i] ?? null; @endphp
                    <tr @if($rowColor) style="background-color:#{{ $rowColor }}" @endif>
                        @foreach($row as $cell)
                        <td>{{ $cell ?? '' }}</td>
                        @endforeach
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <!-- Tombol Melihat -->
                                <button class="btn btn-sm btnMelihat" data-id="{{ $row[0] }}" title="Melihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Tombol untuk mengubah status -->
                                <button class="btn btn-sm btnEdit" data-id="{{ $row[0] }}" title="Ubah Status">
                                    <i class="fas fa-tasks"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="d-flex justify-content-center align-items-center mt-4" style="max-width: 700px; margin: 0 auto;">
            <div class="alert alert-info text-center flex-grow-1 mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data untuk ditampilkan.
            </div>
            <!-- Tombol Tambah Data Dihilangkan -->
        </div>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // Reusable function to show toast notifications
            function showToast(title, icon = 'success') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: icon,
                    title: title
                });
            }

            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // [START] FUNGSI KONVERSI WAKTU KE WIB
            function formatLocalTime(isoString) {
                if (!isoString) return 'Tidak Ada Data Waktu';
                try {
                    const date = new Date(isoString + 'Z');

                    if (isNaN(date.getTime())) {
                        return isoString; // Fallback jika string waktu tidak valid
                    }

                    const options = {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false,
                        timeZone: 'Asia/Jakarta' // WIB (UTC+7)
                    };

                    return date.toLocaleDateString('id-ID', options);
                } catch (e) {
                    console.error("Error formatting date:", e);
                    return isoString;
                }
            }
            // [END] FUNGSI KONVERSI WAKTU KE WIB

            // FUNCTION UNTUK MEMFORMAT KONTEN DETAIL BARIS
            function format(penugasans) {
                if (!penugasans || penugasans.length === 0) {
                    return '<div class="text-center p-3 text-muted"><i class="fas fa-info-circle me-1"></i> Belum ada riwayat penugasan yang diunggah untuk data ini.</div>';
                }

                let htmlContent = '';

                penugasans.forEach(function(penugasan, index) {
                    const localTime = formatLocalTime(penugasan.tanggal_unggah);

                    const fileLink = penugasan.file_path ?
                        `<a href="/storage/${penugasan.file_path}" target="_blank" class="btn-info-custom"><i class="fas fa-download me-1"></i> Unduh Foto Bukti</a>` :
                        `<span class="badge-not-uploaded"><i class="fas fa-times-circle me-1"></i> File Bukti Belum Diunggah</span>`;

                    const imageHtml = penugasan.file_path ?
                        `<div class="mt-3 text-center"><img src="/storage/${penugasan.file_path}" alt="Foto Bukti" class="img-fluid mt-2 rounded-lg img-proof shadow-sm"></div>` :
                        '';

                    htmlContent += `
                        <div class="detail-card">
                            <h6>
                                <strong>Petugas: ${penugasan.nama_petugas || 'N/A'}</strong> 
                                <span>(${localTime} WIB)</span> 
                            </h6>
                            <ul class="list-unstyled">
                                <li><strong>Deskripsi:</strong> ${penugasan.deskripsi || 'Tidak Ada'}</li>
                                <li><strong>Alamat Lengkap:</strong> ${penugasan.alamat_lengkap || 'Tidak Ada'}</li>
                            </ul>
                            <div class="d-flex flex-column align-items-start">
                                ${fileLink}
                                ${imageHtml}
                            </div>
                        </div>
                    `;
                });

                return htmlContent;
            }

            // DataTable init
            if ($('#excelTable').length) {
                var table = $('#excelTable').DataTable({
                    pageLength: 25,
                    lengthMenu: [
                        [5, 10, 20, 50, -1],
                        [5, 10, 20, 50, "Semua"]
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    scrollX: true,
                    responsive: true,
                    language: {
                        search: "Pencarian:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });

                // LEGEND (TOMBOL DOWNLOAD DAN TAMBAH DIHILANGKAN)
                var legendHtml = '<div class="legend-container d-flex align-items-center gap-3 ms-3">' +
                    '<div class="d-flex align-items-center gap-2">' +
                    '<span style="display:inline-block;width:20px;height:20px;background:#CC0000;border:1px solid #000;"></span>' +
                    '<small>&gt; 6 bulan</small>' +
                    '<span style="display:inline-block;width:20px;height:20px;background:#FFFF00;border:1px solid #000;"></span>' +
                    '<small>&le; 6 bulan</small>' +
                    '<span style="display:inline-block;width:20px;height:20px;background:#32CD32;border:1px solid #000;"></span>' +
                    '<small>Diterima</small>' +
                    '</div>' +
                    '</div>';

                $('.dataTables_filter').append(legendHtml);
            }

            // --- Logika Perubahan Status ---
            $(document).on("click", ".btnEdit", async function(e) {
                e.preventDefault();
                const id = $(this).data("id");
                const $row = $(this).closest('tr');
                const currentRowStatus = $row.find('td:eq(6)').text().trim(); // Asumsi status ada di kolom ke-7 (index 6)

                const {
                    value: newStatus
                } = await Swal.fire({
                    title: 'Ubah Status Data',
                    input: 'select',
                    inputOptions: {
                        'Pending': 'Pending',
                        'Sedang Diproses': 'Sedang Diproses',
                        'Diterima': 'Diterima',
                        'Ditolak': 'Ditolak'
                    },
                    inputValue: currentRowStatus,
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-check"></i> Update Status',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Anda harus memilih status!'
                        }
                    }
                });

                if (newStatus) {
                    $.ajax({
                        url: '/excel/update', // Menggunakan URL update yang sama
                        method: 'POST',
                        data: {
                            ID: id,
                            Status: newStatus, // Hanya mengirim ID dan Status baru
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                showToast(response.message || 'Status berhasil diperbarui!', 'success');
                                
                                // Update data di tabel secara dinamis
                                var table = $('#excelTable').DataTable();
                                table.cell($row.find('td:eq(6)')).data(newStatus).draw(false);

                                // Update warna baris jika ada
                                if (response.rowColor) {
                                    $row.css('background-color', '#' + response.rowColor);
                                } else {
                                    $row.css('background-color', '');
                                }

                            } else {
                                showToast(response.message || 'Gagal memperbarui status!', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            showToast('Gagal terhubung ke server.', 'error');
                        }
                    });
                }
            });


            // --- Logika Melihat Detail Penugasan ---
            $(document).on('click', '.btnMelihat', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const dataId = $(this).data('id');

                Swal.fire({
                    title: 'Memuat Detail Penugasan...',
                    html: '<i class="fas fa-spinner fa-spin fa-2x text-primary"></i>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '/api/penugasan/' + dataId,
                    method: 'GET',
                    success: function(response) {
                        Swal.close();

                        if (response.success && response.penugasans && response.penugasans.length > 0) {

                            let fullDetailHtml = format(response.penugasans);
                            fullDetailHtml = `<div class="details-container-modal">${fullDetailHtml}</div>`;

                            Swal.fire({
                                title: `Detail Penugasan Data ID: ${dataId}`,
                                html: fullDetailHtml,
                                icon: 'info',
                                width: 'auto',
                                showConfirmButton: true,
                                confirmButtonText: 'Tutup'
                            });

                        } else {
                            Swal.fire({
                                title: `Detail Penugasan Data ID: ${dataId}`,
                                html: '<p>Tidak ada riwayat penugasan yang ditemukan untuk data ini.</p>',
                                icon: 'warning',
                                width: 450,
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            title: 'Gagal Memuat Data',
                            text: 'Terjadi kesalahan jaringan atau server. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>

