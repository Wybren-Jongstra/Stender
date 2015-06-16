<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/
Artisan::resolve('App\Commands\Benchmarks\SeedBenchmark');
Artisan::resolve('App\Commands\Benchmarks\CompareProfileUrlPartBenchmark');
Artisan::resolve('App\Commands\Benchmarks\GetAccountKindBenchmark');