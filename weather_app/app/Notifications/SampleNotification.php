<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Messages\SlackAttachment;

class SampleNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Bomb', ':bomb:')
            ->to('#general')
            ->content('明日の天気予報')
            ->attachment(function (SlackAttachment $attachment)
            {
              $forecastInOtsu = forecast('250010');

              $attachment
                  ->title($forecastInOtsu['city'])
                  ->fields([
                    '天気'    => $forecastInOtsu['weather'],
                    '最高気温' => $forecastInOtsu['maxTemperature'],
                    '最低気温' => $forecastInOtsu['minTemperature']
                  ]);
            })
            ->attachment(function (SlackAttachment $attachment)
            {
              $forecastInKyoto = forecast('260010');

              $attachment
                  ->title($forecastInKyoto['city'])
                  ->fields([
                    '天気'    => $forecastInKyoto['weather'],
                    '最高気温' => $forecastInKyoto['maxTemperature'],
                    '最低気温' => $forecastInKyoto['minTemperature']
                  ]);
            });
    }
}
