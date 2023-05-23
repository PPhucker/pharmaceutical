<?php

namespace App\Notifications\Shipment;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class ToDigitalCommunication extends Notification implements ShouldQueue
{
    use Queueable;

    private const DELAY_IN_MINUTES = 1;

    /**
     * @var PackingList
     */
    private $packingList;
    /**
     * @var mixed
     */
    private $contractor;
    /**
     * @var mixed
     */
    private $organization;

    public function __construct(PackingList $packingList)
    {
        $this->packingList = $packingList;
        $this->contractor = $packingList->contractor;
        $this->organization = $packingList->organization;

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
        $date = Carbon::create($this->packingList->date)->format('Y-m-d');

        $url = url(
            '/documents/shipment/approval?'
            . 'fromDate='
            . $date
            . '&toDate='
            . $date
            . '&organization_id='
            . $this->organization->id
        );

        return (new MailMessage())
            ->subject(
                __('notifications.shipment.approval.correct')
                . ' '
                . __(
                    'notifications.shipment.subject',
                    [
                        'number' => $this->packingList->number,
                        'date' => $this->packingList->date
                    ]
                )
            )
            ->greeting(__('notifications.greeting'))
            ->line(__('notifications.shipment.approval.correct'))
            ->line(
                __(
                    'notifications.shipment.number',
                    [
                        'number' => $this->packingList->number,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.shipment.date',
                    [
                        'date' => $this->packingList->date,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.shipment.organization',
                    [
                        'organization' => $this->organization->legalForm->abbreviation
                            . ' '
                            . $this->organization->name,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.shipment.contractor',
                    [
                        'contractor' => $this->contractor->legalForm->abbreviation
                            . ' '
                            . $this->contractor->name,
                    ]
                )
            )
            ->line(
                __(
                    'notifications.shipment.contractor_inn',
                    [
                        'INN' => $this->contractor->INN,
                    ]
                )
            )
            ->action(
                __('notifications.shipment.approval.show'),
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
