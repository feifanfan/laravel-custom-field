<?php
namespace Hackerff\LaravelCustomForm\Traits;

use Hackerff\LaravelCustomForm\CustomField;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Illuminate\Database\Eloquent\Model $custom_fields
 */

trait HasCustomFields
{
    public function customFields()
    {
        return $this->morphMany(CustomField::class,'type');
    }

    public function isEmptyField()
    {
        $fields = CustomField::where("type",$this->getTable())->get();
        return $fields->isEmpty();
    }
}
