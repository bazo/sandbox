<?php

namespace Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;



/**
 * LoginForm
 *
 * @author Martin Bažík <martin@bazo.sk>
 */
class LoginForm extends Control
{

	/** @var User */
	private $user;
	public $onSuccess = [];



	public function __construct(User $user)
	{
		parent::__construct();
		$this->user = $user;
	}


	protected function createComponentForm()
	{
		$form = new Form;

		$form->addText('email', 'Email')
				->setRequired('Please fill in %label');

		$form->addPassword('password', 'Password')
				->setRequired('Please fill in %label');

		$form->addCheckbox('remember', 'Remember me on this computer');

		$form->addSubmit('btnSubmit', 'Sign in');

		$form->onSuccess[] = $this->formSuccess;

		return $form;
	}


	public function formSuccess(Form $form)
	{
		$values = $form->getValues();

		try {
			if ($values->remember) {
				$this->user->setExpiration('+ 14 days', FALSE);
			} else {
				$this->user->setExpiration('+ 60 minutes', TRUE);
			}
			$this->user->login($values->username, $values->password);
			foreach ($this->onSuccess as $callback) {
				$callback($form);
			}
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function render()
	{
		$this->template->setFile(__DIR__ . '/template.latte');

		$this->template->render();
	}


}
