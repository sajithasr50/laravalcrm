<?php

namespace Tests\Unit;

use App\Models\Contact;
use App\Services\Contact\LeadContactService;
use App\Services\Contact\AccountContactService;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    public function test_it_creates_a_contact_from_lead_source()
    {
        $service = new LeadContactService();

        $contact = $service->createContact([
            'name' => 'Test111',
            'email' => 'test@6677.com',
            'phone' => '12345617189011',
        ]);

        $this->assertEquals('Leads', $contact->source);
        $this->assertDatabaseHas('contacts', ['email' => 'test@6677.com']);
    }

    public function test_it_creates_a_contact_from_account_source()
    {
        $service = new AccountContactService();

        $contact = $service->createContact([
            'name' => 'New Account11',
            'email' => 'new@example111.com',
            'phone' => '8989898998199',
        ]);

        $this->assertEquals('Accounts', $contact->source);
        $this->assertDatabaseHas('contacts', ['email' => 'new@example111.com']);
    }
}

