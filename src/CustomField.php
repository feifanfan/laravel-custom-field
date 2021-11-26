<?php

namespace Hackerff\LaravelCustomForm;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


/**
 * @property Illuminate\Database\Eloquent\Model $field
 * @property Illuminate\Database\Eloquent\Model $creator
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $label
 * @property string $remark
 * @property int $isShow
 * @property int $sorting
 * @property string $creatorId
 * @property int $isUnique
 * @property string $extension
 * @property json $options
 */
class CustomField extends Model
{
    protected $fillable = ['creator_id', 'name', 'type', 'label', 'remark', 'is_show', 'is_unique', 'extension', 'options', 'field_name'];

    protected $hidden = ['deleted_at'];

    protected $casts = ['options'=>'json'];

    public const TEXT_TYPE = 'text';
    public const TEXTAREA_TYPE = 'textarea';
    public const RADIO_TYPE = 'radio';
    public const CHECKBOX_TYPE = 'checkbox';
    public const DATE_TYPE = 'date';
    public const DATETIME_TYPE = 'datetime';
    public const PHONE_TYPE = 'phone';
    public const INT_TYPE = 'int';
    public const FLOAT_TYPE = 'float';
    public const FILE_TYPE = 'file';

    public const TYPE_LABELS = [
        self::TEXT_TYPE => '文本',
        self::TEXTAREA_TYPE => '多行文本',
        self::RADIO_TYPE => '单选',
        self::CHECKBOX_TYPE => '多选',
        self::DATE_TYPE => '日期',
        self::DATETIME_TYPE => '时间',
        self::PHONE_TYPE => '手机号',
        self::INT_TYPE => '整数',
        self::FLOAT_TYPE => '小数',
        self::FILE_TYPE => '文件',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = \config('custom_form.field_table');

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($field) {
            $field->creator_id = Auth::id();
            self::typeValidate($field);
        });

        self::updating(function ($field) {
            if($field->isDirty('type')){
                self::typeValidate($field);
                if ($field->type != self::RADIO_TYPE && $field->type != self::CHECKBOX_TYPE) {
                    $field->options = null;
                }
            }
        });

        self::created(function ($field) {
            if (empty($field->filed_name)) {
                $field->field_name = 'field_'.$field->id;
            }
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

    public static function typeValidate($field)
    {
        abort_if(!in_array($field->type, array_keys(self::TYPE_LABELS)), 422, 'type验证失败');
        if ($field->type == self::RADIO_TYPE || $field->type == self::CHECKBOX_TYPE) {
            abort_if(empty($field->options), 422, "选项不能为空");
        }
    }

}
