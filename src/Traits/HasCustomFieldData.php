<?php

namespace Hackerff\LaravelCustomForm\Traits;

use Hackerff\LaravelCustomForm\CustomField;
use Hackerff\LaravelCustomForm\CustomFieldData;

trait HasCustomFieldData
{
    public function customFieldData()
    {
        $count = CustomField::where("label",$this->getTable())->groupBy("extension")->count();

        return $this->hasMany(CustomFieldData::class, 'user_id')
            ->orderBy("id", "desc")
            ->orderBy("field_id", "asc")
            ->limit($count);
    }
}
