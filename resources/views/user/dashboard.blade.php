<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Viewer</title>
    <!-- Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Custom styling to ensure the table and content are well-formatted */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .dataTables_wrapper .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.2s;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }

        table.dataTable td {
            vertical-align: middle;
            font-size: 0.875rem; /* text-sm */
        }

        table.dataTable thead th {
            font-size: 0.875rem; /* text-sm */
            font-weight: 600;
        }
        
        /* Custom styling for the color indicators */
        .color-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 1px solid #000;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- Simple Navigation Bar Placeholder -->
    <nav class="bg-gray-800 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Dashboard Viewer</h1>
            <div>
                <!-- You can add viewer-specific links here if needed -->
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container mx-auto p-6 mt-8 bg-white shadow-xl rounded-lg">

        <!-- Message/Alert Area -->
        <div id="message" class="mb-4"></div>

        <!-- Check for data before rendering the table -->
        @if(!empty($header) && !empty($rows))
            <table id="excelTable" class="display w-full">
                <thead>
                    <tr>
                        @foreach($header as $head)
                            <th class="px-4 py-2 text-left bg-gray-100">{{ $head }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $i => $row)
                        @php
                            $rowColor = $rowColors[$i] ?? null;
                        @endphp
                        <tr @if($rowColor) style="background-color:#{{ $rowColor }}" @endif class="border-t border-gray-200 hover:bg-gray-50">
                            @foreach($row as $cell)
                                <td class="px-4 py-2">{{ $cell ?? '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Displayed when no data is available -->
            <div class="flex justify-center items-center mt-8">
                <div class="bg-blue-100 text-blue-700 p-4 rounded-lg flex items-center gap-2">
                    <i class="fas fa-info-circle text-xl"></i>
                    <p class="font-medium">Tidak ada data untuk ditampilkan.</p>
                </div>
            </div>
        @endif
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Check if the table element exists before initializing DataTable
            if ($('#excelTable').length) {
                var table = $('#excelTable').DataTable({
                    pageLength: 25,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    order: [
                        [0, "asc"]
                    ],
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

                // Add color legend to the search filter area
                $('.dataTables_filter').append(`
                    <div class="ms-3 flex items-center gap-2 text-sm">
                        <span class="color-indicator bg-red-600"></span>
                        <small>≤ 6 bulan</small>
                        <span class="color-indicator bg-yellow-400"></span>
                        <small>> 6 bulan</small>
                    </div>
                `);

                // Ensure the colors are applied correctly after DataTables renders
                $('#excelTable tbody tr').each(function() {
                    let rowColor = $(this).attr('style');
                    if (rowColor && rowColor.includes('#CC0000')) {
                        $(this).addClass('bg-red-200');
                    } else if (rowColor && rowColor.includes('#FFFF00')) {
                        $(this).addClass('bg-yellow-100');
                    }
                });
            }
        });
    </script>
</body>
</html>
