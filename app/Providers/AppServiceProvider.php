<?php

namespace App\Providers;

use App\Art;
use App\Category;
use App\Observers\ArtObserver;
use App\Observers\CategoryObserver;
use App\Observers\OrderObserver;
use App\Observers\TicketObserver;
use App\Order;
use App\Ticket;
use App\Voyager\Actions\DownloadAction;
use App\Voyager\Actions\UploadAction;
use App\Voyager\FormFields\TagsFormField;
use Illuminate\Support\ServiceProvider;

use App\DeleteAction as MyDeleteAction;
use TCG\Voyager\Actions\DeleteAction;
use TCG\Voyager\Facades\Voyager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(TagsFormField::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
        Ticket::observe(TicketObserver::class);
        Art::observe(ArtObserver::class);
        Category::observe(CategoryObserver::class);



        Voyager::addAction(DownloadAction::class);
        Voyager::addAction(UploadAction::class);
    }
}
