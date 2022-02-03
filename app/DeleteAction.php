<?php

namespace App;

use TCG\Voyager\Actions\DeleteAction as VoyagerDeleteAction;

class DeleteAction extends VoyagerDeleteAction
{
    public function getDefaultRoute()
    {

     if(!!strpos(url()->full(),"orders")){
         return route('cancel_order');
     }else {
         return 'javascript:;';
     }
    }
}
