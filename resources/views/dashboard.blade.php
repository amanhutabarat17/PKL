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

        /* Fix untuk tombol edit Tabledit yang hilang */
        .tabledit-edit-button,
        .tabledit-save-button,
        .tabledit-confirm-button,
        .tabledit-delete-button,
        .tabledit-restore-button {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            padding: 2px 6px;
            margin: 1px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #f8f9fa;
            color: #333;
            text-decoration: none;
            font-size: 12px;
            cursor: pointer;
        }

        .tabledit-edit-button:hover {
            background-color: #007bff;
            color: white;
        }

        .tabledit-save-button {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .tabledit-save-button:hover {
            background-color: #218838;
        }

        /* Pastikan kolom action terlihat */
        .tabledit-toolbar {
            min-width: 80px;
        }

        /* Fix untuk ikon di tombol */
        /* .tabledit-edit-button::before {
            content: "✏️";
            margin-right: 2px;
        }

        .tabledit-save-button::before {
            content: "💾";
            margin-right: 2px;
        } */
    </style>
</head>
<body>

<div class="container-fluid p-4">
    <h1 class="mb-4">Dashboard</h1>

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
              <div class="d-flex gap-1">
    <button class="btn btn-sm btn-danger btnHapus" 
            data-id="{{ $row[0] }}" 
            data-nama="{{ $row[1] }}" 
            title="Hapus">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>

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

<!-- Tambah Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Data 
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambah">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="noField" class="form-label">No</label>
                            <input type="text" class="form-control" id="noField" name="No" readonly>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama" name="Nama" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="kpj" class="form-label">KPJ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kpj" name="KPJ" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tanggalTerima" class="form-label">Tanggal Terima <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalTerima" name="Tanggal Terima" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tanggalRekam" class="form-label">Tanggal Rekam <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalRekam" name="Tanggal Rekam" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="Status">
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

// Klik tombol hapus
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

    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to show messages
    function showMessage(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-error';
        $('#message').html('<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' + 
                          message + 
                          '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                          '</div>');
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    }

    // Check if table exists
    if ($('#excelTable').length === 0) {
        console.log('Tabel tidak ditemukan');
        return;
    }

    // Initialize DataTable
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

    // Add button next to search bar
    $('.dataTables_filter').append(
        '<button id="btnTambah" type="button">' +
        '<i class="fas fa-plus me-2"></i>' +
        'Tambah Data' +
        '</button>'
    );

    // Function to open modal
    function openModal() {
        // Find last "No" from table to auto-increment
        let lastNo = 0;
        $('#excelTable tbody tr').each(function () {
            let noVal = parseInt($(this).find('td').eq(1).text()); // assuming column 1 is "No"
            if (!isNaN(noVal) && noVal > lastNo) {
                lastNo = noVal;
            }
        });
        $('#noField').val(lastNo + 1);
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('tambahModal'));
        modal.show();
    }

    // Event handler for dynamically added button
    $(document).on('click', '#btnTambah', function () {
        openModal();
    });

    // Handle form submission
    $('#formTambah').on('submit', function (e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = $('button[form="formTambah"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...');
        submitBtn.prop('disabled', true);
        
        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("excel.store") }}',
            method: 'POST',
            data: formData,
            success: function (data) {
                if (data.success) {
                    showMessage('Data berhasil ditambahkan!', 'success');
                    
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('tambahModal'));
                    if (modal) {
                        modal.hide();
                    }
                    
                    // Reset form
                    $('#formTambah')[0].reset();
                    
                    // Reload page to refresh table
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    showMessage('Gagal menambahkan data: ' + (data.message || 'Unknown error'), 'error');
                }
            },
            error: function (xhr) {
                console.error('AJAX Error:', xhr.responseText);
                let errorMessage = 'Terjadi kesalahan server';
                
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    if (xhr.status === 419) {
                        errorMessage = 'Session expired. Silakan refresh halaman.';
                    } else if (xhr.status === 422) {
                        errorMessage = 'Data yang dimasukkan tidak valid.';
                    }
                }
                
                showMessage(errorMessage, 'error');
            },
            complete: function() {
                // Reset button state
                submitBtn.html(originalText);
                submitBtn.prop('disabled', false);
            }
        });
    });

    // Initialize Tabledit for inline editing
    $('#excelTable').Tabledit({
        url: '{{ route("excel.update") }}',
        method: 'POST',
        editButton: true,
        deleteButton: false,
        saveButton: true,
        restoreButton: false,
        buttons: {
            edit: {
                class: 'btn btn-sm btn-primary tabledit-edit-button',
                html: '<i class="fas fa-edit"></i>',
                action: 'edit'
            },
            save: {
                class: 'btn btn-sm btn-success tabledit-save-button',
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
        onSuccess: function(data) {
            console.log('Success Response:', data);
            if (data.success) {
                showMessage('Data berhasil diupdate!', 'success');
            } else {
                showMessage('Gagal mengupdate data: ' + (data.message || 'Unknown error'), 'error');
            }
        },
        onFail: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', {
                status: jqXHR.status,
                statusText: textStatus,
                error: errorThrown,
                response: jqXHR.responseText
            });

            let errorMessage = 'Terjadi kesalahan saat mengupdate data';
            try {
                const response = JSON.parse(jqXHR.responseText);
                if (response.message) errorMessage = response.message;
            } catch (e) {
                if (jqXHR.status === 419) errorMessage = 'Session expired. Silakan refresh halaman.';
                else if (jqXHR.status === 500) errorMessage = 'Internal server error. Cek log server.';
            }
            showMessage(errorMessage, 'error');
        },
        onAjax: function(action, serialize) {
            console.log('AJAX Action:', action);
            console.log('Data being sent:', serialize);
        }
    });

    // Handle modal events
    document.getElementById('tambahModal').addEventListener('hidden.bs.modal', function () {
        $('#formTambah')[0].reset();
    });
});
</script>

</body>
</html>