@extends('layouts.app')

@section('content')
<style>
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
</style>
<div class="form-container">
    <div class="form-card">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold form-title">Tambah Penugasan Baru</h1>
        </div>
        <form action="{{ route('penugasan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_karyawan" class="block form-label text-sm font-bold mb-2">Nama Petugas</label>
                <input type="text" id="nama_karyawan" name="nama_karyawan" class="w-full px-4 py-3 rounded-xl focus:outline-none form-input" required>
            </div>

            <div class="mb-4">
                <label for="kabupaten_id" class="block form-label text-sm font-bold mb-2">Kabupaten</label>
                <select id="kabupaten_id" name="kabupaten_id" class="w-full px-4 py-3 rounded-xl focus:outline-none form-select" required>
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama_kabupaten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kecamatan_id" class="block form-label text-sm font-bold mb-2">Kecamatan</label>
                <select id="kecamatan_id" name="kecamatan_id" class="w-full px-4 py-3 rounded-xl focus:outline-none form-select" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="alamat_lengkap" class="block form-label text-sm font-bold mb-2">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" class="w-full px-4 py-3 rounded-xl focus:outline-none form-textarea" required></textarea>
            </div>
            
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('penugasan.index') }}" class="font-semibold cancel-link">Batal</a>
                <button type="submit" class="font-bold py-3 px-6 rounded-xl focus:outline-none focus:shadow-outline submit-button transform hover:scale-105">
                    Simpan Penugasan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kabupaten_id').on('change', function() {
            var kabupatenId = $(this).val();

            // Cek apakah kabupatenId berhasil didapat
            console.log('Kabupaten ID yang dipilih:', kabupatenId);

            if(kabupatenId) {
                $.ajax({
                    url: '/get-kecamatan/' + kabupatenId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        // Cek data yang diterima dari server
                        console.log('Data dari server:', data);
                        
                        $('#kecamatan_id').empty();
                        $('#kecamatan_id').append('<option value="">-- Pilih Kecamatan --</option>');
                        
                        // Cek apakah data yang diterima adalah array dan tidak kosong
                        if(Array.isArray(data) && data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#kecamatan_id').append('<option value="'+ value.id +'">'+ value.nama_kecamatan +'</option>');
                            });
                        } else {
                            console.log('Tidak ada data kecamatan yang ditemukan.');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Jika ada error pada panggilan AJAX
                        console.error('AJAX Error:', status, error);
                        console.log('Response text:', xhr.responseText);
                    }
                });
            } else {
                $('#kecamatan_id').empty();
                $('#kecamatan_id').append('<option value="">-- Pilih Kecamatan --</option>');
            }
        });
    });
</script>
@endpush
