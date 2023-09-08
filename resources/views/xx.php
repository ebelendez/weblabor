<?php

use App\Mail\mailReporte;
use App\Models\Emails;
use App\Models\Proyecto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

//$proy = Proyecto::find(1);

//Mail::to(config('mail.to.address'))->send(new mailReporte());
//Emails::find(1)
//$mails = Emails::find(1);
//Log::channel('app')->debug('test');
//$dt = Carbon::parse();
/*dd(
    $mails->updated_at,
    Carbon::now()->diffInSeconds($mails->updated_at) / 60
    //Carbon::now()->toDateString()
);*/
dd(
    Proyecto::count()
);
//Proyecto::factory(2)->create();
