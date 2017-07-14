<?php
namespace Craft;

class BetterPasswordsRecord extends BaseRecord
{
	public function getTableName()
	{
		return 'betterpasswords';
	}

	// public function defineIndexes()
	// {
	// 	return [
	// 		[
	// 			'columns' => ['password']
	// 		]
	// 	];
	// }

	protected function defineAttributes()
	{
		return [
			'password' => [AttributeType::String, 'column' => ColumnType::Binary]
		];
	}
}