<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contractors\ContactPersons\StoreContactPersonRequest;
use App\Http\Requests\Contractors\ContactPersons\UpdateContactPersonRequest;
use App\Models\Contractors\ContactPerson;
use Illuminate\Http\RedirectResponse;

class ContactPersonController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactPersonRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreContactPersonRequest $request)
    {
        $validated = $request->validated()['contact_person'];

        $contactPerson = ContactPerson::create(
            [
                'contractor_id' => $validated['contractor_id'],
                'name' => $validated['name'],
                'post' => $validated['post'],
                'phone' => $validated['phone'],
                'email' => $validated['email']
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.contact_persons.actions.create.success',
                    ['name' => $contactPerson->name]
                )
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContactPersonRequest $request
     * @param ContactPerson|null         $contact_person
     *
     * @return RedirectResponse
     */
    public function update(UpdateContactPersonRequest $request, ContactPerson $contact_person = null)
    {
        $validated = $request->validated();

        foreach ($validated['contact_persons'] as $item) {
            $contactPerson = ContactPerson::find((int)$item['id']);

            $contactPerson->fill(
                [
                    'name' => $item['name'],
                    'post' => $item['post'],
                    'phone' => $item['phone'],
                    'email' => $item['email']
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.contact_persons.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactPerson $contactPerson
     *
     * @return RedirectResponse
     */
    public function destroy(ContactPerson $contactPerson)
    {
        $contactPerson->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.contact_persons.actions.destroy.success',
                    ['name' => $contactPerson->name]
                )
            );
    }

    public function restore(ContactPerson $contactPerson)
    {
        $contactPerson->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.contact_persons.actions.restore.success',
                    ['name' => $contactPerson->name]
                )
            );
    }
}
