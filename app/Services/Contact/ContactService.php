<?php

namespace App\Services\Contact;

use App\Models\Contact;


class ContactService implements ContactServiceInterface
{
    public function createContact(array $data): Contact
    {
        $data['source'] = $data['source'] ?? 'Other'; // Default source
        return Contact::create($data);
    }
}
