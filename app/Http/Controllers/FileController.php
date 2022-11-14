<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Models\File;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    use ApiResponser;
    /**
     * Lista de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->httpOkResponse(File::all());
    }

    /**
     * Crea un registro del recurso
     *
     * @param  App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $file = File::create($request->all());
        $request->file('file')->storeAs($request->location, $request->name);
        return $this->generateResponse($file, Response::HTTP_CREATED);
    }

    /**
     * Obtiene el recurso especificado
     *
     * @param  App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return $this->httpOkResponse($file);
    }

    /**
     * Actualiza un recurso especifico
     *
     * @param  App\Http\Requests\UpdateFileRequest  $request
     * @param  App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $old_location = $file->getFullPath();
        $file->update($request->all());
        if ($request->has('file')) {
            $file->removeFromStorage();
            $request->file('file')->storeAs($request->location, $request->name);
        // Si no hay archivos pero la ubicación cambia, se mueve el archivo a la nueva ubicación
        } elseif ($old_location != $file->getFullPath()) {
            Storage::move($old_location, $file->getFullPath());
        }
        return $this->httpOkResponse($file);
    }

    /**
     * Elimina un recurso especifico
     *
     * @param  App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->removeFromStorage();
        $file->delete();
        return $this->httpOkResponse();
    }

    /**
     * Descarga del archivo
     *
     * @param File $file
     * @return void
     */
    public function download(File $file)
    {
        return $file->download();
    }
}
