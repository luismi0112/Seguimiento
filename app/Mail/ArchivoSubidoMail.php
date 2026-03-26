<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArchivoSubidoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function build()
    {
        return $this->subject('📂 Nueva Bitacora subida al sistema')
                    ->view('Archivo.archivosubido')
                    ->with(['filename' => $this->filename]);
    }
}
