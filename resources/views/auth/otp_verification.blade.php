<div class="container">
    <h1>Verifikasi Kode OTP</h1>

    <p>Kode verifikasi telah dikirim ke email **{{ $email }}**. Silakan masukkan kode di bawah ini.</p>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('verification.otp.verify') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        
        <div>
            <label for="otp_code">Kode OTP</label>
            <input id="otp_code" type="text" name="otp_code" required autofocus>
        </div>

        <div>
            <button type="submit">
                Verifikasi
            </button>
        </div>
    </form>
</div>
