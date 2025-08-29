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
@endsection

@push('scripts')
{{-- Script Anda sudah benar, tidak perlu diubah --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kabupaten_id').on('change', function() {
            var kabupatenId = $(this).val();
            if(kabupatenId) {
                $.ajax({
                    url: '/get-kecamatan/' + kabupatenId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#kecamatan_id').empty().append('<option value="">-- Pilih Kecamatan --</option>');
                        if(Array.isArray(data) && data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#kecamatan_id').append('<option value="'+ value.id +'">'+ value.nama_kecamatan +'</option>');
                            });
                        }
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
