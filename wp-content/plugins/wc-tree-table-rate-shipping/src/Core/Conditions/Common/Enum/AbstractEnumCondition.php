<?php
namespace Trs\Core\Conditions\Common\Enum;

use InvalidArgumentException;
use Trs\Common\ClassNameAware;
use Trs\Core\Interfaces\ICondition;


abstract class AbstractEnumCondition extends ClassNameAware implements ICondition
{
    public function __construct(array $other)
    {
        $this->other = $other;
    }

    protected $other;

    protected function intersect(array $value, array $other)
    {
        return count(array_intersect($this->normalize($value), $this->normalize($other)));
    }

    protected function normalize($list)
    {
        if (!is_array($list)) {
            throw new InvalidArgumentException(sprintf("Array expected, '%s' given.", gettype($list)));
        }

        return array_unique(array_values($list));
    }
}