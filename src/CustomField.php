<?php

namespace Hackerff\LaravelCustomForm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * @property Illuminate\Database\Eloquent\Model $field
 * @property Illuminate\Database\Eloquent\Model $creator
 */
class CustomField extends Model
{
    protected $fillable = ['creator_id',''];

    public function __construct(array $attributes = [])
    {
        $this->table = \config('custom_form.field_table');

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($field) {
            $field->creator = Auth::id();
        });
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(\config('auth.providers.users.model'), 'creator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function hasCustomFields()
    {
        return $this->morphTo();
    }
}
