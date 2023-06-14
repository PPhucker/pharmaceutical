<?php

namespace App\Notifications\Shipment;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class ToMarketing extends Notification implements ShouldQueue
{
    use Queueable;

    private const DELAY_IN_MINUTES = 1;

    private const SHIPMENT_DOCUMENTS = [
        'bill',
        'appendix',
        'protocol',
        'waybill',
    ];
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

        $resolution = $this->documentsIsApproved()
            ? __('notifications.shipment.approval.success')
            : __('notifications.shipment.approval.fail');

        return (new MailMessage())
            ->subject(
                $resolution
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
            ->line($resolution)
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
     * @return bool
     */
    private function documentsIsApproved()
    {
        foreach (self::SHIPMENT_DOCUMENTS as $relation) {
            $document = $this->packingList->$relation()->first();

            if ($document && (int)$document->approved === 0) {
                return false;
            }
        }

        return true;
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
