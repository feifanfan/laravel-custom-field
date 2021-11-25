<?php

namespace Hackerff\LaravelCustomForm;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomFieldData extends Model
{
    protected $fillable = ['user_id', 'field_id', 'name', 'value', 'batch_id'];

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
            $customFieldData->user_id = $customFieldData->user_id ?? Auth::id();
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

    public static function createCustomFieldData($type, $data = [], $userId = null)
    {
        $time = date("Y-m-d H:i:s", time());
        DB::beginTransaction();
        foreach ($data as $datum) {
            $field = CustomField::where('field_name', $datum['name'])->first();
            if (empty($field)) {
                DB::rollBack();
                abort(422, "数据填写错误");
            }
            $fields = [
                'field_id' => $field['id'],
                'name' => $field['name'],
                'field_name' => $field['field_name'],
                'value' => $datum['value'],
                'batch_id' => $time,
                'user_id' => $userId
            ];
            CustomFieldData::create($fields);
        }
        DB::commit();
    }

}
