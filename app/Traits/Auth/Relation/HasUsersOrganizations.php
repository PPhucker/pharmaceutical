<?php

namespace App\Traits\Auth\Relation;

use App\Models\Admin\Organization\Organization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use function in_array;
use function is_array;

/**
 * Трейт организаций пользователя.
 */
trait HasUsersOrganizations
{
    /**
     * @param array|int $organizations
     *
     * @return bool
     */
    public function hasOrganization($organizations): bool
    {
        if (!is_array($organizations)) {
            $organizations = [$organizations];
        }

        $userOrganizations = $this->organizations()->getQuery()
            ->withoutGlobalScopes()
            ->pluck('organizations.id')
            ->toArray();

        foreach ($organizations as $organization) {
            if (in_array($organization, $userOrganizations, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return BelongsToMany
     */
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organizations_users')
            ->withTimestamps();
    }

    /**
     * @param $organizations
     *
     * @return $this
     */
    public function refreshOrganizations($organizations): self
    {
        if (!$organizations) {
            return $this;
        }

        $this->organizations()->withoutGlobalScopes()->detach();

        return $this->attachOrganizationsTo($organizations);
    }

    /**
     * @param $organizationsIds
     *
     * @return $this
     */
    public function attachOrganizationsTo($organizations): self
    {
        $organizations = $this->getOrganizationsIds($organizations);
        $this->organizations()->withoutGlobalScopes()->saveMany($organizations);
        return $this;
    }

    /**
     * @param $organizations
     *
     * @return Collection
     */
    protected function getOrganizationsIds($organizations): Collection
    {
        return Organization::withoutGlobalScopes()
            ->whereIn('id', $organizations)->get();
    }
}
