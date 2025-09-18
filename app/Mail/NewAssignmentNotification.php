<?php

// app/Mail/NewAssignmentNotification.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAssignmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $namaPetugas;
    public $penugasanId;
    public $penugasanData;
    public $deskripsi; // 

    /**
     * Buat instance pesan baru.
     *
     * @param array $namaPetugas
     * @param int $penugasanId
     * @param array $penugasanData
     * @param string|null $deskripsi 
     * @return void
     */
    public function __construct($namaPetugas, $penugasanId, $penugasanData, $deskripsi = null) 
    {
        $this->namaPetugas = $namaPetugas;
        $this->penugasanId = $penugasanId;
        $this->penugasanData = $penugasanData;
        $this->deskripsi = $deskripsi; 
    }

    /**
     * Bangun pesan.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notifikasi Penugasan Baru')
                    ->view('emails.new_assignment');
    }
}