<?php
namespace EmmetBlue\Core;

use Closure;
use FileUpload\FileUpload;

class CustomFileNameGenerator implements \FileUpload\FileNameGenerator\FileNameGenerator
{
    protected $generator;

    /**
     * @param string|callable|Closure $nameGenerator
     */
    public function __construct($nameGenerator)
    {
        $this->generator = $nameGenerator;
    }

    public function getFileName($source_name, $type, $tmp_name, $index, $content_range, FileUpload $upload)
    {
        $sourceNameArray = explode(".", $source_name);
        $ext = $sourceNameArray[count($sourceNameArray) - 1];
        if (is_string($this->generator) && !is_callable($this->generator)) {
            return $this->generator.".".$ext;
        }

        return call_user_func_array(
            $this->generator,
            func_get_args()
        );
    }
}
