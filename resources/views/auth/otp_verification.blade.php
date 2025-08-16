<h1>Verifikasi Kode OTP</h1>
<p>Kode verifikasi telah dikirim ke email {{ $email }}. Silakan masukkan kode di bawah ini.</p>

@if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">

    <label for="otp">Kode OTP</label><br>
    <input type="text" id="otp" name="otp" required><br><br>

    <button type="submit">Verifikasi</button>
</form>