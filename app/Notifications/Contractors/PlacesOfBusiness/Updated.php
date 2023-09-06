<?php

namespace App\Notifications\Contractors\PlacesOfBusiness;

use App\Models\Contractors\PlaceOfBusiness;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Шаблон e-mail сообщения об изменении места осуществления деятельности контрагента.
 */
class Updated extends Notification
{
    use Queueable;

    /**
     * @var PlaceOfBusiness
     */
    private $placeOfBusiness;

    /**
     * Изменения.
     *
     * @var array|null
     */
    private $changes;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PlaceOfBusiness $placeOfBusiness, array $changes)
    {
        $this->placeOfBusiness = $placeOfBusiness;

        $this->changes = $changes;
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
     * @return MailMessage|void
     */
    public function toMail($notifiable)
    {
        $url = url('/contractors/' . $this->placeOfBusiness->contractor->id . '/edit');

        $mailMessage = new MailMessage();

        $mailMessage->subject(__('notifications.contractors.places_of_business.updated.subject'))
            ->greeting(__('notifications.greeting'))
            ->line(__('notifications.contractors.places_of_business.updated.body'))
            ->line(
                __(
                    'notifications.contractors.created.contractor',
                    [
                        'contractor' => $this->placeOfBusiness->contractor->legalForm->abbreviation
                            . ' '
                            . $this->placeOfBusiness->contractor->name,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.INN',
                    [
                        'INN' => $this->placeOfBusiness->contractor->INN,
                    ]
                )
            )
            ->line(__('notifications.contractors.updated.changes'))
            ->line(__('notifications.contractors.updated.before'));

        foreach ($this->changes as $key => $change) {
            $mailMessage->line(
                __('contractors.places_of_business.' . $key) .
                ': ' .
                PlaceOfBusiness::find($this->placeOfBusiness->id)->$key
            );
        }

        $mailMessage->line(__('notifications.contractors.updated.after'));

        foreach ($this->changes as $key => $change) {
            $mailMessage->line(
                __('contractors.places_of_business.' . $key) .
                ': ' .
                $change
            );
        }

        return $mailMessage->line(
            __(
                'notifications.contractors.created.user',
                [
                    'user' => $this->placeOfBusiness->contractor->user->name,
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
