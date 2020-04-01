<?php

namespace App\Notifications;

use App\Organisation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class OrganisationCreated extends Notification
{
    use Queueable;

    public $organisation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/invoice/' . $this->invoice->id);

        return (new MailMessage)
                    ->greeting('Hello, ' . Auth::user()->name . '!')
                    ->line($this->organisation->name . ', has been successfully registered!')
                    ->line('Trial Ends: ' . ($organisation->trial_end->format('d/M/Y') ?: 'N/A'))
                    ->line('Subscription' . ($organisation->subscribed ? 'subscribed' : 'unsubscribed'))
                    ->line('Thank you for using' . env('APP_NAME', ' our application') . '!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
