<?php
namespace Trs\Core\Calculators;

use Trs\Core\Interfaces\IAggregator;
use Trs\Core\Interfaces\ICalculator;
use Trs\Core\Interfaces\IPackage;


class AggregatedCalculator implements ICalculator
{
    public function __construct(ICalculator $calculator, IAggregator $aggregator = null)
    {
        $this->calculator = $calculator;
        $this->aggregator = $aggregator;
    }

    public function calculateRatesFor(IPackage $package)
    {
        $rates = $this->calculator->calculateRatesFor($package);

        if (isset($this->aggregator)) {
            $rate = $this->aggregator->aggregateRates($rates);
            $rates = isset($rate) ? array($rate) : array();
        }

        return $rates;
    }

    public function multipleRatesExpected()
    {
        return !isset($this->aggregator) && $this->calculator->multipleRatesExpected();
    }

    private $calculator;
    private $aggregator;
}