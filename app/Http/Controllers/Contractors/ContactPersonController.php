<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\ContactPersons\StoreContactPersonRequest;
use App\Http\Requests\Contractors\ContactPersons\UpdateContactPersonRequest;
use App\Models\Contractors\ContactPerson;
use App\Services\Contractor\ContactPersonService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер контактного лица контрагента.
 */
class ContactPersonController extends CoreController
{
    /**
     * @var string
     */
    protected $prefixLocalKey = 'contractors.contact_persons';
    /**
     * @var ContactPersonService
     */
    private $service;

    /**
     * @param ContactPersonService $service
     */
    public function __construct(ContactPersonService $service)
    {
        $this->service = $service;
        $this->authorizeResource(ContactPerson::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactPersonRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreContactPersonRequest $request): RedirectResponse
    {
        $contactPerson = $this->service->create(
            $request->validated()['contact_person']
        );

        return $this->successRedirect(
            'create',
            ['name' => $contactPerson->name]
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactPersonRequest $request
     * @param ContactPerson              $contactPerson
     *
     * @return RedirectResponse
     */
    public function update(UpdateContactPersonRequest $request, ContactPerson $contactPerson): RedirectResponse
    {
        $this->service->update(
            $contactPerson,
            $request->validated()['contact_persons']
        );

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactPerson $contactPerson
     *
     * @return RedirectResponse
     */
    public function destroy(ContactPerson $contactPerson): RedirectResponse
    {
        $this->service->delete($contactPerson);

        return $this->successRedirect(
            'delete',
            ['name' => $contactPerson->name]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param ContactPerson $contactPerson
     *
     * @return RedirectResponse
     */
    public function restore(ContactPerson $contactPerson): RedirectResponse
    {
        $this->service->restore($contactPerson);

        return $this->successRedirect(
            'restore',
            ['name' => $contactPerson->name]
        );
    }
}
