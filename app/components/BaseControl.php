<?php

namespace Components;

use Nette\Application\UI\Control;
use Components\Factories\FormFactory;
use Nette\Localization\ITranslator;



/**
 * @author Martin Bažík <martin@bazo.sk>
 */
abstract class BaseControl extends Control
{

	/** @var ITranslator */
	private $translator;

	/** @var FormFactory */
	protected $formFactory;

	/** @var callable[] */
	public $onSuccess = [];



	public function inject(ITranslator $translator, FormFactory $formFactory)
	{
		$this->translator = $translator;
		$this->formFactory = $formFactory;
	}


	protected function createTemplate($class = NULL)
	{
		$template = parent::createTemplate($class);
		$template->setTranslator($this->translator);

		return $template;
	}


	protected function fireSuccessCallbacks($form)
	{
		foreach ($this->onSuccess as $callback) {
			$callback($form);
		}
	}


}
