<?php namespace App\Commands\Benchmarks;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

// Import the needed classes.
// TODO It looks that Laravel autoloader isn't working correct. Couldn't find a way to fix it. Maybe fix this some day.
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompareProfileUrlPartBenchmark extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'benchmark:compareProfileUrlPart';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Benchmarks the speed of comparing a ProfileUrlPart with different methods.';

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
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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
            array('profileUrlPart', null, InputOption::VALUE_OPTIONAL, 'The ProfileUrlPart that must be used. ', 'raymon.bunt'),
		);
	}

    private function getMethodName()
    {
        return array(
            'validator',
            'array'
        );
    }

    private function runBenchmark($benchmarkName)
    {
        switch ($benchmarkName) {
            case 'validator':
                $this->runValidatorBenchmark();
                break;
            case 'array':
                $this->runArrayBenchmark();
                break;
            default:
                $this->error('Invalid method name!');
        }
    }

    /**
     * runValidatorBenchmark method
     */
    private function runValidatorBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            $increment = 0;
            do
            {
                if($increment > 0)
                {
                    $newProfileUrlPart = $this->option('profileUrlPart') . $increment;
                }
                else
                {
                    $newProfileUrlPart = $this->option('profileUrlPart');
                }

                $valPart = Validator::make(
                    ['ProfileUrlPart' => $newProfileUrlPart],
                    ['ProfileUrlPart' => 'unique:USER_PROFILE,ProfileUrlPart']
                );

                $increment++;
            }
            while($valPart->fails());
        }
        $this->info('validator loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

    /**
     * runArrayBenchmark method
     */
    private function runArrayBenchmark()
    {
        $t0 = microtime(true);
        for ($i = 0; $i < ($this->option('iterations')); $i++)
        {
            // Get results
            // REMARK: Simple SQL-Injection possible. You can use the % sign to get more (unexpected) results.
            $results = DB::table('USER_PROFILE')->select('ProfileUrlPart')->where('ProfileUrlPart', 'LIKE', $this->option('profileUrlPart') . '%')->get();

            // Convert results to an array
            $profileUrlParts = array();
            for ($j = 0, $length = count($results); $j < $length; $j++)
            {
                $profileUrlParts[$j] = $results[$j]->ProfileUrlPart;
            }

            // First check the given ProfileUrlPart
            $newProfileUrlPart = $this->option('profileUrlPart');

            // Check if ProfileUrlPart already exists
            // If not generate an unique ProfileUrlPart
            $increment = 0;
            while(in_array($newProfileUrlPart, $profileUrlParts))
            {
                $increment++;
                $newProfileUrlPart = $this->option('profileUrlPart') . $increment;
            }
        }
        $this->info('array loop: ' . (microtime(true) - $t0) . ' s', PHP_EOL);
    }

}
