<?php

namespace App;

/**
 * Secured presenter
 *
 * @author Martin Bažík <martin@bazo.sk>
 */
abstract class SecuredPresenter extends BasePresenter
{

	protected function startup()
	{
		parent::startup();
		if (!$this->user->isLoggedIn()) {
			$this->redirect('sign:in');
		}
	}


	protected function beforeRender()
	{
		parent::beforeRender();
	}


	public function handleLogout()
	{
		$this->user->logout();
		$this->redirect('sign:in');
	}


}
