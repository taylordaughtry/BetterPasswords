<?php
namespace Craft;

class BetterPasswordsService extends BaseApplicationComponent
{
	public function validatePassword($password)
	{
		if (strlen($password) < 10) {
			return 'Try a password with at least 10 characters.';
		}

		if ($this->findEntropy($password) < 2.5) {
			return 'Try a more unique password.';
		}

		if ($this->isCommonPassword($password)) {
			return 'Try a more unique password.';
		}

		return true;
	}

	public function findEntropy($string)
	{
		$entropy = 0;

		$totalLength = strlen($string);

		foreach (count_chars($string, 1) as $occurence) {
			$percentage = $occurence / $totalLength;

			$entropy -= $percentage * log($percentage) / log(2);
		}

		return $entropy;
	}

	public function isCommonPassword($string)
	{
		$result = craft()->db->createCommand()
			->select('password')
			->from('betterpasswords')
			->where([
				'LIKE',
				'password',
				'%' . $string . '%'
			])->execute();

		return $result > 0;
	}
}