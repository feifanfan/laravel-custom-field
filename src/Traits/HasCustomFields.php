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
        if (empty($this->customFields())){
            return true;
        }
        return false;
    }
}
