<?php


class ClassAutoLoader
{

	private $dirs = array();

	public function __construct()
	{
		spl_autoload_register(array($this, 'loader'));
	}

	public function register()
	{
		$this->dirs = array(
			BASE_DIR . '/'
		);
	}

	public function loader($classname)
	{
		foreach ($this->dirs as $dir) {
			$file = "{$dir}{$classname}.php";
			$file = str_replace('\\', '/', $file);
			if (is_readable($file)) {
				require_once $file;
				return;
			}
		}
	}
}
