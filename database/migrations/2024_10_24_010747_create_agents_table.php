<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance')->nullable();
            $table->string('sexe')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('civilite')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('telephone')->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->string('adresse')->nullable();
            $table->string('poste_actuel')->nullable();
            $table->boolean('actif')->default(true);
            $table->date('date_embauche')->nullable();
            $table->string('photo')->nullable();
            $table->text('certifications')->nullable();
            $table->date('dernier_diplome')->nullable();
            $table->string('pin')->unique()->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();
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
        Schema::dropIfExists('agents');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
};
