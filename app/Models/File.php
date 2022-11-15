<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class File extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'files';

    protected $fillable = [
        'location',
        'name',
        'item_type',
        'item',
        'extra_name',
        'extra_data',
    ];

    /**
     * Elimina el archivo en el almacenamiento
     *
     * @return void
     */
    public function removeFromStorage(): void
    {
        Storage::delete($this->getFullPath());
    }

    /**
     * Obtiene la ruta completa del archivo
     *
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->location."/".$this->name;
    }

    /**
     * Envía el archivo como respuesta de una petición
     *
     * @return     StreamedResponse
     */
    public function download(): StreamedResponse
    {
        if (Storage::exists($this->getFullPath())) {
            return Storage::download($this->getFullPath(), $this->name, ['Content-Disposition' => 'inline']);
        }
        abort(404);
    }
}
