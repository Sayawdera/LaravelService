<?php

namespace App\Console\Commands\Generator;

use Illuminate\Console\Command;

class Remove extends Command
{
    /**
     * The CRUD Files of the console command.
     *
     * @var array
     */
    protected array $fileNames = [
        'app/Events/CrudGeneratorEvent',
        'app/Http/Controllers/CrudGeneratorController',
        'app/Http/Requests/StoreRequest/StoreCrudGeneratorRequest',
        'app/Http/Requests/UpdateRequest/UpdateCrudGeneratorRequest',
        'app/Http/Resources/CrudGeneratorResources',
        'app/Http/Resources/Collections/CrudGeneratorCollection',
        'app/Jobs/CrudGeneratorJob',
        'app/Listeners/CrudGeneratorListener',
        'app/Models/CrudGenerator',
        'app/Observers/CrudGeneratorObserver',
        'app/Repositories/CrudGeneratorRepository',
        'app/Services/CrudGeneratorService',
        'database/factories/CrudGeneratorFactory',
        'database/seeders/CrudGeneratorSeeder',
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator:remove {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[ KILO ]: CRUD Removing or Deleting Success Fully!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $testMethods = ['Index', 'Store', 'Show', 'Update', 'Delete'];
        $httpMethods = ['get', 'post', 'get', 'put', 'delete'];
        $pathX = $this->argument('name');

        foreach ($this->fileNames as $fileName)
        {
            echo "[ KILO ]: " .str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php' . PHP_EOL;
            unlink(str_replace('CrudGenerator', $this->argument('name'), $fileName) . '.php');

            foreach ($testMethods as $index => $methods)
            {
                $testFileName = "tests/Feature/{$pathX}/{$httpMethods[$index]}{$pathX}{$testMethods[$index]}RequestTest.php";
                if (file_exists($testFileName))
                {
                    unlink($testFileName);
                }
            }
        }
        rmdir("tests/Feature/{$pathX}");
        die();
    }
}
