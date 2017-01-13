<?php
namespace Trs\Core\Conditions\Common;

use Trs\Core\Interfaces\ICondition;


class StringPatternCondition implements ICondition
{
    public function __construct($pattern)
    {
        $this->pattern = '/^'.str_replace('\\*', '.*', preg_quote($pattern, '/')).'$/i';
    }

    public function isSatisfiedBy($value)
    {
        return (bool)preg_match($this->pattern, $value);
    }

    private $pattern;
}