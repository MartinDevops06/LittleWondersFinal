<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('address_id')->constrained('addresses');

            // Cambiamos ENUM por STRING
            $table->string('status')->default('Pending');
            $table->string('payment_method'); // 'Card' o 'Cash'

            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2);
            $table->decimal('total', 10, 2);

            $table->timestamps();

            $table->index('user_id', 'fk_order_user_idx');
            $table->index('address_id', 'fk_order_address1_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
