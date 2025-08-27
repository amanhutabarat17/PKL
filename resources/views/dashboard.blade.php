<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        /* CSS umum untuk tampilan */
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

        /* Styling tombol aksi */
        .d-flex.gap-1 {
            display: inline-flex !important;
            align-items: center;
            gap: 4px;
        }

        .btn-aksi,
        .btnHapus {
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
        }

        .btnHapus {
            background-color: #dc3545 !important;
        }

        .btnHapus:hover {
            background-color: #bb2d3b !important;
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
        <div class="table-responsive">
            <table id="excelTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        @foreach($header as $head)
                        <th>{{ $head }}</th>
                        @endforeach
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $i => $row)
                    @php
                    $rowColor = $rowColors[$i] ?? null;
                    @endphp
                    <tr @if($rowColor) style="background-color:#{{ $rowColor }}" @endif>
                        @foreach($row as $cell)
                        <td>{{ $cell ?? '' }}</td>
                        @endforeach
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btnHapus" data-id="{{ $row[0] }}" data-nama="{{ $row[1] }}"
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

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
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
                                <label for="jenisKlaim" class="form-label">Jenis Klaim <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="jenisKlaim" name="Jenis Klaim" required>
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
                                <input type="date" class="form-control" id="tanggalRekam" name="Tanggal Rekam"
                                    required>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            let modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'));
            let modalTambah = new bootstrap.Modal(document.getElementById('tambahModal'));

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            if ($('#excelTable').length) {
                var table = $('#excelTable').DataTable({
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    order: [[0, "asc"]],
                    // Baris di bawah ini adalah PANGKAL MASALAHNYA.
                    // Silakan hapus baris "responsive: true," ini.
                    responsive: true,
                    language: {
                        search: "Pencarian:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ sampai _END_ dari TOTAL data",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        zeroRecords: "Tidak ada data yang cocok ditemukan",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        infoFiltered: "(disaring dari total _MAX_ data)"
                    }
                });

                $('.dataTables_filter').append(`
                    <div class="ms-3 d-flex align-items-center gap-2">
                        <span style="display:inline-block;width:20px;height:20px;background:#CC0000;border:1px solid #000;"></span>
                        <small>≤ 6 bulan</small>
                        <span style="display:inline-block;width:20px;height:20px;background:#FFFF00;border:1px solid #000;"></span>
                        <small>> 6 bulan</small>
                        <button id="btnTambah" type="button" class="btn btn-success ms-auto">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Data
                        </button>
                    </div>
                `);
            }

            $(document).on('click', '.btnHapus', function () {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                $('#hapusId').val(id);
                $('#hapusNama').text(nama);
                modalHapus.show();
            });

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

            $(document).on('click', '#btnTambah', function () {
                modalTambah.show();
            });

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
                            modalTambah.hide();
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

            document.getElementById('tambahModal').addEventListener('hidden.bs.modal', function () {
                $('#formTambah')[0].reset();
            });
        });
    </script>
</body>

</html>