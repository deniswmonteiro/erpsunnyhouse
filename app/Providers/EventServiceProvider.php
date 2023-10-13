<?php

namespace App\Providers;

use App\Models\Bank;
use App\Models\Client;
use App\Models\Contract;
use App\Models\EquipmentGenerator;
use App\Models\EquipmentOther;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use App\Models\Seller;
use App\Models\User;
use App\Observers\BankObserver;
use App\Observers\ClientObserver;
use App\Observers\ContractObserver;
use App\Observers\EquipmentGeneratorObserver;
use App\Observers\EquipmentOtherObserver;
use App\Observers\EquipmentSolarInverterObserver;
use App\Observers\EquipmentStringBoxObserver;
use App\Observers\SellerObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Client::observe(ClientObserver::class);
        Seller::observe(SellerObserver::class);
        Contract::observe(ContractObserver::class);
        Bank::observe(BankObserver::class);
        EquipmentGenerator::observe(EquipmentGeneratorObserver::class);
        EquipmentSolarInverter::observe(EquipmentSolarInverterObserver::class);
        EquipmentStringBox::observe(EquipmentStringBoxObserver::class);
        EquipmentOther::observe(EquipmentOtherObserver::class);
    }
}
