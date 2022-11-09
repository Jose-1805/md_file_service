<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->unique()->comment('Identificador único de cada registro');
            $table->string('location', 250)->comment('Ruta absoluta al directorio donde se almacena el archivo');
            $table->string('name', 250)->comment('Nombre del archivo con extensión incluida');
            $table->string('item_type', 45)->comment('Nombre del modelo o entidad propietario del archivo')->nullable();
            $table->string('item', 45)->comment('Identificador del elemento propietario del archivo')->nullable();
            $table->string('extra_name', 45)->comment('Nombre de un campo extra para almacenar y asociar al archivo')->nullable();
            $table->string('extra_data', 250)->comment('Valor del campo extra para almacenar y asociar al archivo')->nullable();
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
        Schema::dropIfExists('files');
    }
};
