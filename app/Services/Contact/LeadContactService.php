<?php
namespace App\Services\Contact;

use App\Models\Contact;

class LeadContactService extends ContactService
{
    public function createContact(array $data): Contact
    {
        $data['source'] = 'Leads'; // Default source
        return parent::createContact($data);
    }
}
