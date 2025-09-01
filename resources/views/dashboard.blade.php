<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    
    <style>
        /* CSS tambahan untuk membungkus teks panjang di dalam sel tabel */
        #excelTable td {
            white-space: normal; /* Memungkinkan teks untuk terbungkus ke baris baru */
            word-break: break-word; /* Memastikan kata yang sangat panjang juga dapat terputus */
            max-width: 250px; /* Batasi lebar sel untuk memaksa pembungkusan */
            vertical-align: middle;
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
                min-width: 800px; /* Minimum width untuk memaksa scroll horizontal */
                margin-bottom: 0;
            }
            
            /* Wrapper DataTables responsive */
            .dataTables_wrapper {
                overflow-x: auto;
                width: 100%;
            }
            
            /* Pastikan filter dan pagination tetap terlihat */
            .dataTables_filter,
            .dataTables_length,
            .dataTables_info,
            .dataTables_paginate {
                margin: 10px 0;
            }
            
            /* Tombol aksi tetap terlihat dengan baik */
            .d-flex.gap-1 {
                white-space: nowrap;
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

        /* Custom button styling */
        #btnTambah {
            background-color: #198754;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        #btnTambah:hover {
            background-color: #157347;
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
            }

            .legend-container {
                margin-left: 0;
                justify-content: center;
                order: 2;
            }

            .dataTables_filter input {
                margin-left: 0 !important;
            }
        }

        /* Action buttons styling */
        .tabledit-toolbar,
        .d-flex.gap-1 {
            display: inline-flex !important;
            align-items: center;
            gap: 4px; /* jarak kecil antar tombol */
        }

        /* Standardize size of all action buttons */
        .btn-aksi,
        .tabledit-edit-button,
        .tabledit-save-button,
        .tabledit-confirm-button,
        .tabledit-delete-button,
        .tabledit-restore-button,
        .btnHapus {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 30px;      /* ukuran konsisten */
            height: 30px;     /* ukuran konsisten */
            padding: 0;
            margin: 0;
            border-radius: 6px;
            font-size: 14px;  /* ikon pas */
            line-height: 1;
            color: #fff !important;
            border: none !important;
            cursor: pointer;
        }

        /* Button colors */
        .btnHapus,
        .tabledit-delete-button {
            background-color: #dc3545 !important;
        }

        .btnHapus:hover,
        .tabledit-delete-button:hover {
            background-color: #bb2d3b !important;
        }

        .tabledit-edit-button {
            background-color: #0d6efd !important;
        }

        .tabledit-edit-button:hover {
            background-color: #0b5ed7 !important;
        }

        .tabledit-save-button {
            background-color: #198754 !important;
        }

        .tabledit-save-button:hover {
            background-color: #157347 !important;
        }

        /* Custom Status Modal Styling */
        .status-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .status-modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .status-modal-content {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            max-width: 400px;
            width: 90%;
            text-align: center;
            transform: translateY(-20px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .status-modal-overlay.show .status-modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .status-modal-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .status-modal-title {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .status-modal-message {
            font-size: 1rem;
            color: #4b5563;
        }

        .status-modal-success .status-modal-icon {
            color: #10b981;
        }

        .status-modal-error .status-modal-icon {
            color: #ef4444;
        }

        .status-modal-button {
            margin-top: 1.5rem;
            background-color: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .status-modal-button:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')
    <div class="container-fluid p-4">

        <!-- Custom Status Modal -->
        <div id="statusModal" class="status-modal-overlay hidden">
            <div class="status-modal-content rounded-xl">
                <div class="status-modal-icon"></div>
                <div class="status-modal-title"></div>
                <div class="status-modal-message"></div>
                <button id="closeStatusModal" class="status-modal-button">OK</button>
            </div>
        </div>
        
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
                    <div class="d-flex gap-1">
                       <!-- <button class="btn btn-sm btn-primary btnEdit" data-id="{{ $row[0] }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        -->
                        <button class="btn btn-sm btnHapus"
                            data-id="{{ $row[0] }}"
                            data-nama="{{ $row[1] }}"
                            title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
            </div>
    @else
    <div class="d-flex justify-content-between align-items-center mt-4" style="max-width: 700px; margin: 0 auto;">
        <div class="alert alert-info text-center flex-grow-1 mb-0">
            <i class="fas fa-info-circle me-2"></i>
            Tidak ada data untuk ditampilkan.
        </div>
        <button id="btnTambah" type="button" class="btn btn-success ms-3">
            <i class="fas fa-plus me-2"></i> Tambah Data
        </button>
    </div>
@endif

    </div>

    <!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
             <!-- Header -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="tambahModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Data
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <!-- Body -->
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="Nama" required>
                            </div>

                            <!-- KPJ -->
                            <div class="col-md-6 mb-3">
                                <label for="kpj" class="form-label">KPJ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kpj" name="KPJ" required>
                            </div>

                        <!-- Jenis Klaim -->
                        <div class="col-md-6 mb-3">
                            <label for="jenisKlaim" class="form-label">Jenis Klaim <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="jenisKlaim" name="Jenis Klaim" required>
                        </div>

                        <!-- Tanggal Terima -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggalTerima" class="form-label">Tanggal Terima <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalTerima" name="Tanggal Terima" required>
                        </div>

                        <!-- Tanggal Rekam -->
                        <div class="col-md-6 mb-3">
                            <label for="tanggalRekam" class="form-label">Tanggal Rekam <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalRekam" name="Tanggal Rekam" required>
                        </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="Status">
                                    <option value="Diterima">Pending</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Pending">Diterima</option>
                                </select>
                            </div>

                            <!-- Tanggal Meninggal -->
                            <div class="col-md-6 mb-3">
                                <label for="tanggalMeninggal" class="form-label">Tanggal Meninggal</label>
                                <input type="date" class="form-control" id="tanggalMeninggal" name="Tanggal Meninggal">
                            </div>

                            <!-- Keterangan -->
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="Keterangan">
                            </div>

                            <!-- Alamat -->
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="Alamat" rows="2"></textarea>
                            </div>

                            <!-- Petugas -->
                            <div class="col-12 mb-3">
                                <label for="petugas" class="form-label">Petugas</label>
                                <input type="text" class="form-control" id="petugas" name="Petugas">
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Batal
                    </button>
                    <button type="submit" form="formTambah" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalHapusLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data <strong id="hapusNama"></strong>?</p>
                    <input type="hidden" id="hapusId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">
                        <i class="fas fa-trash-alt me-1"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>

    <script>
        $(document).ready(function () {
            let modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'));
            
            // Reusable function to show the status modal
            function showStatusModal(type, title, message) {
                const modal = $('#statusModal');
                const content = modal.find('.status-modal-content');
                const icon = modal.find('.status-modal-icon');
                const titleEl = modal.find('.status-modal-title');
                const messageEl = modal.find('.status-modal-message');

                // Set icon and colors based on type
                if (type === 'success') {
                    icon.html('<i class="fas fa-check-circle"></i>').parent().removeClass('status-modal-error').addClass('status-modal-success');
                } else {
                    icon.html('<i class="fas fa-times-circle"></i>').parent().removeClass('status-modal-success').addClass('status-modal-error');
                }
                
                titleEl.text(title);
                messageEl.text(message);
                
                modal.removeClass('hidden').addClass('show');
            }

            // Function to close the status modal
            function closeStatusModal() {
                $('#statusModal').removeClass('show').addClass('hidden');
            }

            // Close status modal on button click
            $('#closeStatusModal').on('click', closeStatusModal);

            // Click delete button
            $(document).on('click', '.btnHapus', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                $('#hapusId').val(id);
                $('#hapusNama').text(nama);

                modalHapus.show();
            });

            // Confirm delete
            $('#btnKonfirmasiHapus').on('click', function () {
                const id = $('#hapusId').val();
                
                // Show a loading/processing message (optional, but good UX)
                closeStatusModal(); 
                modalHapus.hide();

                $.ajax({
                    url: '{{ route("excel.delete") }}',
                    method: 'POST',
                    data: {
                        ID: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            showStatusModal('success', 'Berhasil Dihapus!', response.message);
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showStatusModal('error', 'Gagal!', response.message);
                        }
                    },
                    error: function () {
                        showStatusModal('error', 'Gagal!', 'Gagal menghapus data. Terjadi kesalahan.');
                    }
                });
            });

            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Function pesan alert
            function showMessage(message, type) {
                var alertClass = type === 'success' ? 'alert-success' : 'alert-error';
                $('#message').html('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>');

                setTimeout(function () {
                    $('.alert').alert('close');
                }, 5000);
            }

            // DataTable init
            if ($('#excelTable').length) {
                var table = $('#excelTable').DataTable({
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    order: [[0, "asc"]],
                    scrollX: true, // Enable horizontal scrolling
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

                // Add "Tambah Data" button and legend
                $('.dataTables_filter').append(`
                    <div class="legend-container">
                        <div class="d-flex align-items-center gap-2">
                            <span style="display:inline-block;width:20px;height:20px;background:#CC0000;border:1px solid #000;"></span>
                            <small>≤ 6 bulan</small>
                            <span style="display:inline-block;width:20px;height:20px;background:#FFFF00;border:1px solid #000;"></span>
                            <small>> 6 bulan</small>
                        </div>
                        <button id="btnTambah" type="button" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Data
                        </button>
                    </div>
                `);
            }


            // Open add data modal
            function openModal() {
                let lastNo = 0;
                $('#excelTable tbody tr').each(function () {
                    let noVal = parseInt($(this).find('td').eq(1).text());
                    if (!isNaN(noVal) && noVal > lastNo) {
                        lastNo = noVal;
                    }
                });
                $('#noField').val(lastNo + 1);

                const modal = new bootstrap.Modal(document.getElementById('tambahModal'));
                modal.show();
            }

            $(document).on('click', '#btnTambah', function () {
                openModal();
            });

            // Submit add form
            $('#formTambah').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("excel.store") }}',
                    method: 'POST',
                    data: formData,
                    success: function (data) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('tambahModal'));
                        if (modal) modal.hide();
                        $('#formTambah')[0].reset();
                        
                        if (data.success) {
                            showStatusModal('success', 'Data Berhasil Ditambahkan!', 'Data Anda telah berhasil disimpan.');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            showStatusModal('error', 'Gagal Menambahkan Data!', 'Terjadi kesalahan saat menyimpan data.');
                        }
                    },
                    error: function () {
                        showStatusModal('error', 'Gagal!', 'Terjadi kesalahan saat menambahkan data.');
                    }
                });
            });

            // Tabledit inline edit
           // Init Tabledit
$('#excelTable').Tabledit({
    url: '{{ route("excel.update") }}',
    method: 'POST',
    editButton: false,
    deleteButton: false,
    saveButton: false,
    restoreButton: false,
    buttons: {}, // disable bawaan
    columns: {
        identifier: [0, "ID"],
        editable: [
            @foreach($header as $i => $col)
                @if($i > 0)
                    [{{ $i }}, "{{ addslashes($col) }}"],
                @endif
            @endforeach
        ]
    },
    onSuccess: function (data, textStatus, jqXHR) {
        if (data.success) {
            showMessage(data.message ?? 'Data berhasil diperbarui!', 'success');
        if (data.rowColor) {
                    let row = $("#excelTable tbody tr").filter(function() {
                        return $(this).find("td:first").text() == data.ID;
                    });
                    row.css("background-color", "#" + data.rowColor);
                }
            
        } else {
            showMessage(data.message ?? 'Update gagal!', 'error');
        }
    },
    onFail: function (jqXHR, textStatus, errorThrown) {
        showMessage('Gagal update data: ' + errorThrown, 'error');
    }
});


// Custom tombol Edit (toggle jadi Save)
$(document).on("click", ".btnEdit", function () {
    let id = $(this).data("id");
    let $row = $("#excelTable").find("tr").filter(function () {
        return $(this).find("td:first").text() == id;
    });

    // Kalau belum edit → masuk mode edit
    if (!$row.hasClass("editing")) {
        $row.find(".tabledit-edit-button").trigger("click");
        $row.addClass("editing");
        $(this).html('<i class="fas fa-save"></i>'); // ganti ikon jadi save
        $(this).removeClass("btn-primary").addClass("btn-success");
    } 
    // Kalau sudah edit → simpan
    else {
        $row.find(".tabledit-save-button").trigger("click");
        $row.removeClass("editing");
        $(this).html('<i class="fas fa-edit"></i>'); // balik lagi ke edit
        $(this).removeClass("btn-success").addClass("btn-primary");
    }
});

            // Reset form when modal is closed
            document.getElementById('tambahModal').addEventListener('hidden.bs.modal', function () {
                $('#formTambah')[0].reset();
            });
        });
    </script>
</body>

</html>
