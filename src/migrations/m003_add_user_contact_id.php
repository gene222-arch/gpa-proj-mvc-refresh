<?php 

use app\core\Application;
/**
 * 
 */
class m003_add_user_contact_id
{
	
	
	public function up() {

		Application::$app->db->exec("ALTER TABLE `contact` ADD user_contact_id INT(11) NOT NULL AFTER `contact_id`");
	}


	public function down() {

		Application::$app->db->exec("ALTER TABLE `contact` DROP COLUMN user_contact_id");
	}


}





 ?>