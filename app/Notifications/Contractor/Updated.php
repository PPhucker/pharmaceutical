<?php

namespace App\Notifications\Contractor;

use App\Models\Contractor\Contractor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Шаблон e-mail оповещения об изменении основной информации контрагента.
 */
class Updated extends Notification
{
    use Queueable;

    /**
     * @var Contractor
     */
    private $contactor;

    /**
     * Измененные атрибуты.
     *
     * @var array
     */
    private $changes;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Contractor $contractor)
    {
        $this->contactor = $contractor;

        $this->changes = $contractor->getDirty();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
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
    public function toMail($notifiable): MailMessage
    {
        $url = url('/contractors/' . $this->contactor->id . '/edit');

        $mailMessage = new MailMessage();

        $mailMessage->subject(__('notifications.contractors.updated.subject'))
            ->greeting(__('notifications.greeting'))
            ->line(__('notifications.contractors.updated.body'))
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
            ->line(__('notifications.contractors.updated.changes'))
            ->line(__('notifications.contractors.updated.before'));

        foreach ($this->changes as $key => $change) {
            $mailMessage->line(
                __('contractors.' . $key) .
                ': ' .
                Contractor::withTrashed()->find($this->contactor->id)->$key
            );
        }

        $mailMessage->line(__('notifications.contractors.updated.after'));

        foreach ($this->changes as $key => $change) {
            $mailMessage->line(
                __('contractors.' . $key) .
                ': ' .
                $change
            );
        }

        return $mailMessage->line(
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
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
