<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Activity::saving(function (Activity $activity) {
            // Verifica se não esta rodando comandos no terminal
            if (!app()->runningInConsole() && request()) {

                // Pega as propriedades que já existem no log (ex: o "antes e depois" do banco)
                $properties = $activity->properties;

                // Injeta o IP e o Navegador
                $properties->put('ip', request()->ip());
                $properties->put('user_agent', request()->userAgent());

                // Devolve para o log salvar
                $activity->properties = $properties;
            }
        });

        // Captura login
        Event::listen(function (Login $event) {
            activity('seguranca')
                ->causedBy($event->user)
                ->event('login')
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ])
                ->log("O usuário realizou login no sistema.");
        });

        // Captura tentativas de login falhas
        Event::listen(function (Failed $event) {
            activity('seguranca')
                ->causedBy($event->user) // Pode ser null se o email não existir no banco
                ->event('falha_login')
                ->withProperties(['ip' => request()->ip(), 'user_agent' => request()->userAgent()])
                ->log("Tentativa de login falhou para o e-mail: {$event->credentials['email']}");
        });

        // Captura logOut
        Event::listen(function (Logout $event) {
            if ($event->user) {
                activity('seguranca')
                    ->causedBy($event->user)
                    ->event('logout')
                    ->withProperties([
                        'ip' => request()->ip(),
                        'user_agent' => request()->userAgent()
                    ])
                    ->log("O usuário encerrou a sessão (logout).");
            }
        });
    }
}
