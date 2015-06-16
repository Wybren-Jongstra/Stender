<?php namespace App\Commands\Benchmarks;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// Import the needed classes.
// TODO It looks that Laravel autoloader isn't working correct. Couldn't find a way to fix it. Maybe fix this some day.
use Illuminate\Support\Facades\DB;
use AccountKind;

class GetAccountKindBenchmark extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'benchmark:getAccountKind';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Benchmarks the speed of getting the account kinds that are external accounts.';

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
            AccountKind::where('Name', '!=', 'Stender')->get();
        }

        if($this->option('method'))
        {
            $this->runBenchmark($this->option('method'));
        }
        else
        {
            foreach ($this->getMethodName() as $methodName)
            {
                $this->runBenchmark($methodName);
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
			array('method', null, InputOption::VALUE_OPTIONAL, 'Run a specific method. ' .
                  'Possible options: ' . implode(', ', $this->getMethodName()), null),
            array('iterations', null, InputOption::VALUE_OPTIONAL, 'Number of iterations that must be executed. ' .
                 'The value must be greater than 0.', 10),
		);
	}

    private function getMethodName()
    {
        return array(
            'db',
            'model'
        );
    }

    private function runBenchmark($benchmarkName)
    {
        switch ($benchmarkName) {
            case 'db':
                $this->runDbBenchmark();
                break;
            case 'model':
                $this->runModelBenchmark();
                break;
            default:
                $this->error('Invalid method name! Possible options: ' . implode(', ', $this->getMethodName()));
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
            // Get account kinds
            $accountKinds = DB::table('ACCOUNT_KIND')->where('Name', '!=', 'Stender')->get();

            foreach($accountKinds as $accountKind)
            {
                $accountKind->Name;
            }
        }
        $this->info('db loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

    /**
     * runModelBenchmark method
     */
    private function runModelBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            // Get account kinds
            $accountKinds = AccountKind::where('Name', '!=', 'Stender')->get();

            foreach($accountKinds as $accountKind)
            {
                $accountKind->Name;
            }
        }
        $this->info('model loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

}
