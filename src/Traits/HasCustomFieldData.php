<?php

namespace Hackerff\LaravelCustomForm\Traits;

use Hackerff\LaravelCustomForm\CustomFieldData;

trait HasCustomFieldData
{
    public function customFieldData()
    {
        return $this->morphMany(CustomFieldData::class,'label','label','id','field_id');
    }
}
