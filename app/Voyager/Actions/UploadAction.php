<?php


namespace App\Voyager\Actions;

use TCG\Voyager\Actions\AbstractAction;

class UploadAction extends AbstractAction
{
    public function getTitle()
    {
        return __('upload');
    }

    public function getIcon()
    {
        return 'voyager-upload';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right edit',
        ];
    }

    public function getDefaultRoute()
    {
        return route('upload_order',[ $this->data->{$this->data->getKeyName()}]);
    }
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'orders';
    }
}
