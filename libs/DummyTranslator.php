<?php

namespace Services;

use Nette\Localization\ITranslator;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class DummyTranslator implements ITranslator
{

	public function translate($message, $count = NULL)
	{
		return $message;
	}


}
