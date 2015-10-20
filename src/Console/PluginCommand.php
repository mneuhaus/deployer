<?php
/* (c) Marc Neuhaus <mneuhaus@famelo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Deployer\Console;

use Deployer\Deployer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Input\InputOption as Option;
use Symfony\Component\Console\Output\OutputInterface as Output;
use Symfony\Component\Process\Process;

class PluginCommand extends Command
{

    /**
     * The output handler.
     *
     * @var OutputInterface
     */
    private $output;

    /**
     * @override
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('plugin');
        $this->setDescription('manage external plugins');

        $this->addArgument('package');
    }

    /**
     * @override
     */
    protected function execute(Input $input, Output $output)
    {
        $this->output = $output;
        $this->input = $input;
        $action = $input->getArgument('stage');
        $package = $input->getArgument('package');

        if (!file_exists(DEPLOYER_PLUGIN_PATH)) {
            mkdir(DEPLOYER_PLUGIN_PATH);
        }

        chdir(DEPLOYER_PLUGIN_PATH);

        $process = new Process('composer require ' . $package);
        $process->run();
   }
}

?>
