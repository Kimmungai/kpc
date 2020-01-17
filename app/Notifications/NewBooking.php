<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewBooking extends Notification implements ShouldQueue
{
    use Queueable;
    public $details;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
     public function __construct($details)
     {
         $this->details = $details;
     }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                  ->from(env('APP_EMAIL','support@kituipastoralcenter.com'), env('APP_NAME','Example'))
                  ->greeting($this->details['greeting'])
                  ->subject($this->details['subject'])
                  ->line($this->details['body'])
                  ->action($this->details['actionText'], $this->details['actionURL'])
                  ->line($this->details['thanks']);
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
          'booking_id' => $this->details['booking_id'],
          'dept_name' => $this->details['dept_name'],
          'booker_name' => $this->details['booker_name'],
          'booker_avatar' => $this->details['booker_avatar'],
      ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
      return new BroadcastMessage([
          'booking_id' => $this->details['booking_id'],
          'dept_name' => $this->details['dept_name'],
          'booker_name' => $this->details['booker_name'],
          'booker_avatar' => $this->details['booker_avatar'],
      ]);
    }

}
