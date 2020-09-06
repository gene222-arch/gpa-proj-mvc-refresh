<?php 

use app\core\Application;
/**
 * 
 */
class m001_contact_table
{
	
	
	public function up() {

		Application::$app->db->exec(
			"CREATE TABLE IF NOT EXISTS contact (
				contact_id INT(11) AUTO_INCREMENT PRIMARY KEY,
				email VARCHAR(255) not null,
				recipient VARCHAR(255) not null,
				message TEXT not null,
				created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
				ENGINE=INNODB;"
		);
	}


	public function down() {

		Application::$app->db->exec("DROP TABLE IF EXISTS contact");
	}


}





 ?>