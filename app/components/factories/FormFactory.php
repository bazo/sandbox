<?php

namespace Components\Factories;

use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class FormFactory
{

	/** @var ITranslator */
	private $translator;



	public function __construct(ITranslator $translator)
	{
		$this->translator = $translator;
	}


	public function create()
	{
		$form = new Form;

		$form->setTranslator($this->translator);
		return $form;
	}


}
