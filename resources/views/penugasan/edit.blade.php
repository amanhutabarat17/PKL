@extends('layouts.app')

@section('content')
<style>
    /* Styling for the main container */
    .container-custom {
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    /* Styling for the form card */
    .form-card {
        background-color: #f0fdf4; /* Very light green, almost white */
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        padding: 2.5rem;
        transition-property: transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 500ms;
        transform: scale(1);
        border: 1px solid #00a87a; /* Main green color */
    }

    .form-card:hover {
        transform: scale(1.05);
    }

    /* Styling for headings */
    .form-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1f2937; /* Dark gray for text */
        margin-bottom: 2rem;
        text-align: center;
        letter-spacing: 0.05em;
    }

    /* Styling for form labels */
    .form-label {
        display: block;
        color: #374151; /* Medium gray */
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Styling for text and select inputs */
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border-width: 2px;
        border-color: #a7f3d0; /* Light green border */
        border-radius: 0.75rem;
        outline: none;
        background-color: #fff; /* White background */
        color: #1f2937; /* Dark gray text */
        transition-property: color, background-color, border-color, box-shadow;
        transition-duration: 200ms;
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #00a87a; /* Main green color on focus */
        box-shadow: 0 0 0 4px rgba(0, 168, 122, 0.3); /* Green ring */
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
        color: #6b7280; /* Gray */
        font-weight: 600;
        transition-property: color;
        transition-duration: 300ms;
    }

    .cancel-link:hover {
        color: #374151; /* Darker gray */
    }
    
    .submit-button {
        background-color: #00a87a; /* Main green color */
        color: #fff;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        transition-property: all;
        transition-duration: 300ms;
        transform: scale(1);
    }
    
    .submit-button:hover {
        background-color: #008761; /* Darker green on hover */
        transform: scale(1.05);
    }
</style>
<div class="container-custom">
    <div class="form-card">
        <h1 class="form-title">Edit Penugasan Kunjungan</h1>

        <form action="{{ route('penugasan.update', $penugasan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-input" value="{{ old('nama_karyawan', $penugasan->nama_karyawan) }}">
                @error('nama_karyawan')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kabupaten" class="form-label">Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-select">
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->id }}" {{ ($penugasan->kecamatan->kabupaten_id == $kabupaten->id) ? 'selected' : '' }}>
                            {{ $kabupaten->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
                @error('kabupaten')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan" class="form-select">
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ ($penugasan->kecamatan_id == $kecamatan->id) ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                <textarea name="alamat_lengkap" id="alamat_lengkap" rows="4" class="form-textarea">{{ old('alamat_lengkap', $penugasan->alamat_lengkap) }}</textarea>
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