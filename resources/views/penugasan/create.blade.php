{{-- resources/views/penugasan/create.blade.php --}}
@extends('layouts.app')

@section('content')
<style>

    /* Style Anda tidak diubah */
    body { background-color: #1a202c; }
    .form-container { max-width: 42rem; margin-left: auto; margin-right: auto; padding: 2rem 1rem; }
    .form-card { background-color: #f0fdf4; border: 1px solid #10b981; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.25); padding: 2.5rem; transition: transform 0.3s ease-in-out; }
    .form-card:hover { transform: translateY(-5px); }
    .form-title { color: #1f2937; }
    .form-label { color: #374151; }
    .form-input, .form-select, .form-textarea { background-color: #ffffff; border: 1px solid #d1d5db; color: #1f2937; transition: border-color 0.2s ease, box-shadow 0.2s ease; border-radius: 0.75rem; }
    .form-input:focus, .form-select:focus, .form-textarea:focus { border-color: #4ade80; box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.4); }
    .submit-button { background-color: #10b981; color: #fff; transition: background-color 0.2s ease, transform 0.2s ease; }
    .submit-button:hover { background-color: #059669; transform: scale(1.05); }
    .cancel-link { color: #9ca3af; }
    .cancel-link:hover { color: #d1d5db; }
    /* Custom styles to match the provided image theme */
    body {
        background-color: #1a202c; /* Dark background to match the screenshot */
    }

    .form-container {
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .form-card {
        background-color: #f0fdf4; /* Very light green, almost white */
        border: 1px solid #10b981; /* Bright green border from the image header */
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.25);
        padding: 2.5rem;
        transition: transform 0.3s ease-in-out;
    }

    .form-card:hover {
        transform: translateY(-5px);
    }

    .form-title {
        color: #1f2937; /* Dark gray for the title */
    }

    .form-label {
        color: #374151; /* Medium gray for labels */
    }

    .form-input, .form-select, .form-textarea {
        background-color: #ffffff; /* White input background */
        border: 1px solid #d1d5db; /* Light gray border */
        color: #1f2937; /* Dark gray text color */
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        border-radius: 0.75rem;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #4ade80; /* Brighter green focus border */
        box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.4); /* Light green glow on focus */
    }

    .submit-button {
        background-color: #10b981; /* Green button to match header */
        color: #fff;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .submit-button:hover {
        background-color: #059669; /* Darker green on hover */
        transform: scale(1.05);
    }
    
    .cancel-link {
        color: #9ca3af; /* Gray for the cancel link */
    }

    .cancel-link:hover {
        color: #d1d5db; /* Lighter gray on hover */
    }
    
    /* Custom Alert Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.75);
        display: none; /* Hidden by default */
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    
    .modal-content {
        background-color: #f0fdf4;
        padding: 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 400px;
        text-align: center;
        transform: scale(0.95);
        transition: transform 0.3s ease-in-out;
    }
    
    .modal-overlay.active {
        display: flex;
        opacity: 1;
    }
    
    .modal-overlay.active .modal-content {
        transform: scale(1);
    }
    
    .modal-title-success {
        color: #059669; /* Darker green for success */
    }
    
    .modal-title-error {
        color: #dc2626; /* Red for error */
    }
    
    .modal-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 1.5rem;
    }
    
    .modal-icon-success path {
        fill: #059669;
    }
    
    .modal-icon-error path {
        fill: #dc2626;
    }

    .modal-button {
        background-color: #10b981;
        color: #fff;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    .modal-button:hover {
        background-color: #059669;
    }

</style>
<div class="form-container">
    <div class="form-card">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold form-title">Tambah Penugasan Baru</h1>
        </div>
        
        <!-- [PERBAIKAN 1] Menambahkan enctype untuk upload file -->
        <form action="{{ route('penugasan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama_karyawan" class="block form-label text-sm font-bold mb-2">Nama Petugas</label>
                <input type="text" id="nama_karyawan" name="nama_karyawan" class="w-full px-4 py-3 rounded-xl focus:outline-none form-input" value="{{ old('nama_karyawan') }}" required>
                <!-- [PERBAIKAN 2] Menampilkan pesan error validasi -->
                @error('nama_karyawan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kabupaten_id" class="block form-label text-sm font-bold mb-2">Kabupaten</label>
                <select id="kabupaten_id" name="kabupaten_id" class="w-full px-4 py-3 rounded-xl focus:outline-none form-select" required>
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id') == $kabupaten->id ? 'selected' : '' }}>{{ $kabupaten->nama_kabupaten }}</option>
                    @endforeach
                </select>
                @error('kabupaten_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kecamatan_id" class="block form-label text-sm font-bold mb-2">Kecamatan</label>
                <select id="kecamatan_id" name="kecamatan_id" class="w-full px-4 py-3 rounded-xl focus:outline-none form-select" required>
                    <option value="">-- Pilih Kabupaten Dulu --</option>
                </select>
                @error('kecamatan_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> 
            
            <!-- [PERBAIKAN 3] Memperbaiki id dan name yang duplikat -->
            <div class="mb-4">
                <label for="deskripsi" class="block form-label text-sm font-bold mb-2">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full px-4 py-3 rounded-xl focus:outline-none form-textarea" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="photo" class="block form-label text-sm font-bold mb-2">Tambah Foto</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-green-300 border-dashed rounded-xl cursor-pointer bg-green-50 hover:bg-green-100 transition-colors duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v8"></path></svg>
                            <p id="file-name-display" class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk mengunggah</span> atau seret dan lepas</p>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="photo" class="hidden" required />
                    </label>
                </div>
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="alamat_lengkap" class="block form-label text-sm font-bold mb-2">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" class="w-full px-4 py-3 rounded-xl focus:outline-none form-textarea" required>{{ old('alamat_lengkap') }}</textarea>
                @error('alamat_lengkap')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('penugasan.index') }}" class="font-semibold cancel-link">Batal</a>
                <button type="submit" class="font-bold py-3 px-6 rounded-xl focus:outline-none focus:shadow-outline submit-button transform hover:scale-105">Simpan Penugasan</button>
            </div>
        </form>
    </div>
</div>

<!-- Custom Alert Modal -->
<div id="customAlert" class="modal-overlay">
    <div class="modal-content">
        <div id="modalIcon" class="modal-icon"></div>
        <h2 id="modalTitle" class="text-2xl font-bold mb-4"></h2>
        <p id="modalMessage" class="mb-6"></p>
        <button id="modalCloseButton" class="modal-button">
            OK
        </button>
    </div>
</div>
@endsection

@push('scripts')
{{-- Script Anda sudah benar, tidak perlu diubah --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        // SVG icon for success (check mark)
        const successIcon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#059669"><path d="M9 16.172l-4.243-4.243a1 1 0 011.414-1.414L9 13.344l6.293-6.293a1 1 0 011.414 1.414L9 16.172z" /></svg>`;
        
        // SVG icon for error (exclamation mark)
        const errorIcon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#dc2626"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>`;

        let alertTimer;

        // Function to show the custom alert modal
        function showAlert(title, message, isSuccess) {
            const modal = $('#customAlert');
            const modalTitle = $('#modalTitle');
            const modalMessage = $('#modalMessage');
            const modalIcon = $('#modalIcon');
            
            modalTitle.text(title);
            modalMessage.text(message);
            
            // Set icon and title color based on success or error
            modalTitle.removeClass('modal-title-success modal-title-error');
            modalIcon.removeClass('modal-icon-success modal-icon-error');
            
            if (isSuccess) {
                modalTitle.addClass('modal-title-success');
                modalIcon.addClass('modal-icon-success');
                modalIcon.html(successIcon);
            } else {
                modalTitle.addClass('modal-title-error');
                modalIcon.addClass('modal-icon-error');
                modalIcon.html(errorIcon);
            }
            
            modal.addClass('active');

            // Set a timer to automatically redirect after 5 seconds
            clearTimeout(alertTimer);
            alertTimer = setTimeout(redirectToIndex, 5000);
        }

        // Function to handle redirection
        function redirectToIndex() {
            window.location.href = '{{ route('penugasan.index') }}';
        }

        // Event listener for the close button, also handles redirection
        $('#modalCloseButton').on('click', function() {
            clearTimeout(alertTimer); // Clear the timer to prevent double-redirect
            redirectToIndex();
        });

        // Check for session messages from the server on page load
        @if(session('success'))
            showAlert('Berhasil!', '{{ session('success') }}', true);
        @endif

        @if(session('error'))
            showAlert('Terjadi Kesalahan', '{{ session('error') }}', false);
        @endif

        // Existing AJAX logic for Kabupaten and Kecamatan
        $('#kabupaten_id').on('change', function() {
            var kabupatenId = $(this).val();
            if(kabupatenId) {
                $.ajax({
                    url: '/get-kecamatan/' + kabupatenId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        $('#kecamatan_id').empty().append('<option value="">-- Pilih Kecamatan --</option>');

                        // Cek data yang diterima dari server
                        console.log('Data dari server:', data);
                        
                        $('#kecamatan_id').empty();
                        $('#kecamatan_id').append('<option value="">-- Pilih Kecamatan --</option>');
                        

                        if(Array.isArray(data) && data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#kecamatan_id').append('<option value="'+ value.id +'">'+ value.nama_kecamatan +'</option>');
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.log('Response text:', xhr.responseText);

                    }
                });
            } else {
                $('#kecamatan_id').empty().append('<option value="">-- Pilih Kabupaten Dulu --</option>');
            }
        });

        $('#dropzone-file').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#file-name-display').text(fileName).addClass('font-semibold text-green-600');
            } else {
                $('#file-name-display').html('<span class="font-semibold">Klik untuk mengunggah</span> atau seret dan lepas').removeClass('font-semibold text-green-600');
            }
        });
    });
</script>
@endpush
