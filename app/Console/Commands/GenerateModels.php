<?php namespace Pikd\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateModels extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all classes under \Pikd\Models from Postgres data.';

    protected $product_tables = [
        'attribute_values',
        'attributes',
        'products_suppliers',
        'stores',
        'brands',
        'categories',
        'images',
        'manufacturers',
        'product_families',
        'products',
        'suppliers',
    ];

    protected $customer_tables = [
        'order_products',
        'address_books',
        'customers',
        'orders',
    ];

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
        $test_mode = false;

        foreach ($this->product_tables as $table_name) {
            echo 'Making model for table ' . $table_name . PHP_EOL;
            $this->generateModel('product', $table_name, $test_mode);
        }

        foreach ($this->customer_tables as $table_name) {
            echo 'Making model for table ' . $table_name . PHP_EOL;
            $this->generateModel('customer', $table_name, $test_mode);
        }
    }

    private function generateModel($db, $table_name, $test_mode) {
        $sql = 'select column_name from information_schema.columns where table_name = ?';
     
        $columns = \DB::connection($db)->select($sql, [$table_name]);

        $model_name = $this->makeClassName($table_name);

        $model = '<?php namespace Pikd\Models;' . PHP_EOL . PHP_EOL;
        $model .= 'use Illuminate\Database\Eloquent\Model;' . PHP_EOL . PHP_EOL;
        $model .= 'class ' . $model_name . ' extends Model {' . PHP_EOL . PHP_EOL;
        $model .= '    protected $primaryKey = \'' . $columns[0]['column_name'] . '\';' . PHP_EOL;
        $model .= '    protected $connection = \'' . $db . '\';' . PHP_EOL;
        $model .= '    public $timestamps = false;' . PHP_EOL . PHP_EOL;
        $model .= '}';

        if ($test_mode) {
            echo $model;
        } else {
            file_put_contents(dirname(__FILE__) . '/../../Models/' . $model_name . '.php', $model);
        }
    }


    private function makeClassName($table_name) {
        $name = str_replace(' ', '', ucwords(str_replace('_', ' ', $table_name)));

        if (substr($name, -3) === 'ies') {
            return substr($name, 0, -3) . 'y';
        } else {
            return substr($name, 0, -1);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            // ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            // ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
