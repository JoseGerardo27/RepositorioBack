<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     // php artisan make:mail OrderShipped
    public function __construct($id_nom,$name)
    {
        $this->id_nom=$id_nom;
        $this->name=$name;
        $this->msg='Cambio de contraseña';
        $this->image='public\images\grupo.jpg';
    }

    public function build()
    {
        return $this->subject($this->msg)->markdown('changePass',['id_nom'=>$this->id_nom,'image'=>$this->image,'msg'=>$this->msg,'name'=>$this->name]);
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Order Shipped',
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
            view: 'view.name',
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
