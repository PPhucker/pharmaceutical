<?php

namespace App\Notifications;

use Closure;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    /**
     * The callback that should be used to create to verify email URL.
     *
     * @var Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
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
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return $this->buildMailMessage($verificationUrl);
    }

    /**
     * Get to verify email notification mail message for the given URL.
     *
     * @param string $url
     *
     * @return MailMessage
     */
    protected function buildMailMessage(string $url)
    {
        return (new MailMessage)
            ->subject(__('auth.verify.action'))
            ->greeting(__('notifications.greeting'))
            ->line(__('auth.verify.mail.verify'))
            ->action(__('auth.verify.action'), $url)
            ->line(__('auth.verify.mail.no_verify'))
            ->salutation(
                __('notifications.salutation')
                . ', '
                . config('app.name')
            );
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Set a callback that should be used when creating the email verification URL.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public static function createUrlUsing(Closure $callback)
    {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public static function toMailUsing(Closure $callback)
    {
        static::$toMailCallback = $callback;
    }
}
