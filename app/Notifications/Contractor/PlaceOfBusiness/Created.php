<?php

namespace App\Notifications\Contractor\PlaceOfBusiness;

use App\Models\Contractors\PlaceOfBusiness;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Шаблон e-mail сообщении о добавлении нового места осуществления деятельности контрагента.
 */
class Created extends Notification implements ShouldQueue
{
    use Queueable;

    private const DELAY_IN_MINUTES = 1;

    /**
     * @var PlaceOfBusiness
     */
    private $placeOfBusiness;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PlaceOfBusiness $placeOfBusiness)
    {
        $this->placeOfBusiness = $placeOfBusiness;

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
        $url = url('/contractors/' . $this->placeOfBusiness->contractor->id . '/edit');

        return (new MailMessage())
            ->subject(__('notifications.contractors.places_of_business.created.subject'))
            ->greeting(__('notifications.greeting'))
            ->line(
                __(
                    'notifications.contractors.places_of_business.created.body'
                )
            )
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
            ->line(
                __(
                    'notifications.contractors.places_of_business.created.address',
                    [
                        'address' => $this->placeOfBusiness->address,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.created_at',
                    [
                        'created_at' => $this->placeOfBusiness->created_at,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.contractors.created.user',
                    [
                        'user' => $this->placeOfBusiness->user->name,
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
