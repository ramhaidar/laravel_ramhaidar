<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up () : void
    {
        Schema::create ( 'pasiens', function (Blueprint $table)
        {
            $table->id ();
            $table->string ( 'nama_pasien' );
            $table->string ( 'alamat' );
            $table->string ( 'no_telepon' );
            $table->foreignId ( 'rumah_sakit_id' )
                ->nullable ()
                ->constrained ( 'rumah_sakits' )
                ->onDelete ( 'cascade' ); // Menambahkan on delete cascade
            $table->timestamps ();
        } );

    }

    /**
     * Reverse the migrations.
     */
    public function down () : void
    {
        Schema::dropIfExists ( 'pasiens' );
    }
};