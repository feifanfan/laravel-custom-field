<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_field_data', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->comment("用户id");
            $table->integer("field_id")->comment("自定义列的id");
            $table->string("name")->comment("列名称，冗余字段");
            $table->longText("value")->comment("字段值");
            $table->integer("batch_id")->nullable()->comment("该值是第几次提交,或者填写最后的时间,可不填写，用updated_ats查询");
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
        Schema::dropIfExists('custom_field_data');
    }
}
