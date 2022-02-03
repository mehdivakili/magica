<?php


namespace App\Voyager\Dimmers;

use App\User;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class UserDimmer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = User::count();
        $string = 'Users';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-news',
            'title'  => "{$count} {$string}",
            'text'   => "You have $count users in your database. Click on button below to view all users.",
            'button' => [
                'text' => 'View All Users',
                'link' => 'admin/users',
            ],
            'image' => Voyager::image('widgets/users.png'),
        ]));
    }

    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
