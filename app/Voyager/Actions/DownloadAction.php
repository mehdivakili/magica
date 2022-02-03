<?php


namespace App\Voyager\Actions;

use TCG\Voyager\Actions\AbstractAction;

class DownloadAction extends AbstractAction
{
    public function getTitle()
    {
        return __('download');
    }

    public function getIcon()
    {
        return 'voyager-download';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right edit',
        ];
    }

    public function getDefaultRoute()
    {
        return route('download_order',[ $this->data->{$this->data->getKeyName()}]);
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'orders';
    }
}
