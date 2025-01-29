<?php
// app/Providers/ContactServiceProvider.php
namespace App\Providers;

use App\Services\Contact\ContactServiceInterface;
use App\Services\Contact\LeadContactService;
use App\Services\Contact\AccountContactService;
use App\Services\Contact\ContactService;
use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ContactServiceInterface::class, function ($app) {
            $source = request()->input('source');

            return match ($source) {
                'Leads' => new LeadContactService(),
                'Accounts' => new AccountContactService(),
                default => new ContactService(),
            };
        });
    }
}
