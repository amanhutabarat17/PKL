@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-white">Tambah Penugasan Baru</h1>
    </div>

    <div class="bg-gray-900 rounded-2xl shadow-lg p-6">
        <form action="{{ route('penugasan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_karyawan" class="block text-gray-300 text-sm font-bold mb-2">Nama Karyawan</label>
                <input type="text" id="nama_karyawan" name="nama_karyawan" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200" required>
            </div>

            <div class="mb-4">
                <label for="kabupaten_id" class="block text-gray-300 text-sm font-bold mb-2">Kabupaten</label>
                <select id="kabupaten_id" name="kabupaten_id" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200" required>
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama_kabupaten }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kecamatan_id" class="block text-gray-300 text-sm font-bold mb-2">Kecamatan</label>
                <select id="kecamatan_id" name="kecamatan_id" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200" required>
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="alamat_lengkap" class="block text-gray-300 text-sm font-bold mb-2">Alamat Lengkap</label>
                <textarea id="alamat_lengkap" name="alamat_lengkap" rows="3" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200" required></textarea>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl focus:outline-none focus:shadow-outline transition duration-200 transform hover:scale-105">
                    Simpan Penugasan
                </button>
                <a href="{{ route('penugasan.index') }}" class="text-gray-400 hover:text-gray-200 font-semibold">Batal</a>
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
