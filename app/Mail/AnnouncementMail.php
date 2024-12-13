<?php

namespace App\Mail;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public $announcement;

    /**
     * Create a new message instance.
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.announcement') // This is the view being referenced.
                    ->with(['announcement' => $this->announcement]);
    }
}
