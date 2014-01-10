<?php

namespace App;

use Nette;
use Components\Factories\ILoginFormFactory;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class SignPresenter extends BasePresenter
{

	/** @var ILoginFormFactory */
	private $loginFormFactory;

	public function __construct(ILoginFormFactory $loginFormFactory)
	{
		$this->loginFormFactory = $loginFormFactory;
	}



	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->loginFormFactory->create();

		$form->onSuccess[] = callback($this, 'signInFormSucceeded');
		return $form;
	}


	public function signInFormSucceeded(Form $form)
	{
		$this->redirect('homepage:');
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}


}
