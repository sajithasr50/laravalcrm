<?php
namespace App\Services\Contact;

use App\Models\Contact;

class AccountContactService extends ContactService
{
    public function createContact(array $data): Contact
    {
        $data['source'] = 'Accounts'; // Default source
        return parent::createContact($data);
    }
}
