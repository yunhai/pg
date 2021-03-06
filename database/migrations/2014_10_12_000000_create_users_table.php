<?php
#INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `mode`, `remember_token`, `created_user_id`, `updated_user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('99', 'pandog', 'yunhaihuang@gmail.com', '$2y$10$7zy2vsWqV2QnTJYYGZKe4eiRGFlPYhHO3HfFZZSkRnSUqgl1mzPfy', '2', '1', NULL, '0', '0', NULL, NULL, NULL);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->unsignedTinyInteger('role')->default(1);
            $table->unsignedTinyInteger('grade')->default(0);
            $table->unsignedTinyInteger('mode')->default(0);
            $table->unsignedInteger('affiliator_id')->default(0);
            $table->string('provider', 256)->default('');
            $table->string('provider_user_id', 256)->default('');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('diamond_ends_at')->nullable();
            $table->rememberToken();
            $table->unsignedInteger('created_user_id')->default(0);
            $table->unsignedInteger('updated_user_id')->default(0);
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
        Schema::dropIfExists('users');
    }
}
