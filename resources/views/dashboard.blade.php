<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        table.dataTable td {
            vertical-align: middle;
        }

        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        #excelTable_wrapper {
            margin-top: 20px;
        }

        /* Style untuk posisi button di samping search */
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 10px;
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

        /* ================================
           Styling tombol aksi (Edit, Simpan, Hapus) - DIPERBAIKI
        ================================= */
        
        /* Container untuk tombol aksi - Target yang lebih spesifik */
        .tabledit-toolbar,
        .d-flex.gap-1,
        td .tabledit-toolbar {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-start !important;
            gap: 5px !important; /* jarak konsisten antar tombol */
            flex-wrap: nowrap !important;
            min-width: fit-content !important;
            white-space: nowrap !important;
        }

        /* Kolom aksi dengan lebar tetap */
        #excelTable td:last-child,
        table.dataTable td:last-child {
            width: 130px !important;
            min-width: 130px !important;
            max-width: 130px !important;
            text-align: left !important;
            padding: 8px !important;
            vertical-align: middle !important;
        }

        /* Header kolom aksi */
        #excelTable th:last-child,
        table.dataTable th:last-child {
            width: 130px !important;
            min-width: 130px !important;
            max-width: 130px !important;
            text-align: center !important;
        }

        /* Seragamkan ukuran semua tombol aksi dengan target lebih spesifik */
        .tabledit-edit-button,
        .tabledit-save-button,
        .tabledit-confirm-button,
        .tabledit-delete-button,
        .tabledit-restore-button,
        .btnHapus,
        #excelTable .tabledit-edit-button,
        #excelTable .tabledit-save-button,
        #excelTable .btnHapus {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 35px !important;      
            height: 35px !important;     
            min-width: 35px !important;
            min-height: 35px !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 8px !important;
            font-size: 14px !important;  
            line-height: 1 !important;
            color: #fff !important;
            border: none !important;
            cursor: pointer !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            flex-shrink: 0 !important;
            box-sizing: border-box !important;
        }

        /* Warna-warna tombol dengan hover effects */
        .btnHapus,
        .tabledit-delete-button,
        #excelTable .btnHapus {
            background-color: #dc3545 !important;
        }
        .btnHapus:hover,
        .tabledit-delete-button:hover,
        #excelTable .btnHapus:hover {
            background-color: #bb2d3b !important;
            transform: scale(1.1) !important;
        }

        .tabledit-edit-button,
        #excelTable .tabledit-edit-button {
            background-color: #0d6efd !important;
        }
        .tabledit-edit-button:hover,
        #excelTable .tabledit-edit-button:hover {
            background-color: #0b5ed7 !important;
            transform: scale(1.1) !important;
        }

        .tabledit-save-button,
        #excelTable .tabledit-save-button {
            background-color: #198754 !important;
        }
        .tabledit-save-button:hover,
        #excelTable .tabledit-save-button:hover {
            background-color: #157347 !important;
            transform: scale(1.1) !important;
        }

        /* Reset semua margin dan spacing yang berpotensi menganggu */
        .tabledit-toolbar > *,
        .d-flex.gap-1 > * {
            margin: 0 !important;
            float: none !important;
        }

        /* Khusus untuk tombol dalam mode edit */
        .tabledit-edit-mode .tabledit-toolbar {
            display: flex !important;
            gap: 5px !important;
        }
    </style>

</head>

<body>
    @include('layouts.navigation')
    <div class="container-fluid p-4">

        <div id="message"></div>

        @if(isset($error))
            <div class="alert alert-error">{{ $error }}</div>
        @endif

        @if(!empty($header) && !empty($rows))
            <table id="excelTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        @foreach($header as $head)
                            <th>{{ $head }}</th>
                        @endforeach
                        <th>Aksi</th> <!-- Tambahan kolom aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr>
                            @foreach($row as $cell)
                                <td>{{ $cell ?? '' }}</td>
                            @endforeach
                            <td>
                                <button class="btn btn-sm btnHapus tabledit-delete-button" 
                                        data-id="{{ $row[0] }}"
                                        data-nama="{{ $row[1] }}" 
                                        title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data untuk ditampilkan.
            </div>
        @endif
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahModalLabel">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Data
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTambah">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="Nama" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kpj" class="form-label">KPJ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="kpj" name="KPJ" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggalTerima" class="form-label">Tanggal Terima <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggalTerima" name="Tanggal Terima"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggalRekam" class="form-label">Tanggal Rekam <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggalRekam" name="Tanggal Rekam" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="Status">
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggalMeninggal" class="form-label">Tanggal Meninggal</label>
                                <input type="date" class="form-control" id="tanggalMeninggal" name="Tanggal Meninggal">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="Keterangan">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="Alamat" rows="2"></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="petugas" class="form-label">Petugas</label>
                                <input type="text" class="form-control" id="petugas" name="Petugas">
                            </div>
                        </div>
                    </form>
                </div>
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

            // Klik tombol hapus manual
            $(document).on('click', '.btnHapus', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                $('#hapusId').val(id);
                $('#hapusNama').text(nama);

                modalHapus.show();
            });

            // Konfirmasi hapus
            $('#btnKonfirmasiHapus').on('click', function () {
                const id = $('#hapusId').val();

                $.ajax({
                    url: '{{ route("excel.delete") }}',
                    method: 'POST',
                    data: {
                        ID: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            showMessage(response.message, 'success');
                            modalHapus.hide();
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showMessage(response.message, 'error');
                        }
                    },
                    error: function () {
                        showMessage('Gagal menghapus data', 'error');
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

                // Tambah tombol "Tambah Data"
                $('.dataTables_filter').append(
                    '<button id="btnTambah" type="button">' +
                    '<i class="fas fa-plus me-2"></i>' +
                    'Tambah Data' +
                    '</button>'
                );
            }

            // Buka modal tambah
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

            // Submit form tambah
            $('#formTambah').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("excel.store") }}',
                    method: 'POST',
                    data: formData,
                    success: function (data) {
                        if (data.success) {
                            showMessage('Data berhasil ditambahkan!', 'success');
                            const modal = bootstrap.Modal.getInstance(document.getElementById('tambahModal'));
                            if (modal) modal.hide();
                            $('#formTambah')[0].reset();
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            showMessage('Gagal menambahkan data', 'error');
                        }
                    }
                });
            });

            // Tabledit inline edit
            $('#excelTable').Tabledit({
                url: '{{ route("excel.update") }}',
                method: 'POST',
                editButton: true,
                deleteButton: false, 
                saveButton: true,
                restoreButton: false,
                buttons: {
                    edit: {
                        class: 'btn btn-sm tabledit-edit-button',
                        html: '<i class="fas fa-edit"></i>',
                        action: 'edit'
                    },
                    save: {
                        class: 'btn btn-sm tabledit-save-button',
                        html: '<i class="fas fa-save"></i>',
                        action: 'save'
                    }
                },
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
                onSuccess: function (data) {
                    if (data.success) {
                        showMessage('Data berhasil diupdate!', 'success');
                    } else {
                        showMessage('Gagal mengupdate data', 'error');
                    }
                },
                onFail: function (jqXHR) {
                    let errorMessage = 'Terjadi kesalahan saat update';
                    try {
                        const response = JSON.parse(jqXHR.responseText);
                        if (response.message) errorMessage = response.message;
                    } catch (e) {
                        if (jqXHR.status === 419) errorMessage = 'Session expired.';
                        else if (jqXHR.status === 500) errorMessage = 'Internal server error.';
                    }
                    showMessage(errorMessage, 'error');
                },
                onDraw: function () {
                    // Setelah tabledit membuat tombol edit/save, kita gabungkan dengan tombol hapus
                    $('#excelTable tbody tr').each(function() {
                        const $row = $(this);
                        const $lastCell = $row.find('td:last-child');
                        const $hapusBtn = $lastCell.find('.btnHapus');
                        const $toolbar = $lastCell.find('.tabledit-toolbar');
                        
                        // Jika ada toolbar tabledit dan tombol hapus terpisah
                        if ($toolbar.length && $hapusBtn.length) {
                            // Pindahkan tombol hapus ke dalam toolbar
                            $toolbar.append($hapusBtn);
                        } else if ($hapusBtn.length && !$toolbar.length) {
                            // Jika belum ada toolbar, buat wrapper toolbar untuk tombol hapus
                            $hapusBtn.wrap('<div class="tabledit-toolbar"></div>');
                        }
                    });
                }
            });

            // Reset form saat modal ditutup
            document.getElementById('tambahModal').addEventListener('hidden.bs.modal', function () {
                $('#formTambah')[0].reset();
            });
        });
    </script>

</body>
</html>