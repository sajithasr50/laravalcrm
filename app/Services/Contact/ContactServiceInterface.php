<?php

namespace App\Services\Contact;

interface ContactServiceInterface
{
    public function createContact(array $data): \App\Models\Contact;
}
