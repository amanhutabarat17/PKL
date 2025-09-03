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

    <style>
        /* Palet Warna dan Tipografi yang Bersih dan Profesional */
        :root {
            --primary-color: #4a5568; /* Abu-abu gelap netral */
            --secondary-color: #718096; /* Abu-abu sedang */
            --text-color-dark: #2d3748;
            --text-color-light: #f7fafc;
            --background-body: #edf2f7; /* Abu-abu sangat terang untuk latar belakang */
            --background-card: #ffffff;
            --border-color-light: #e2e8f0;
            --border-color-dark: #cbd5e0;
            --hover-bg: #f7fafc;
            
            /* Warna untuk legend yang lebih lembut */
            --legend-red: #e53e3e; 
            --legend-yellow: #f6e05e;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-body);
            color: var(--text-color-dark);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navigasi */
        .navbar {
            background-color: var(--background-card);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            border-bottom: 1px solid var(--border-color-light);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--text-color-dark) !important;
        }
        .nav-link {
            color: var(--secondary-color) !important;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Kontainer Utama */
        .container-fluid {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Styling Tabel DataTables */
        .table-container {
            background-color: var(--background-card);
            border-radius: 0.5rem; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); 
            padding: 1.5rem;
            overflow-x: auto; /* Tambahan untuk scroll pada tabel */
        }
        
        .dataTables_wrapper {
            font-size: 0.95rem;
        }
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: var(--secondary-color);
            font-weight: 500;
        }

        table.dataTable {
            border-collapse: separate !important; 
            border-spacing: 0;
            margin-top: 1rem !important;
            border-radius: 0.5rem;
            overflow: hidden; 
            table-layout: auto; /* Mengubah table-layout ke auto untuk responsivitas */
            width: 100% !important; 
        }
        
        table.dataTable thead th {
            background-color: var(--primary-color);
            color: var(--text-color-light);
            border: none;
            padding: 1rem 1.25rem;
            font-weight: 600;
            text-align: left;
            white-space: nowrap;
        }

        table.dataTable tbody tr {
            transition: background-color 0.2s ease;
        }
        
        table.dataTable tbody tr:hover {
            background-color: var(--hover-bg) !important;
        }
        
        table.dataTable tbody td {
            padding: 0.9rem 1.25rem;
            border-top: 1px solid var(--border-color-light);
            white-space: normal; 
            word-wrap: break-word;
            overflow-wrap: break-word; 
        }

        /* Tampilan Alternating Row Color */
        table.dataTable tbody tr:nth-child(odd) {
            background-color: var(--background-card);
        }
        table.dataTable tbody tr:nth-child(even) {
            background-color: var(--hover-bg);
        }

        table.dataTable td {
            vertical-align: middle;
        }

        /* Filter dan Legenda yang Lebih Rapi */
        .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .dataTables_filter label {
            order: 2;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            color: var(--primary-color);
        }
        
        .dataTables_filter input {
            border-radius: 0.375rem;
            border: 1px solid var(--border-color-dark);
            padding: 0.5rem 1rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            width: 200px;
        }
        
        .dataTables_filter input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 85, 104, 0.1); 
            outline: none;
        }

        .legend-container {
            order: 1;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-right: auto;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--secondary-color);
            font-weight: 500;
        }
        
        .legend-box {
            width: 18px; 
            height: 18px;
            border-radius: 4px; 
            border: 1px solid rgba(0,0,0,0.1);
        }

        .legend-box.red {
            background-color: var(--legend-red);
        }

        .legend-box.yellow {
            background-color: var(--legend-yellow);
        }

        /* Styling Paginasi */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 0.25rem !important;
            background: none !important;
            color: var(--secondary-color) !important;
            margin: 0 0.2rem;
            transition: all 0.2s ease;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled):hover {
            background-color: var(--border-color-light) !important;
            color: var(--text-color-dark) !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: var(--primary-color) !important;
            color: var(--text-color-light) !important;
            border: 1px solid var(--primary-color) !important;
        }

        /* Penyesuaian Responsif untuk perangkat seluler */
        @media (max-width: 768px) {
            .table-container {
                padding: 1rem;
            }
            .dataTables_filter {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .dataTables_filter label {
                width: 100%;
                order: 2;
                font-size: 0.9rem;
            }
            .dataTables_filter input {
                width: 100%;
                padding: 0.4rem 1rem;
            }
            .legend-container {
                margin-right: 0;
                order: 1;
                justify-content: flex-start;
                gap: 10px;
            }
            .legend-item {
                font-size: 0.8rem;
            }
            table.dataTable thead th, table.dataTable tbody td {
                padding: 0.7rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navigation')
    <div class="container-fluid">
        @if(!empty($header) && !empty($rows))
            <div class="table-container">
                <table id="excelTable" class="display" style="width:100%">
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
            <div class="alert alert-info text-center mt-4">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data untuk ditampilkan.
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            if ($('#excelTable').length) {
                var table = $('#excelTable').DataTable({
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    order: [[0, "asc"]], // Mengatur pengurutan pada kolom pertama
                    responsive: true,
                    scrollX: false,
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
                    },
                    columnDefs: [
                        { "targets": '_all', "orderable": true, "className": "" }
                    ]
                });

                // Tambahkan legenda pencarian di atas tabel
                $('.dataTables_filter').prepend(`
                    <div class="legend-container">
                        <div class="legend-item">
                            <span class="legend-box red"></span>
                            <small>≤ 6 bulan</small>
                        </div>
                        <div class="legend-item">
                            <span class="legend-box yellow"></span>
                            <small>> 6 bulan</small>
                        </div>
                    </div>
                `);
            }
        });
    </script>
</body>
</html>
