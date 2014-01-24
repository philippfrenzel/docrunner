<?php

use yii\db\Schema;

/**
 * Will create the databasetable that is needed for an incoming paper
 * later we will assign 
 * comments
 * and tags
 * and attachements
 * and workflow informations
 *
 * The party_id is added as a reference to the "supplier of this document"
 */

class m140124_091629_dmspaper extends \yii\db\Migration
{
	public function up()
	{
    $this->createTable('tbl_dmpaper',array(
        'id'             => 'INTEGER PRIMARY KEY AUTO_INCREMENT',
        'party_id'       => 'INTEGER UNSIGNED DEFAULT NULL',
        'description'    => 'MEDIUMTEXT',
        'name'           => 'VARCHAR(255)',
        'status'         => 'VARCHAR(255) NOT NULL DEFAULT "created"',
        'creator_id'     => 'INTEGER NOT NULL',
        'time_deleted'   => 'INTEGER DEFAULT NULL',
        'time_create'    => 'INTEGER DEFAULT NULL'
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

    //add the related fk's
    $this->addForeignKey('FK_dmpaper_party','tbl_dmpaper','party_id','tbl_party','id');
	}

	public function down()
	{
		$this->dropForeignKey('FK_dmpaper_party','tbl_dmpaper');

    $this->dropTable('tbl_dmpaper');
	}
}
