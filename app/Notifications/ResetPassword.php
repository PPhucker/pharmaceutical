<?php

namespace App\Notifications;

use Closure;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    /**
     * The callback that should be used to create the reset password URL.
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
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param string $token
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Set a callback that should be used when creating the reset password button URL.
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

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    final public function via($notifiable)
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
    final public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return $this->buildMailMessage($this->resetUrl($notifiable));
    }

    /**
     * Get the reset password notification mail message for the given URL.
     *
     * @param string $url
     *
     * @return MailMessage
     */
    final public function buildMailMessage(string $url)
    {
        return (new MailMessage)
            ->subject(__('auth.passwords.reset.action'))
            ->greeting(__('notifications.greeting'))
            ->line(
                __('auth.passwords.reset.mail.message')
            )
            ->action(__('auth.passwords.reset.action'), $url)
            ->line(
                __(
                    'auth.passwords.reset.mail.expire',
                    [
                        'count' => config(
                            'auth.passwords.' . config('auth.defaults.passwords') . '.expire'
                        )
                    ]
                )
            )
            ->salutation(
                __('notifications.salutation')
                . ', '
                . config('app.name')
            );
    }

    /**
     * Get the reset URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(
            route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)
        );
    }
}
