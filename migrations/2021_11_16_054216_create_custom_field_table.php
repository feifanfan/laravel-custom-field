<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_field', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("名称");
            $table->string("type")->comment("类型：字段类型 text单行文本 textarea多行文本 radio单选 date日期 int数字 float小数 phone手机 file文件 checkbox多选 datetime日期时间");
            $table->string("label")->comment("标签：customers客户，tracks:线索...,自行设计，与表名相同");
            $table->string("remark")->default("")->comment("备注");
            $table->boolean("is_show")->default(true)->comment("是否展示");
            $table->integer("sorting")->default(1)->comment("排序，从小到大");
            $table->boolean("is_unique")->default(true)->comment("是否必填");
            $table->string("creator_id")->comment("创建者id");
            $table->string("extension")->comment("自定义字段");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_field');
    }
}