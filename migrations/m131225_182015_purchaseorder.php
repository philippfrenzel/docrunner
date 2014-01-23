<?php

use yii\db\Schema;

class m131225_182015_purchaseorder extends \yii\db\Migration
{
	public function up()
	{
      $this->createTable('tbl_purchaseorder',array(
            'id'                      => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'party_id'                => 'INTEGER UNSIGNED NOT NULL',
            'order_number'  => 'VARCHAR(200)',          
            'creator_id'              => 'INTEGER NOT NULL',
            'time_deleted'            => 'INTEGER DEFAULT NULL',
            'time_create'             => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');
      //add the related fk's
      $this->addForeignKey('FK_purchaseorder_party','tbl_purchaseorder','party_id','tbl_party','id');

      $this->createTable('tbl_purchaseordergroup',array(
            'id'                      => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'contact_id'              => 'INTEGER UNSIGNED NOT NULL',            
            'purchaseorder_id'        => 'INTEGER UNSIGNED NOT NULL',            
            'creator_id'              => 'INTEGER NOT NULL',
            'time_deleted'            => 'INTEGER DEFAULT NULL',
            'time_create'             => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

      //add the related fk's
      $this->addForeignKey('FK_purchaseordergroup_purchaseorder','tbl_purchaseordergroup','purchaseorder_id','tbl_purchaseorder','id');
      $this->addForeignKey('FK_purchaseordergroup_contact','tbl_purchaseordergroup','contact_id','tbl_contact','id');

      $this->createTable('tbl_purchaseorderline',array(
            'id'                    => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',            
            'purchaseordergroup_id' => 'INTEGER UNSIGNED NOT NULL',
            'order_amount'          => 'FLOAT DEFAULT "0.00"',
            'order_price'           => 'FLOAT DEFAULT "1.00"',
            'article_id'            => 'INTEGER UNSIGNED DEFAULT NULL',
            'status'                => 'VARCHAR(255) NOT NULL DEFAULT "created"',
            'creator_id'            => 'INTEGER NOT NULL',
            'time_deleted'          => 'INTEGER DEFAULT NULL',
            'time_create'           => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

      //add the related fk's
      $this->addForeignKey('FK_purchaseorderline_purchaseordergroup','tbl_purchaseorderline','purchaseordergroup_id','tbl_purchaseordergroup','id');
	}

	public function down()
	{
    //first drop fk's
    $this->dropForeignKey('FK_purchaseordergroup_purchaseorder','tbl_purchaseordergroup');
    $this->dropForeignKey('FK_purchaseorderline_purchaseordergroup','tbl_purchaseorderline');
    $this->dropForeignKey('FK_purchaseorder_party','tbl_purchaseorder');
    $this->dropForeignKey('FK_purchaseordergroup_contact','tbl_purchaseordergroup');

    //and then drop tables
    $this->dropTable('tbl_purchaseorderline');
    $this->dropTable('tbl_purchaseordergroup');
    $this->dropTable('tbl_purchaseorder');
	}
}
