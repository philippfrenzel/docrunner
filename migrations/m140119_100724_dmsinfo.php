<?php

use yii\db\Schema;

class m140119_100724_dmsinfo extends \yii\db\Migration
{
	public function up()
	{
    $this->createTable('tbl_dmsys',array(
        'id'             => 'INTEGER PRIMARY KEY AUTO_INCREMENT',
        'parent'         => 'INTEGER DEFAULT NULL',
        'owner_id'       => 'INTEGER NOT NULL',
        'source_path'    => 'VARCHAR (255) DEFAULT "C:"',
        'source_security'=> 'INTEGER DEFAULT 0',
        'used_space'     => 'VARCHAR(200) DEFAULT "0Kb"',
        'time_expired'   => 'INTEGER DEFAULT NULL',
        'status'         => 'VARCHAR(200) DEFAULT "created" NOT NULL',        
        'dms_module'     => 'INTEGER NOT NULL', //integer based module id, defined within dms model
        'dms_id'         => 'INTEGER NOT NULL', //integer id of the referenced module record
        'creator_id'     => 'INTEGER NOT NULL',
        'time_deleted'   => 'INTEGER DEFAULT NULL',
        'time_create'    => 'INTEGER DEFAULT NULL'
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
	}

	public function down()
	{
		$this->dropTable('tbl_dmsys');
	}
}
