<?php 

use app\core\Application;
/**
 * 
 */
class m004_add_contact_id_in_users
{
	
	
	public function up() {

		Application::$app->db->exec("ALTER TABLE `users` ADD contact_id INT(11) NOT NULL UNIQUE");
	}


	public function down() {

		Application::$app->db->exec("ALTER TABLE `users` DROP INDEX contact_id");
	}


}





 ?>