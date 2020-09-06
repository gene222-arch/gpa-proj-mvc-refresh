<?php  

use app\core\Application;

/**
 * 
 */
class m002_users_table
{
	
	public function up() {

		Application::$app->db->exec("
			CREATE TABLE IF NOT EXISTS
				users (
						user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
						username VARCHAR(255) NOT NULL,
						password VARCHAR(255) NOT NULL
			)ENGINE=INNODB;");
	}


	public function down() {

		Application::$app->db->exec("DROP TABLE IF EXISTS `users`");
	}


}