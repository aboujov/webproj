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
    public $actionType; // Add a new property for the action type.

    /**
     * Create a new message instance.
     */
    public function __construct(Announcement $announcement, $actionType = 'created')
    {
        $this->announcement = $announcement;
        $this->actionType = $actionType; // Pass action type to the property.
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Dynamically change the subject and content based on action type
        switch ($this->actionType) {
            case 'edited':
                $subject = 'Announcement Updated';
                break;
            case 'deleted':
                $subject = 'Announcement Removed';
                break;
            default:
                $subject = 'New Announcement';
                break;
        }

        return $this->subject($subject) // Set email subject dynamically
        ->view('emails.announcement')
            ->with([
                'announcement' => $this->announcement,
                'actionType' => $this->actionType // Pass action type to the view.
            ]);
    }
}
