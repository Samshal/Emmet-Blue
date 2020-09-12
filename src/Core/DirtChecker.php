<?php declare (strict_types=1);
/**
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * This file is part of the EmmetBlue project, please read the license document
 * available in the root level of the project
 */
namespace EmmetBlue\Core;

/**
 * Class DirtChecker
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * @since v0.0.1 14/12/2016
 */
class DirtChecker
{
    public $dirtFilterConditions = [">", "<", "="];

    public $workingValue;
    public $conditionValue;
    public $workingConditions = [];

    public function __construct(string $value, string $conditionValue, array $conditions = [])
    {
        $this->workingValue = $value;
        $this->conditionValue = $conditionValue;

        if (!empty($conditions)){
            foreach ($conditions as $value) {
                if (!in_array($value, $this->dirtFilterConditions)){
                    throw new \Exception("Invalid Dirt Filter Condition Provided: ".$value);
                }
            }
            $this->workingConditions = $conditions;
        }
        else {
            $this->workingConditions = $this->dirtFilterConditions;
        }
    }

    public function isDirty() : bool
    {
        $explodedString = explode(" ", $this->workingValue);
        foreach ($explodedString as $string){
            foreach ($this->workingConditions as $condition){
                $switchValue = false;
                switch ($condition) {
                    case '=':
                        $switchValue = strpos($string, $this->conditionValue) !== false;
                        break;
                    case '>':
                        $string = self::turnToNumber($string);
                        $_condition = self::turnToNumber($this->conditionValue);

                        $switchValue = $string > $_condition;
                        break;
                    case '<':
                        $string = self::turnToNumber($string);
                        $_condition = self::turnToNumber($this->conditionValue);

                        $switchValue = $string < $_condition;
                        break;
                }

                if (!$switchValue) {
                    return true;
                }
            }
        }

        return false;
    }

    private function turnToNumber(string $string) : float 
    {
        return (float) filter_var($string, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION | FILTER_FLAG_ALLOW_THOUSAND);
    }
}
