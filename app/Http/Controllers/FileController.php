<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Models\File;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

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
        $file->update($request->all());
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
        $file->delete();
        return $this->httpOkResponse();
    }
}
