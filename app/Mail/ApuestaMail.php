<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApuestaMail extends Mailable
{
    use SerializesModels;

    public $apuesta;
    public $mensaje;

    public function __construct($apuesta, $mensaje)
    {
        $this->apuesta = $apuesta;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject('Notificación de Apuesta')
                    ->view('emails.apuesta');
    }
}