<?php

namespace Hackerff\LaravelCustomForm;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CustomFieldData extends Model
{
    protected $fillable = ['user_id','field_id','name','value','batch_id'];

    protected $hidden = ['deleted_at'];

    public function __construct(array $attributes = [])
    {
        $this->table = \config('custom_form.field_value_table');
        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($customFieldData) {
            $customFieldData->user_id = Auth::id();
        });
    }

    public function field()
    {
        return $this->belongsTo(CustomField::class);
    }

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}
