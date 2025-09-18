<form action="..." method="POST">
    @csrf
    <div class="form-group">
        <label for="petugas_id">Pilih Petugas:</label>
        <select name="petugas_id" id="petugas_id" class="form-control">
            @foreach($petugas as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="penugasan_id" value="{{ $id }}">
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>