<?php

namespace App\Models;

use App\Mail\mailReporte;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Emails extends Model
{
    protected $fillable = ['envio_en_espera'];
    protected $table = 'emails';

    /**
     * Modifica DB para indicar que hubo actualizaciones en proyectos
     */
    public static function programarCorreo(){
        $mails = self::find(1);
        if(!$mails->envio_en_espera)$mails->update(['envio_en_espera' => 1]);
    }

    /**
     * Envia el correo si hubo actualizaciones y si ya paso el tiempo de espera
     * Es necesario descomentar la línea de envio
     * El log refleja el tiempo transcurrido
     */
    public static function enviarCorreo(){
        $mails = self::find(1);
        if($mails->envio_en_espera){
            $dif_min = Carbon::now()->diffInSeconds($mails->updated_at) / 60;
            if($dif_min > env('MAIL_REPORT_SEND_AFTER_MIN')){
                $mails->update(['envio_en_espera' => 0]);
                Log::channel('app')->debug('Enviando email');
                //Mail::to(config('mail.to.address'))->send(new mailReporte());
            }else Log::channel('app')->debug('Email: Aún no, van: '.$dif_min.' min de '.env('MAIL_REPORT_SEND_AFTER_MIN').' min');
        }
    }
}
