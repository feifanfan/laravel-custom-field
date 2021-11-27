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
        $fields = CustomField::where("type",$this->getTable())->where('is_unique',1)->get();
        return $fields->isEmpty();
    }
}
