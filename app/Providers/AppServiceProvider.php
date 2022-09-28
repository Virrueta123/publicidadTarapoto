<?php

namespace App\Providers;

use App\Models\deudas;
use App\Models\PedientesCalendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_Pe', 'es', 'PE', 'es_PE.utf8');

        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                $pendientes = PedientesCalendar::select("*")
                ->join('cliente', 'cliente.Clx_Id', '=', 'pendientes.Clx_Id')
                ->where("pendientes.Pex_Fecha",fecha_hoy())
                ->where("pendientes.active","A") 
                ->get();
                
                $pendientesDay = PedientesCalendar::select("*")
                ->join('cliente', 'cliente.Clx_Id', '=', 'pendientes.Clx_Id')
                ->where(DB::raw("DATE_ADD(pendientes.Pex_Fecha,interval -1 day)"),fecha_hoy()) 
                ->where("pendientes.active","A") 
                ->get(); 
                 
                $notificacionPendientesCount = count($pendientes) + count($pendientesDay);

                $deudas = deudas::select("*")
                ->join('ingresos', 'ingresos.Igx_Id', '=', 'deudas.Igx_Id')
                ->leftjoin('cliente', 'cliente.Clx_Id', '=', 'ingresos.Clx_Id')
                ->where("deudas.active","A")
                ->get();
                 
                view()->share(["pendientes"=>$pendientes,"pendientesDay"=>$pendientesDay,"notificacionPendientesCount"=>$notificacionPendientesCount,"deudas"=>$deudas]);
            }else {
                $view->with('currentUser', null);
            }
        });
    }
}
