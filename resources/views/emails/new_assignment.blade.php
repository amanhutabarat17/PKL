<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notifikasi Penugasan Baru</title>
    <style type="text/css">
        /* Global Styles */
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 16px;
            color: #333333;
            background-color: #f0f4f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #39b44a;
            background-image: linear-gradient(135deg, #39b44a 0%, #2e9b3e 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        
        .header img {
            max-width: 250px;
            height: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .content {
            padding: 40px 30px;
            line-height: 1.6;
        }
        
        h1 {
            color: #1a1a1a;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 1.2em;
        }

        .details-section {
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
        }
        
        .detail-item strong {
            display: inline-block;
            width: 150px;
            font-weight: 600;
        }
        
        .detail-item .icon {
            margin-right: 15px;
            font-size: 20px;
            color: #39b44a;
        }
        
        .call-to-action-wrapper {
            text-align: center;
            margin-top: 30px;
        }
        
        .call-to-action {
            display: inline-block;
            padding: 15px 30px;
            background-color: #39b44a;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(57, 180, 74, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .call-to-action:hover {
            background-color: #2e9b3e;
            box-shadow: 0 6px 12px rgba(57, 180, 74, 0.6);
        }

        /* --- Perubahan pada Footer Dimulai Di Sini --- */
        .footer {
            text-align: center;
            padding: 30px;
            font-size: 14px;
            background-color: #ffffff;
            border-top: 1px solid #e0e0e0;
            border-radius: 0 0 12px 12px;
            color: #888888;
        }

        .footer .social-icons {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .footer .social-icons a {
            margin: 0 10px;
            text-decoration: none;
        }

        .footer .social-icons img {
            width: 30px;
            height: 30px;
        }

        .footer-links a {
            color: #39b44a;
            text-decoration: none;
            margin: 0 10px;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        /* --- Perubahan pada Footer Berakhir Di Sini --- */

        /* Responsive Styles */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                border-radius: 0;
            }
            .content {
                padding: 25px 20px;
            }
            .details-list li strong {
                width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://www.bpjsketenagakerjaan.go.id/images/logo-bpjs.png" alt="Logo BPJS Ketenagakerjaan">
        </div>

        <div class="content">
            <p><strong>Halo,</strong></p>
            <h1>Notifikasi Penugasan Baru (JKM)</h1>
            <p>Penugasan baru telah dibuat untuk Anda. Mohon periksa detailnya di bawah ini:</p>
            
            <div class="details-section">
                <div class="detail-item">
                    <span class="icon">📄</span>
                    <strong>ID Peserta</strong>: {{ $penugasanData['id'] ?? 'N/A' }}
                </div>
                <div class="detail-item">
                    <span class="icon">👤</span>
                    <strong>Nama Peserta</strong>: {{ $penugasanData['nama'] ?? 'N/A' }}
                </div>
                <div class="detail-item">
                    <span class="icon">💳</span>
                    <strong>Nomor KPJ</strong>: {{ $penugasanData['kpj'] ?? 'N/A' }}
                </div>
                <div class="detail-item">
                    <span class="icon">👷‍♂️</span>
                    <strong>Petugas yang Ditugaskan</strong>: {{ implode(', ', $namaPetugas) }}
                </div>
                <div class="deskripsi-section mt-4" style="background-color: #f0f8ff; border: 1px dashed #d0e0f0; border-radius: 8px; padding: 15px; margin-top: 25px;">
            <p style="font-weight: bold; margin-bottom: 5px; color: #39b44a;">📝 Catatan Tambahan:</p>
            <p style="margin: 0;">{{ $deskripsi }}</p>
        </div>
            </div>

            <div class="call-to-action-wrapper">
                <a href="dashboarduser" class="call-to-action">Lihat Detail Penugasan</a>
            </div>
            
            <p style="margin-top: 30px;">Terima kasih,</p>
            <p style="margin-bottom: 0;">Salam BPJS Ketenagakerjaan</p>
        </div>
        
        <div class="footer">
            
            <div class="social-icons">
                <a href="https://www.facebook.com/bpjs.ketenagakerjaan" target="_blank"><img src="https://bpjsketenagakerjaan.go.id/images/logo-facebook.png" alt="Facebook"></a>
                <a href="https://twitter.com/bpjsketenagakerjaan" target="_blank"><img src="https://bpjsketenagakerjaan.go.id/images/logo-twitter.png" alt="Twitter"></a>
                <a href="https://www.instagram.com/bpjs.ketenagakerjaan/" target="_blank"><img src="https://bpjsketenagakerjaan.go.id/images/logo-instagram.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/bpjsketenagakerjaan" target="_blank"><img src="https://bpjsketenagakerjaan.go.id/images/logo-youtube.png" alt="YouTube"></a>
            </div>
            <p style="margin-top: 15px;">&copy; 2024 BPJS Ketenagakerjaan. Semua Hak Dilindungi.</p>
        </div>
        </div>
</body>
</html>