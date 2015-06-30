<?php namespace App\Commands\Benchmarks;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// Import the needed classes.
use Illuminate\Support\Facades\DB;
use UserProfile;

class SeedBenchmark extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'benchmark:seed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Benchmarks the speed of seeding with different methods.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        if( ! $this->argument('noCache'))
        {
            // Fill the cache with the heaviest object oriented query to the database
            UserProfile::all();
        }

        if($this->option('benchmark'))
        {
            $this->runBenchmark($this->option('benchmark'));
        }
        else
        {
            foreach ($this->getSeedBenchmarkNames() as $benchmarkName)
            {
                $this->runBenchmark($benchmarkName);
            }
        }
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
            array('noCache', InputArgument::OPTIONAL, 'Fills not in advance the cache with the results from the model/the models.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('benchmark', null, InputOption::VALUE_OPTIONAL, 'Run a specific seed benchmark. ' .
                  'Possible options: ' . implode(', ', $this->getSeedBenchmarkNames()), null),
            array('iterations', null, InputOption::VALUE_OPTIONAL, 'Number of iterations that must be executed. ' .
                 'The value must be greater than 0.', 50),
		);
	}

    private function getSeedBenchmarkNames()
    {
        return array(
            'db',
            'dbSelect',
            'model',
            'allModels',
        );
    }

    private function runBenchmark($benchmarkName)
    {
        switch ($benchmarkName) {
            case 'db':
                $this->runDbBenchmark();
                break;
            case 'dbSelect':
                $this->runDbSelectBenchmark();
                break;
            case 'model':
                $this->runModelBenchmark();
                break;
            case 'allModels':
                $this->runAllModelsBenchmark();
                break;
            default:
                $this->error('Invalid seed benchmark name! ' .
                    'Possible options: ' . implode(', ', $this->getSeedBenchmarkNames()));
        }
    }

    /**
     * runDbBenchmark method
     */
    private function runDbBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            $results = DB::table('USER_PROFILE')->where('ProfileUrlPart', 'LIKE', 'raymon.bunt%')->get();
            foreach ($results as $row)
            {
                $row->ProfileUrlPart;
            }
        }
        $this->info('db loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

    /**
     * runDbSelectBenchmark method
     */
    private function runDbSelectBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            $results = DB::table('USER_PROFILE')->select('ProfileUrlPart')->where('ProfileUrlPart', 'LIKE', 'raymon.bunt%')->get();
            foreach ($results as $row)
            {
                $row->ProfileUrlPart;
            }
        }
        $this->info('db with select loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

    /**
     * runModelBenchmark method
     */
    private function runModelBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            $results = UserProfile::select('ProfileUrlPart')->where('ProfileUrlPart', 'LIKE', 'raymon.bunt%')->get();
            foreach ($results as $userProfile)
            {
                $userProfile->ProfileUrlPart;
            }
        }
        $this->info('model loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }


    /**
     * runAllModelsBenchmark method
     */
    private function runAllModelsBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            $results = UserProfile::all();
            foreach ($results as $userProfile)
            {
                $userProfile->ProfileUrlPart;
            }
        }
        $this->info('all models loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }
}
