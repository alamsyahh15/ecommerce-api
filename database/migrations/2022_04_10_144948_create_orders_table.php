<?php

use App\Models\StatusOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('trx_code')->unique();
            $table->integer('status_order')->default(StatusOrder::UNPAID)->comment('1 = Unpaid, 2 = Paid');
            $table->integer('status_shipping')->default(StatusOrder::INITIAL)->comment('1 = Init, 2 = Progress, 3 = Complete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
