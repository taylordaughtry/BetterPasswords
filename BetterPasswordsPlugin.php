<?php
namespace Craft;

class BetterPasswordsPlugin extends BasePlugin
{
	public $name = 'Better Passwords';
	public $description = 'Enforce better password defaults for Craft users.';
	public $developer = 'Taylor Daughtry';
	public $developerUrl = 'https://taylordaughtry.com';
	public $version = '1.0.0';
	public $schemaVersion = '1.0.0';

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getDeveloper()
	{
		return $this->developer;
	}

	public function getDeveloperUrl()
	{
		return $this->developerUrl;
	}

	public function getVersion()
	{
		return $this->version;
	}

	public function getschemaVersion()
	{
		return $this->schemaVersion;
	}

	public function defineSettings()
	{
		return [];
	}

	public function init()
	{
		craft()->on('users.beforeSetPassword', [$this, 'enforceDefaults']);

		parent::init();
	}

	public function onAfterInstall()
	{
		$passwords = file(CRAFT_PLUGINS_PATH . 'betterpasswords/media/passwords.csv', FILE_IGNORE_NEW_LINES);

		foreach ($passwords as &$row) {
			$row = explode(',', $row);
		}

		craft()->db->createCommand()->insertAll('betterpasswords', ['password'], $passwords);

		$settings = $this->getSettings();

		craft()->plugins->savePluginSettings($this, [
			'passwordsPopulated' => true
		]);
	}

	protected function enforceDefaults(Event $e)
	{
		$result = craft()->betterPasswords->validatePassword($e->params['password']);

		if (! is_bool($result)) {
			$e->performAction = false;

			$e->params['user']->addError('newPassword', Craft::t($result));
		}
	}
}