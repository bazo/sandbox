<?php

namespace Services;

/**
 * Description of PathsProvider
 *
 * @author Martin Bažík <martin@bazo.sk>
 */
class PathsProvider
{
	private $paths = [];

	public function addPath($name, $path)
	{
		if(!file_exists($path)) {
			throw new \InvalidArgumentException(sprintf('Path "%s" doesn\'t exist.', $path));
		}

		$this->paths[$name] = $path;
		return $this;
	}

	public function getPath($name)
	{
		return $this->paths[$name];
	}

}
