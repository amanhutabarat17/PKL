@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-xl mx-auto bg-gray-900 rounded-2xl shadow-lg overflow-hidden p-10 transition-transform transform hover:scale-105 duration-300">
        <h1 class="text-3xl font-extrabold text-white mb-8 text-center">Edit Penugasan Kunjungan</h1>

        <form action="{{ route('penugasan.update', $penugasan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_karyawan" class="block text-gray-300 font-semibold mb-2">Nama Karyawan</label>
                <input type="text" name="nama_karyawan" id="nama_karyawan" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200" value="{{ old('nama_karyawan', $penugasan->nama_karyawan) }}">
                @error('nama_karyawan')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kabupaten" class="block text-gray-300 font-semibold mb-2">Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200">
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ ($penugasan->kecamatan->kabupaten_id == $kabupaten->id) ? 'selected' : '' }}>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
                @error('kabupaten')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kecamatan" class="block text-gray-300 font-semibold mb-2">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200">
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ ($penugasan->kecamatan_id == $kecamatan->id) ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan_id')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="alamat_lengkap" class="block text-gray-300 font-semibold mb-2">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" id="alamat_lengkap" rows="4" class="w-full px-4 py-3 border border-gray-700 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white transition-colors duration-200">{{ old('alamat_lengkap', $penugasan->alamat_lengkap) }}</textarea>
                @error('alamat_lengkap')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end items-center mt-8 space-x-4">
                <a href="{{ route('penugasan.index') }}" class="text-gray-400 font-semibold hover:text-gray-200 transition duration-300">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-colors duration-300 ease-in-out">
                    Perbarui Penugasan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');

        // Pastikan dropdown kecamatan terisi saat halaman dimuat
        const initialKabupatenId = kabupatenSelect.value;
        if (initialKabupatenId) {
             fetchKecamatan(initialKabupatenId, '{{ $penugasan->kecamatan_id }}');
        }

        kabupatenSelect.addEventListener('change', function () {
            const kabupatenId = this.value;
            if (kabupatenId) {
                fetchKecamatan(kabupatenId);
            } else {
                kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            }
        });

        function fetchKecamatan(kabupatenId, selectedKecamatanId = null) {
            fetch(`/kecamatan/${kabupatenId}`)
                .then(response => response.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '';
                    data.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.nama_kecamatan;
                        if (selectedKecamatanId && kecamatan.id == selectedKecamatanId) {
                            option.selected = true;
                        }
                        kecamatanSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching kecamatan:', error));
        }
    });
</script>
@endpush
