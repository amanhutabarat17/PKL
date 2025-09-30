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
        /* ... (CSS lainnya tetap sama) ... */
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
                width: 90% !important; /* Batasi lebar di HP */
                max-width: 450px !important;
                margin: 1em;
            }
            .swal2-content {
                padding: 0 !important;
            }
            .details-container-modal {
                max-height: 350px; /* Batasi tinggi sedikit lagi di HP */
                padding-bottom: 5px;
            }
            .detail-card .list-unstyled strong {
                 min-width: 90px; /* Kurangi min-width label di HP */
                 display: block; /* Buat deskripsi dan label berada di baris terpisah */
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
        .tabledit-toolbar,
        .d-flex.gap-1 {
            display: inline-flex !important;
            align-items: center;
            gap: 4px;
        }

        /* Standardize size of all action buttons */
        .btn-aksi,
        .tabledit-edit-button,
        .tabledit-save-button,
        .tabledit-confirm-button,
        .tabledit-delete-button,
        .tabledit-restore-button,
        .btnHapus,
        .btnEdit,
        .btnUpload,
        .btnMelihat,
        .btnAssignPetugas {
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
        .btnAssignPetugas:hover {
            transform: scale(1.1);
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

        .btnEdit {
            background-color: #0d6efd !important;
        }

        .btnEdit:hover {
            background-color: #0b5ed7 !important;
        }

        .btnMelihat {
            background-color: #0d6efd !important;
        }

        .btnMelihat:hover {
            background-color: #0b5ed7 !important;
        }


        .tabledit-save-button {
            background-color: #198754 !important;
        }

        .tabledit-save-button:hover {
            background-color: #157347 !important;
        }

        .btnUpload {
            background-color: #0dcaf0 !important;
        }

        .btnUpload:hover {
            background-color: #0aa5c2 !important;
        }

        /* Tombol Tambah Petugas (Hijau) */
        .btnAssignPetugas {
            background-color: #28a745 !important;
        }

        .btnAssignPetugas:hover {
            background-color: #1e7e34 !important;
        }

        /* PERCANTIKAN TAMBAHAN UNTUK MODAL PENUGASAN PETUGAS */
        .assign-modal-header {
            background-color: #008080;
            /* Warna Teal/Hijau Tosca BPJS Ketenagakerjaan */
            color: white;
            border-bottom: none;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .assign-modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .form-check-label {
            font-weight: 500;
            cursor: pointer;
        }

        /* Input teks area untuk deskripsi */
        #deskripsi_penugasan {
            border-radius: 0.5rem;
            border-color: #ced4da;
            padding: 10px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        #deskripsi_penugasan:focus {
            border-color: #008080;
            box-shadow: 0 0 0 0.25rem rgba(0, 128, 128, 0.25);
        }

        /* Tombol di footer modal */
        #assignPetugasModal .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            /* Memastikan tombol di kanan */
        }

        #assignPetugasModal .modal-footer .btn-primary {
            background-color: #008080;
            /* Hijau Tosca untuk tombol utama */
            border-color: #008080;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        #assignPetugasModal .modal-footer .btn-primary:hover {
            background-color: #006666;
            border-color: #006666;
        }

        #assignPetugasModal .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        #assignPetugasModal .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        /* Hapus Custom Status Modal Styling karena diganti SweetAlert2 */
        /*
			.status-modal-overlay, .status-modal-content, etc.
			*/

        /* PERBAIKAN CSS Z-INDEX HANYA UNTUK MODAL ASING */
        #modalLihatGambar {
            z-index: 1055 !important;
        }

        .modal-backdrop {
            z-index: 1050 !important;
        }
    </style>
</head>

<body>

    <div class="modal fade" id="assignPetugasModal" tabindex="-1" aria-labelledby="assignPetugasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg rounded-xl">
                <div class="modal-header assign-modal-header">
                    <h5 class="modal-title" id="assignPetugasModalLabel">
                        <i class="fas fa-user-plus me-2"></i> **Tugaskan Petugas**
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="assignPetugasForm" action="/assign/petugas" method="POST">
                    @csrf
                    <input type="hidden" name="penugasan_id" id="penugasan_id">
                    <div class="modal-body p-4">
                        <p class="text-secondary mb-3">Pilih petugas yang akan ditugaskan:</p>
                        <div class="d-flex flex-wrap gap-4 mb-4 p-3 bg-light rounded-3 border">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="petugas_id[]" value="1"
                                    id="petugas1">
                                <label class="form-check-label" for="petugas1">
                                    Ahmad
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="petugas_id[]" value="2"
                                    id="petugas2">
                                <label class="form-check-label" for="petugas2">
                                    Dewi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="petugas_id[]" value="3"
                                    id="petugas3">
                                <label class="form-check-label" for="petugas3">
                                    Budi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="petugas_id[]" value="4"
                                    id="petugas4">
                                <label class="form-check-label" for="petugas4">
                                    Siti
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_penugasan" class="form-label">
                                <i class="fas fa-pencil-alt me-1 text-secondary"></i> Deskripsi Penugasan (Opsional)
                            </label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi_penugasan" rows="3"
                                placeholder="Contoh: Mohon segera hubungi peserta untuk konfirmasi jadwal."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Tugaskan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.navigation')
    <div class="container-fluid p-4">

        {{-- <div id="statusModal" class="status-modal-overlay hidden">
			<div class="status-modal-content rounded-xl">
				<div class="status-modal-icon"></div>
				<div class="status-modal-title"></div>
				<div class="status-modal-message"></div>
				<button id="closeStatusModal" class="status-modal-button">OK</button>
			</div>
		</div> --}}

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
                                <button class="btn btn-sm btnHapus" data-id="{{ $row[0] }}" data-nama="{{ $row[1] }}"
                                    title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <button class="btn btn-sm btnMelihat" data-id="{{ $row[0] }}" title="Melihat">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <a href="{{ route('penugasan.create', ['id' => $row[0]]) }}"
                                    class="btn btn-sm btn-primary btnUpload" title="Unggah Penugasan">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </a
>
                                <button class="btn btn-sm btn-success btnAssignPetugas" title="Tugaskan Petugas"
                                    data-id="{{ $row[0] }}">
                                    <i class="fas fa-user-plus"></i>
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
            <button id="btnTambah" type="button" class="btn btn-success ms-3" data-bs-toggle="modal"
                data-bs-target="#tambahModal">
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label for="jenisKlaim" class="form-label">Jenis Klaim</label>
                                <select class="form-control" id="jenisKlaim" name="Jenis Klaim">
                                    <option value="JKM">JKM</option>
                                    <option value="JKK">JKK</option>
                                    <option value="JHT">JHT</option>
                                    <option value="JP">JP</option>
                                    <option value="JKP">JKP</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggalTerima" class="form-label">Tanggal Terima </label>
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
                                    <option value="Pending">Pending</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Diterima">Diterima</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggalMeninggal" class="form-label">Tanggal Meninggal <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggalMeninggal"
                                    name="Tanggal Meninggal">
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
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" form="formTambah" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger text-white">
					<h5 class="modal-title" id="modalHapusLabel">
						<i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
	</div> --}}

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Variabel global untuk modal instances
            let tambahModal;
            // let modalHapus; // Dihapus
            let assignPetugasModal;

            // Initialize modals
            function initializeModals() {
                tambahModal = new bootstrap.Modal(document.getElementById('tambahModal'), {
                    backdrop: true,
                    keyboard: true
                });

                // modalHapus = new bootstrap.Modal(document.getElementById('modalHapus'), { // Dihapus
                //     backdrop: true,
                //     keyboard: true
                // });

                assignPetugasModal = new bootstrap.Modal(document.getElementById('assignPetugasModal'), {
                    backdrop: 'static',
                    keyboard: false
                });
            }

            // Call initialize function
            initializeModals();

            // Reusable function to show the status modal (DIGANTI SWEETALERT2)
            function showStatusModal(type, title, message) {
                // Mapping type ke icon SweetAlert2
                const swalIcon = (type === 'success') ? 'success' :
                    (type === 'error') ? 'error' :
                    (type === 'warning') ? 'warning' :
                    'info';

                // SweetAlert2 untuk modal utama (detail penugasan)
                Swal.fire({
                    icon: swalIcon,
                    title: title,
                    html: message, // Menggunakan HTML untuk konten
                    showCloseButton: true,
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    allowOutsideClick: true,
                    customClass: {
                        // Memberikan sedikit ruang di atas jika konten detailnya panjang
                        popup: 'my-swal-modal'
                    }
                });
            }

            // Function to show toast notifications (DIGANTI SWEETALERT2 TOAST)
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

            // Click delete button -> MENGGUNAKAN SWEETALERT2 UNTUK KONFIRMASI
            $(document).on('click', '.btnHapus', function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                Swal.fire({
                    title: 'Konfirmasi Hapus Data',
                    html: `Yakin ingin menghapus data untuk <br><strong>${nama}</strong>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika dikonfirmasi, lakukan AJAX
                        $.ajax({
                            url: '/excel/delete',
                            method: 'POST',
                            data: {
                                ID: id,
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.success) {
                                    showToast(response.message || 'Berhasil Dihapus!', 'success');
                                    setTimeout(() => location.reload(), 1500); // REFRESH SETELAH HAPUS BERHASIL
                                } else {
                                    showToast(response.message || 'Gagal menghapus data!', 'error');
                                }
                            },
                            error: function (xhr, status, error) {
                                let errorMsg = 'Terjadi kesalahan jaringan.';
                                if (xhr.status === 405) {
                                    errorMsg = 'Gagal: Metode HTTP TIDAK DIIZINKAN (405).';
                                } else if (xhr.status === 500) {
                                    errorMsg = 'Kesalahan Server Internal (500).';
                                }
                                showToast(errorMsg, 'error');
                            }
                        });
                    }
                });
            });

            // Setup CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#btnDownloadExcel', function (e) {
                e.preventDefault();
                window.location.href = "/excel/download";
            });

            // Function pesan alert - DIGANTI DENGAN showToast
            function showMessage(message, type) {
                showToast(message, type === 'success' ? 'success' : 'error');
            }

            // [START] FUNGSI KONVERSI WAKTU KE WIB
            function formatLocalTime(isoString) {
                if (!isoString) return 'Tidak Ada Data Waktu';
                try {
                    // Membuat objek Date. Ini mengasumsikan isoString adalah waktu UTC/server
                    const date = new Date(isoString + 'Z'); 

                    if (isNaN(date.getTime())) {
                        return isoString; // Fallback jika string waktu tidak valid
                    }

                    // Menentukan format lokal Indonesia (WIB/UTC+7)
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

                penugasans.forEach(function (penugasan, index) {
                    // Menggunakan fungsi konversi waktu baru
                    const localTime = formatLocalTime(penugasan.tanggal_unggah);
                    
                    // Penentuan link dan badge untuk file bukti
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
                    // PERBAIKAN DI SINI: Menambahkan opsi 5, 10, 20, 50, dan Semua (-1)
                    lengthMenu: [
                        [5, 10, 20, 50, -1],
                        [5, 10, 20, 50, "Semua"]
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    scrollX: true,
                    responsive: true, // Pastikan responsive diaktifkan
                    language: {
                        search: "Pencarian:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman", // Mengubah MENU menjadi _MENU_
                        // PERBAIKAN KRUSIAL: Menggunakan placeholder dinamis DataTables
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    }
                });

                // PERBAIKAN KRUSIAL: LOGIKA WARNA DI LEGEND HARUS SESUAI DENGAN BACKEND
                var legendHtml = '<div class="legend-container d-flex align-items-center gap-3 ms-3">' +
                    '<div class="d-flex align-items-center gap-2">' +
                    // MERAH TUA: #CC0000 -> LOGIC: > 6 bulan (di controller: $months > 6)
                    '<span style="display:inline-block;width:20px;height:20px;background:#CC0000;border:1px solid #000;"></span>' +
                    '<small>&gt; 6 bulan</small>' +
                    // KUNING: #FFFF00 -> LOGIC: <= 6 bulan (di controller: else)
                    '<span style="display:inline-block;width:20px;height:20px;background:#FFFF00;border:1px solid #000;"></span>' +
                    '<small>&le; 6 bulan</small>' +
                    // HIJAU: #32CD32 -> LOGIC: Status Diterima (di controller: $status === 'diterima')
                    '<span style="display:inline-block;width:20px;height:20px;background:#32CD32;border:1px solid #000;"></span>' +
                    '<small>Diterima</small>' +
                    '</div>' +
                    '<button id="btnDownloadExcel" type="button" class="btn btn-outline-primary btn-sm">' +
                    '<i class="fas fa-file-excel me-2"></i> Download Excel' +
                    '</button>' +
                    '<button id="btnTambahDataTable" type="button" class="btn btn-success btn-sm">' +
                    '<i class="fas fa-plus me-2"></i> Tambah Data' +
                    '</button>' +
                    '</div>';

                $('.dataTables_filter').append(legendHtml);
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
                    url: '/excel/store',
                    method: 'POST',
                    data: formData,
                    success: function (data) {
                        // Hide modal
                        tambahModal.hide();

                        // Reset form
                        $('#formTambah')[0].reset();

                        if (data.success) {
                            showToast(data.message || 'Data Berhasil Ditambahkan!', 'success');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            showToast(data.message || 'Gagal!', 'error');
                        }
                    },
                    error: function () {
                        tambahModal.hide();
                        showToast('Terjadi kesalahan saat menambahkan data.', 'error');
                    }
                });
            });

            // Tabledit settings for inline editing
            $('#excelTable').Tabledit({
                url: '/excel/update',
                method: 'POST',
                editButton: false,
                deleteButton: false,
                saveButton: false,
                restoreButton: false,
                buttons: {},
                columns: {
                    identifier: [0, "ID"],
                    editable: [
                        [1, "Nama"],
                        [2, "KPJ"],
                        [3, "Jenis Klaim"],
                        [4, "Tanggal Terima"],
                        [5, "Tanggal Rekam"],
                        [6, "Status"],
                        [7, "Tanggal Meninggal"],
                        [8, "Keterangan"],
                        [9, "Alamat"],
                        [10, "Petugas"]
                    ]
                },
                onSuccess: function (data, textStatus, jqXHR) {
                    if (data.success) {
                        showToast(data.message || 'Data berhasil diperbarui!', 'success'); // Menggunakan Toast
                        if (data.rowColor) {
                            let row = $("#excelTable tbody tr").filter(function () {
                                return $(this).find("td:first").text() == data.ID;
                            });
                            row.css("background-color", "#" + data.rowColor);
                        }
                    } else {
                        showToast(data.message || 'Update gagal!', 'error'); // Menggunakan Toast
                    }
                },
                onFail: function (jqXHR, textStatus, errorThrown) {
                    showToast('Gagal update data: ' + errorThrown, 'error'); // Menggunakan Toast
                }
            });

            // Custom tombol Edit (toggle jadi Save)
            $(document).on("click", ".btnEdit", function (e) {
                e.preventDefault();
                let id = $(this).data("id");
                let $row = $("#excelTable").find("tr").filter(function () {
                    return $(this).find("td:first").text() == id;
                });

                if (!$row.hasClass("editing")) {
                    $row.find(".tabledit-edit-button").trigger("click");
                    $row.addClass("editing");
                    $(this).html('<i class="fas fa-save"></i>');
                    $(this).removeClass("btn-primary").addClass("btn-success");
                } else {
                    // Ketika Save diklik, Tabledit akan memicu request
                    $row.find(".tabledit-save-button").trigger("click");
                    // Kembalikan tombol ke Edit setelah AJAX selesai (bisa diatur di onSuccess Tabledit)
                    // Untuk sementara, kita kembalikan setelah klik save
                    $row.removeClass("editing");
                    $(this).html('<i class="fas fa-edit"></i>');
                    $(this).removeClass("btn-success").addClass("btn-primary");
                }
            });

            // Reset form when Bootstrap modals are hidden
            $('#tambahModal').on('hidden.bs.modal', function () {
                $('#formTambah')[0].reset();
            });

            // modalHapus dihilangkan

            // --- Logika Penugasan Petugas ---

            // Event handler untuk tombol 'Tugaskan Petugas'
            $(document).on('click', '.btnAssignPetugas', function (e) {
                e.preventDefault();

                // Temukan baris tabel terdekat dari tombol yang diklik
                const $row = $(this).closest('tr');

                // Ambil data dari kolom yang sesuai
                const penugasanData = {
                    // Asumsi: ID ada di kolom pertama (indeks 0)
                    id: $row.find('td:eq(0)').text().trim(),
                    // Asumsi: Nama ada di kolom kedua (indeks 1)
                    nama: $row.find('td:eq(1)').text().trim(),
                    // Asumsi: KPJ ada di kolom ketiga (indeks 2)
                    kpj: $row.find('td:eq(2)').text().trim()
                };

                // Simpan ID penugasan ke dalam input hidden di modal
                $('#penugasan_id').val(penugasanData.id);

                // Simpan data lengkap ke elemen form menggunakan .data()
                $('#assignPetugasForm').data('penugasan-detail', penugasanData);

                // Tampilkan modal
                assignPetugasModal.show();
            });

            // Event handler untuk form penugasan
            $('#assignPetugasForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                // Gunakan serializeArray() untuk memanipulasi data sebelum dikirim
                const formData = form.serializeArray();

                // Ambil data penugasan yang sudah kita simpan di langkah sebelumnya
                const penugasanDetail = form.data('penugasan-detail');

                // Tambahkan data detail penugasan (nama dan kpj) ke dalam array data form
                formData.push({
                    name: 'penugasan_data',
                    value: JSON.stringify(penugasanDetail)
                });

                // Sembunyikan modal penugasan
                assignPetugasModal.hide();

                $.ajax({
                    url: '/assign/petugas',
                    method: 'POST',
                    data: $.param(formData),
                    success: function (response) {
                        if (response.success) {
                            showToast(response.message || 'Penugasan berhasil dilakukan.', 'success');
                        } else {
                            showToast(response.message || 'Gagal menugaskan petugas.', 'error');
                        }
                    },
                    // PERBAIKAN: Menambahkan handler error untuk menangkap detail server
                    error: function (xhr, status, error) {
                        let errorMsg = 'Terjadi kesalahan saat menugaskan petugas.';

                        if (xhr.status === 404) {
                            errorMsg = 'Gagal: Route /assign/petugas tidak ditemukan.';
                        } else if (xhr.status === 500) {
                            errorMsg = 'Gagal: Kesalahan Server Internal (500).';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            // Mencoba mendapatkan pesan error dari response JSON (misalnya error validasi)
                            errorMsg = 'Gagal: ' + xhr.responseJSON.message;
                        }

                        showToast(errorMsg, 'error');
                    }
                });
            });

            // PERUBAHAN TOTAL: Mengubah Child Row menjadi Status Modal (dengan SweetAlert2)
            $(document).on('click', '.btnMelihat', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const dataId = $(this).data('id');

                // Tampilkan modal loading sementara dengan SweetAlert2
                Swal.fire({
                    title: 'Memuat Detail Penugasan...',
                    html: '<i class="fas fa-spinner fa-spin fa-2x text-primary"></i>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Lakukan panggilan AJAX untuk mengambil data penugasan
                $.ajax({
                    url: '/api/penugasan/' + dataId,
                    method: 'GET',
                    success: function (response) {
                        // Tutup modal loading
                        Swal.close();

                        if (response.success && response.penugasans && response.penugasans.length > 0) {

                            // Gunakan fungsi format baru
                            let fullDetailHtml = format(response.penugasans);

                            // Tambahkan wrapper details-container-modal untuk styling scroll
                            fullDetailHtml = `<div class="details-container-modal">${fullDetailHtml}</div>`;

                            // Tampilkan detail di SweetAlert2
                            Swal.fire({
                                title: `Detail Penugasan Data ID: ${dataId}`,
                                html: fullDetailHtml,
                                icon: 'info', // Mengubah ke info untuk tampilan yang lebih netral
                                width: 'auto', // Diatur ulang ke auto untuk responsivitas penuh
                                showConfirmButton: true,
                                confirmButtonText: 'Tutup'
                            });

                        } else {
                            // Jika tidak ada data
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
                    error: function (xhr, status, error) {
                        // Tutup modal loading
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
