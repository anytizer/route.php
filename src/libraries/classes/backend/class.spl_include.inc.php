<?php
namespace backend;

class spl_include
{
    private $path;
    public function __construct(string $path)
    {
        $this->path = realpath($path);
    }

    public function namespaced_inc_dot(string $class)
    {
        // for name-space based class access
        $chunks = explode("\\", $class);
        $class = array_pop($chunks); // from the last word
        $namespace = implode("/", $chunks);
        if(!$namespace) $namespace = ".";

        $path = $this->path;
        {
            $file = "{$path}/{$namespace}/class.{$class}.inc.php";
            if(is_file($file))
            {
                require_once($file);
            }
        }
    }
	
	public function psr0(string $class)
    {
        // for name-space based class access
        $chunks = explode("\\", $class);
        $class = array_pop($chunks); // from the last word
        $namespace = implode("/", $chunks);
        if(!$namespace) $namespace = ".";

        $path = $this->path;
        {
            $file = "{$path}/{$namespace}/{$class}.php";
            if(is_file($file))
            {
                require_once($file);
            }
        }
    }
}
