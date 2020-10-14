<?php

class Migration_Rss_Settings extends CI_Migration {

    public function up() {
        $fields = array(
            'rss_id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true),
            'newspaper_region' => array('type' => 'VARCHAR', 'constraint'=>10),
            'newspaper_position'=>array('type'=>'INT', 'constraint'=>3), 
            'newspaper_name' => array('type' => 'VARCHAR', 'constraint'=>50),
            'newspager_logo' => array('type' => 'VARCHAR', 'constraint'=>50,'null'=>true),
            'newspaper_url' => array('type' => 'VARCHAR', 'constraint'=>255,'null'=>true),
            'newspaper_rss_url' => array('type' => 'VARCHAR', 'constraint'=>255),
            'config_item' => array('type' => 'VARCHAR', 'constraint'=>20),
            'config_title' => array('type' => 'VARCHAR', 'constraint'=>20),
            'config_link' => array('type' => 'VARCHAR', 'constraint'=>20),
            'config_image' => array('type' => 'VARCHAR', 'constraint'=>20,'null'=>true),
            'config_description' => array('type' => 'VARCHAR', 'constraint'=>20),
            'config_image_url' => array('type' => 'VARCHAR', 'constraint'=>20,'null'=>true), 
            'created_at' => array('type' => 'DATETIME'),
            'updated_at' => array('type' => 'DATETIME','null'=>true),
            'status' => array('type' => 'TINYINT', 'constraint' =>1,'default' => 1)
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('rss_id', true);
        $this->dbforge->create_table('rss_settings'); 

        $sql = "INSERT INTO `rss_settings` (`rss_id`, `newspaper_region`, `newspaper_position`, `newspaper_name`, `newspager_logo`, `newspaper_url`, `newspaper_rss_url`, `config_item`, `config_title`, `config_link`, `config_image`, `config_image_url`, `config_description`,`created_at`,`updated_at`, `status`) VALUES (1, '*', 2, 'MSN news', 'public/img/newspaper/msn.jpg', 'http://msn.com/', 'http://rss.msn.com/', 'item', 'title', 'link', 'image', 'http://img-s-msn-com.akamaized.net/tenant/amp/entityid/', 'description','2016-05-28 00:00:00','2016-05-28 00:00:00', 1),(2, '*', 3, 'Yahoo news', 'public/img/newspaper/yahoo.jpg', 'http://news.yahoo.com/', 'http://news.yahoo.com/rss/', 'item', 'title', 'link', 'image', 'http://l.yimg.com/bt/api/res/1.2/WAORpbLY_slfZJTfS1Wd4A--/YXBwaWQ9eW5ld3NfbGVnbztmaT1maWxsO2g9ODY7cT03NTt3PTEzMA--/http://media.zenfs.com/en/homerun/feed_manager_auto_publish_494/', 'description','2016-05-28 00:00:00','2016-05-28 00:00:00', 1),(3, '*', 1, 'Al Jazeera', 'public/img/newspaper/al-jazeera.png', 'http://www.aljazeera.com/', 'http://www.aljazeera.com/xml/rss/all.xml', 'item', 'title', 'link', 'image', '', 'description','2016-05-28 00:00:00','2016-05-28 00:00:00', 1);";
        $this->db->query($sql);

    }

    public function down() {
        $this->dbforge->drop_table('rss_settings');
    }

}
 
