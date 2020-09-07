<?php 

namespace app\core\models;

use app\core\db\DatabaseORM;

abstract class UserModel extends DatabaseORM
{

	public abstract function display_user(): string;
	
}