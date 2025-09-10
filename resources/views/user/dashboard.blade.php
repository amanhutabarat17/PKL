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
            white-space: normal;
            /* Memungkinkan teks untuk terbungkus ke baris baru */
            word-break: break-word;
            /* Memastikan kata yang sangat panjang juga dapat terputus */
            max-width: 250px;
            /* Batasi lebar sel untuk memaksa pembungkusan */
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
                min-width: 800px;
                /* Minimum width untuk memaksa scroll horizontal */
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
            gap: 4px;
            /* jarak kecil antar tombol */
        }

        /* Standardize size of all action buttons */
        .
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

        .hidden {
            display: none !important;
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
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $i => $row)
                            @php $rowColor = $rowColors[$i] ?? null; @endphp
                            <tr @if($rowColor) style="background-color:#{{ $rowColor }}" @endif>
                                @foreach($row as $cell)
                                    <td>{{ $cell ?? '' }}</td>
                                @endforeach
                                
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
            </div>
        @endif

    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Header -->

                <!-- Body -->
               
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" form="formTambah" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
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
            // Variabel global untuk modal instances
            let tambahModal;
            let modalHapus;

            // Initialize modals
            function initializeModals() {
                tambahModal = new bootstrap.Modal(document.getElementById('tambahModal'), {
                    backdrop: true,
                    keyboard: true
                });
                
                modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'), {
                    backdrop: true,
                    keyboard: true
                });
            }

            // Call initialize function
            initializeModals();

            // Reusable function to show the status modal
            function showStatusModal(type, title, message) {
                const modal = $('#statusModal');
                const icon = modal.find('.status-modal-icon');
                const titleEl = modal.find('.status-modal-title');
                const messageEl = modal.find('.status-modal-message');

                if (type === 'success') {
                    modal.removeClass('status-modal-error').addClass('status-modal-success');
                    icon.html('<i class="fas fa-check-circle"></i>');
                } else {
                    modal.removeClass('status-modal-success').addClass('status-modal-error');
                    icon.html('<i class="fas fa-times-circle"></i>');
                }

                titleEl.text(title);
                messageEl.text(message);

                // Show modal
                modal.removeClass('hidden').addClass('show');
            }

            // Function to close the status modal
            function closeStatusModal() {
                const modal = $('#statusModal');
                modal.removeClass('show status-modal-success status-modal-error').addClass('hidden');
            }

            // Close status modal on button click
            $('#closeStatusModal').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeStatusModal();
            });

            // Close status modal when clicking outside
            $('#statusModal').on('click', function (e) {
                if ($(e.target).is('#statusModal')) {
                    closeStatusModal();
                }
            });

            
            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#btnDownloadExcel', function (e) {
                e.preventDefault();
                window.location.href = "{{ route('excel.download') }}";
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
                    scrollX: true,
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
                    <div class="legend-container d-flex align-items-center gap-3 ms-3">
                        <div class="d-flex align-items-center gap-2">
                            <span style="display:inline-block;width:20px;height:20px;background:#CC0000;border:1px solid #000;"></span>
                            <small>≤ 6 bulan</small>
                            <span style="display:inline-block;width:20px;height:20px;background:#FFFF00;border:1px solid #000;"></span>
                            <small>> 6 bulan</small>
                            <span style="display:inline-block;width:20px;height:20px;background:#32CD32;border:1px solid #000;"></span>
            <small>Sudah Bayar</small>
                        </div>

                        

                       
                    </div>
                `);
            }

            // Open add data modal - Handler untuk tombol di DataTable
            $(document).on('click', '#btnTambahDataTable', function (e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Reset form
                $('#formTambah')[0].reset();
                
                // Show modal
                tambahModal.show();
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
                        // Hide modal
                        tambahModal.hide();
                        
                        // Reset form
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
                        tambahModal.hide();
                        showStatusModal('error', 'Gagal!', 'Terjadi kesalahan saat menambahkan data.');
                    }
                });
            });

            // Reset form when Bootstrap modals are hidden
            $('#tambahModal').on('hidden.bs.modal', function () {
                $('#formTambah')[0].reset();
            });

        });
    </script>
</body>

</html>