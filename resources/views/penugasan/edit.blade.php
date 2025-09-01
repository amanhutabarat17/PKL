@extends('layouts.app')

@section('content')
<style>
    /* Styling for the main container */
    .container-custom {
        max-width: 42rem;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    /* Styling for the form card */
    .form-card {
        background-color: #f0fdf4;
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 2.5rem;
        border: 1px solid #00a87a;
    }

    /* Styling for headings */
    .form-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 2rem;
        text-align: center;
    }

    /* Styling for form labels */
    .form-label {
        display: block;
        color: #374151;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Styling for text and select inputs */
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #a7f3d0;
        border-radius: 0.75rem;
        outline: none;
        background-color: #fff;
        color: #1f2937;
        transition: all 200ms;
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #00a87a;
        box-shadow: 0 0 0 4px rgba(0, 168, 122, 0.3);
    }

    /* Styling for error messages */
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Styling for buttons and links */
    .button-group {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 2rem;
        gap: 1rem;
    }
    
    .cancel-link {
        color: #6b7280;
        font-weight: 600;
        transition: color 300ms;
    }

    .cancel-link:hover {
        color: #374151;
    }
    
    .submit-button {
        background-color: #00a87a;
        color: #fff;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        transition: all 300ms;
        border: none;
        cursor: pointer;
    }
    
    .submit-button:hover {
        background-color: #008761;
        transform: scale(1.05);
    }
</style>

<div class="container-custom">
    <div class="form-card">
        <h1 class="form-title">Edit Penugasan Kunjungan</h1>

        <form action="{{ route('penugasan.update', $penugasan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-input" value="{{ old('nama_karyawan', $penugasan->nama_karyawan) }}" required>
                @error('nama_karyawan')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="kabupaten_id" class="form-label">Kabupaten</label>
                <select name="kabupaten_id" id="kabupaten_id" class="form-select" required>
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $penugasan->kecamatan->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
                @error('kabupaten_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kecamatan_id" class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-select" required>
                    <option value="">-- Pilih Kecamatan Dulu --</option>
                    {{-- Opsi akan diisi oleh JavaScript --}}
                </select>
                @error('kecamatan_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-textarea" required>{{ old('deskripsi', $penugasan->deskripsi) }}</textarea>
                @error('deskripsi')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="photo" class="form-label">Foto</label>
                <div class="mt-2">
                    @if($penugasan->photo_path)
                        <img src="{{ asset('storage/' . $penugasan->photo_path) }}" alt="Foto saat ini" class="w-40 h-40 rounded-lg object-cover mb-4">
                        <p class="text-sm text-gray-500 mb-2">Unggah file baru untuk mengganti foto di atas.</p>
                    @else
                        <p class="text-sm text-gray-500 mb-2">Belum ada foto. Silakan unggah.</p>
                    @endif
                    
                    <input type="file" name="photo" id="photo" class="form-input" style="border-style: dashed;">
                    @error('photo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" id="alamat_lengkap" rows="4" class="form-textarea" required>{{ old('alamat_lengkap', $penugasan->alamat_lengkap) }}</textarea>
                @error('alamat_lengkap')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="button-group">
                <a href="{{ route('penugasan.index') }}" class="cancel-link">Batal</a>
                <button type="submit" class="submit-button">
                    Perbarui Penugasan
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
    const kabupatenSelect = $('#kabupaten_id');
    const kecamatanSelect = $('#kecamatan_id');
    
    // Fungsi untuk mengambil dan mengisi data kecamatan
    function fetchKecamatan(kabupatenId, selectedKecamatanId = null) {
        if (!kabupatenId) {
            kecamatanSelect.html('<option value="">-- Pilih Kabupaten Dulu --</option>');
            return;
        }

        // [DIUBAH] Menggunakan URL yang konsisten dengan halaman create
        $.ajax({
            url: `/get-kecamatan/${kabupatenId}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                kecamatanSelect.empty().append('<option value="">-- Pilih Kecamatan --</option>');
                $.each(data, function(key, value) {
                    const option = $('<option></option>').attr('value', value.id).text(value.nama_kecamatan);
                    if (selectedKecamatanId && value.id == selectedKecamatanId) {
                        option.prop('selected', true);
                    }
                    kecamatanSelect.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching kecamatan:', error);
            }
        });
    }

    // Panggil fungsi saat halaman pertama kali dimuat dengan data yang ada
    const initialKabupatenId = kabupatenSelect.val();
    const selectedKecamatanId = '{{ old('kecamatan_id', $penugasan->kecamatan_id) }}';
    fetchKecamatan(initialKabupatenId, selectedKecamatanId);

    // Panggil fungsi setiap kali pilihan kabupaten berubah
    kabupatenSelect.on('change', function() {
        fetchKecamatan($(this).val());
    });
});
</script>
@endpush