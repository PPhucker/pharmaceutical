<?php

namespace App\Events\Auth;

use App\Models\Admin\Organization\Organization;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Эвент авторизации пользователя.
 */
class UserLoggedIn
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var int|null
     */
    private $organizationId;
    /**
     * @var Organization
     */
    public $organization;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $organizationId)
    {
        $this->organization = Organization::find($organizationId);
    }
}
