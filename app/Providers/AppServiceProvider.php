<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\OrderStatus;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $setting = Setting::limit(1)->first();
        view()->share('setting',$setting);

        $contact = Contact::limit(1)->first();
        view()->share('contact',$contact);

        $contact = Contact::limit(1)->first();
        view()->share('contact',$contact);

        $orderstatuses = OrderStatus::where('status', 1)->get();
        view()->share('orderstatuses',$orderstatuses);
    }
}
