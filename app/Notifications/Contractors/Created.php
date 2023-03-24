<?php

namespace App\Notifications\Contractors;

use App\Models\Contractors\Contractor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Created extends Notification implements ShouldQueue
{
    use Queueable;

    private const DELAY_IN_MINUTES = 1;

    /**
     * @var Contractor
     */
    private $contactor;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contractor $contractor)
    {
        $this->contactor = $contractor;

        $this->delay(
            now()->addMinutes(self::DELAY_IN_MINUTES)
        );
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/contractors/' . $this->contactor->id . '/edit');

        return (new MailMessage)
            ->subject(__('notifications.contractors.created.subject'))
            ->greeting(__('notifications.greeting'))
            ->line(
                __(
                    'notifications.contractors.created.body'
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.contractor',
                    [
                        'contractor' => $this->contactor->legalForm->abbreviation
                            . ' '
                            . $this->contactor->name,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.INN',
                    [
                        'INN' => $this->contactor->INN,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.created_at',
                    [
                        'created_at' => $this->contactor->created_at,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.user',
                    [
                        'user' => $this->contactor->user->name,
                    ]
                )
            )
            ->action(
                __('notifications.contractors.created.action'),
                $url
            )
            ->salutation(
                __('notifications.salutation')
                . ', '
                . config('app.name')
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
