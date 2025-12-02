<?php

namespace App\Providers;

use App\Models\MediaSocial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Share media social data to all views
        View::composer('*', function ($view) {
            try {
                // HAPUS CACHE DULU untuk debugging
                cache()->forget('media_socials');
                
                // SEMENTARA nonaktifkan cache, selalu query fresh
                $mediaSocials = MediaSocial::active()
                    ->ordered()
                    ->get();
                
                // Log untuk debugging
                \Log::info('MediaSocial Data:', [
                    'count' => $mediaSocials->count(),
                    'data' => $mediaSocials->pluck('platform')->toArray()
                ]);
                
                $view->with('mediaSocials', $mediaSocials);
            } catch (\Exception $e) {
                \Log::error('MediaSocial Error: ' . $e->getMessage());
                $view->with('mediaSocials', collect([]));
            }
        });
    }
}