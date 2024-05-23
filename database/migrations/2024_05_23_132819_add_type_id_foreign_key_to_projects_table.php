<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id');       //aggiungo nullable, perchè all'inizio possom anche avere dei post che non hanno un type abbinato, aggiungo after('id') per mettere questo campo dopo id

            $table->foreign('type_id') //la chiave sarà type_id
                ->references('id') //con riferimento all'id
                ->on('types') //della tabella types
                ->onDelete('set null'); //aggiungo questo campo per dire che se il mio type, associato a questo project, viene eliminato, allora il valore viene settato su null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};


//N.B 
//una volta che hai creato la tabella con il comando php artisan make:migration add_type_id_foreign_key_to_projects_table
//ricordati di visualizzare il down, perchè bisogna droppare prima il valore della foreign-key e poi la tabella