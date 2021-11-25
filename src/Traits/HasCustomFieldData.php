<?php

namespace Hackerff\LaravelCustomForm\Traits;

use Hackerff\LaravelCustomForm\CustomFieldData;

trait HasCustomFieldData
{
    public function customFieldData()
    {
        return $this->hasMany(CustomFieldData::class,'user_id')->orderByDesc("batch_id")->groupBy("field_id");
    }
}
