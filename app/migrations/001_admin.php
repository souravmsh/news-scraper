<?php

class Migration_Admin extends CI_Migration {

    public function up() {
        $fields = array(
            'user_id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'fullname' => array('type' => 'VARCHAR', 'constraint' => 50),
            'username' => array('type' => 'VARCHAR', 'constraint' => 50),
            'email' => array('type' => 'VARCHAR', 'constraint' => 100),
            'password' => array('type' => 'VARCHAR', 'constraint' => 32),         
            'upload_id'      => array('type' => 'INT', 'constraint' => 11,'null'=>true),       
            'user_role'  => array('type' => 'TINYINT', 'constraint' => 1),   
            'ip_address' => array('type' => 'VARCHAR', 'constraint' => 20),   
            'created_at' => array('type' => 'DATETIME'),
            'updated_at' => array('type' => 'DATETIME','null'=>true),
            'status' => array('type' => 'TINYINT', 'constraint' =>1,'default' => 1)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('admin');

        $sql = "INSERT INTO `admin` (`user_id`, `fullname`, `username`, `email`, `password`, `upload_id`, `user_role`, `ip_address`, `created_at`, `updated_at`, `status`) VALUES (NULL, 'Super Admin', 'admin', 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '9', '192.168.0.1', '2016-06-16 12:00:00', '2016-06-16', '1');";
        $this->db->query($sql);


    }

    public function down() {
        $this->dbforge->drop_table('admin');
    }

}
 