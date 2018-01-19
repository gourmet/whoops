<?php

namespace Gourmet\Whoops\Error;

use Cake\Core\Configure;
use Cake\Error\ErrorHandler;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class WhoopsHandler extends ErrorHandler
{

	/**
	 * @var \Whoops\Run
	 */
	protected $_whoops;

	/**
	 * @return \Whoops\Run
	 */
	public function getWhoopsInstance()
	{
		if (empty($this->_whoops)) {
			$this->_whoops = new Run();
		}
		return $this->_whoops;
	}

	/**
	 * @param array $error
	 * @param bool $debug
	 * @return void
	 */
	protected function _displayError($error, $debug)
	{
		if (!$debug) {
			parent::_displayError($error, $debug);
			return;
		}

		$whoops = $this->getWhoopsInstance();
		$whoops->pushHandler($this->getHandler());
		$whoops->handleError($error['level'], $error['description'], $error['file'], $error['line']);
	}

	/**
	 * @param \Exception $exception
	 * @return void
	 */
	protected function _displayException($exception)
	{
		if (!Configure::read('debug')) {
			parent::_displayException($exception);
		}

		$whoops = $this->getWhoopsInstance();
		$whoops->pushHandler($this->getHandler());
		$whoops->handleException($exception);
	}

	/**
	 * @return \Whoops\Handler\PrettyPageHandler
	 */
	protected function getHandler()
	{
		$handler = new PrettyPageHandler();
		if (!Configure::read('Whoops.editor')) {
			return $handler;
		}

		$handler->setEditor(function ($file, $line) {
			$userPath = Configure::read('Whoops.userBasePath');
			$serverPath = Configure::read('Whoops.serverBasePath');
			if ($userPath && $serverPath) {
				$file = str_replace($serverPath, $userPath, $file);
			}
			$pattern = Configure::read('Whoops.ideLinkPattern') ?: 'phpstorm://open?file=%s&line=%s';
			$url = sprintf($pattern, $file, $line);
			if (!Configure::read('Whoops.asAjax', false)) {
				return $url;
			}
			return [
				'url' => $url,
				'ajax' => true,
			];
		});

		return $handler;
	}
}
