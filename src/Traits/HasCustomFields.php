<?php
namespace Hackerff\LaravelCustomForm\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Illuminate\Database\Eloquent\Model $custom_fields
 */

trait HasCustomFields
{
    public function customFields()
    {
        return $this->morphMany(config('custom_form.field_table'),'type');
    }
}
