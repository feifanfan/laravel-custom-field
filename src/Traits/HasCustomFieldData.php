<?php

namespace Hackerff\LaravelCustomForm\Traits;

trait HasCustomFieldData
{
    public function customFieldData()
    {
        return $this->morphMany(config('custom_form.field_table'),'label');
    }
}
