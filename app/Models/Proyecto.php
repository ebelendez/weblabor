<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'publico', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Guarda la imagen subida
     * @param $imagen
     */
    public function saveUpImg($imagen){
        $filename = $this->getUpFilename($imagen->getClientOriginalExtension());
        $imagen->storeAs('public/imagenes', $filename);
        $this->update(['imagen' => $filename]);
    }

    /**
     * Elimina la imagen subida
     */
    public function delUpImg(){
        if($this->imagen){
            $path = storage_path('app\public\imagenes\\'.$this->imagen);
            if(File::exists($path))File::delete($path);
        }
        $this->delete();
    }

    /**
     * Obtiene el nombre de la imagen subida
     * @param $ext
     * @return string
     */
    protected function getUpFilename($ext){
        return 'img_'.Auth::id().'_'.$this->id.'.'.$ext;
    }
}
