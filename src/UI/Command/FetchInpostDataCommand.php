<?php
declare(strict_types=1);

namespace App\UI\Command;

use App\Application\Service\InpostFetcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'app:fetch-inpost', description: 'Fetch data from Inpost api.')]
class FetchInpostDataCommand extends Command
{
    const INPOST_METHOD_ARG = 'method';
    const INPOST_CITY_ARG = 'city';
    const INPOST_PAGE_OPTION = 'page';
    const INPOST_PER_PAGE_OPTION = 'per_page';

    const DEFAULT_PER_PAGE_VALUE = 0;
    const DEFAULT_PAGE_VALUE = 0;
    const MAX_PER_PAGE_VAL = 500;

    public function __construct(private InpostFetcher $inpostFetcher)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::INPOST_METHOD_ARG, InputArgument::REQUIRED, 'The name of inpost method.')
            ->addArgument(self::INPOST_CITY_ARG, InputArgument::OPTIONAL, 'The name of city.')
            ->addOption(self::INPOST_PAGE_OPTION, null, InputOption::VALUE_OPTIONAL, 'Page number', self::DEFAULT_PAGE_VALUE)
            ->addOption(self::INPOST_PER_PAGE_OPTION, null, InputOption::VALUE_OPTIONAL, \sprintf('Items per page. Max value is %d', self::MAX_PER_PAGE_VAL), self::DEFAULT_PER_PAGE_VALUE)
            ->setHelp('Fetch data from Inpost api. For example to get points for city Kozy run app:fetch-inpost points Kozy --page=1 --per_page=100');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {        
        dump($this->inpostFetcher->get($input->getArgument(self::INPOST_METHOD_ARG), $this->getParams($input)));
        return Command::SUCCESS;
    }

    private function getParams(InputInterface $input): array
    {
        $params[self::INPOST_CITY_ARG] = $input->getArgument(self::INPOST_CITY_ARG);
       
        if ($page = (int) $input->getOption(self::INPOST_PAGE_OPTION)) {
            $params[self::INPOST_PAGE_OPTION] = $page;
        }

        if ($perPage = (int) $input->getOption(self::INPOST_PER_PAGE_OPTION)) {
            $params[self::INPOST_PER_PAGE_OPTION] = $perPage <= self::MAX_PER_PAGE_VAL ? $perPage : self::MAX_PER_PAGE_VAL;
        }

        return $params;
    }
}
