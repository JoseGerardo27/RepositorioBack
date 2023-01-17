<?php

namespace App\Mail;

use App\Models\Colaborador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RestaurarPass extends Mailable
{
    use Queueable, SerializesModels;
    public $colab,$pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Colaborador $colab, $pass)
    {
        $this->colab=$colab;
        $this->pass=$pass;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'RESTAURACION DE CONTRASEÑA (PRUEBA)',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'email.restauracion',
            with: [
                'name' => $this->colab->nombre,
                'id' => $this->colab->id,
                'correo'=>$this->colab->correo,
                'pass'=>$this->pass,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
