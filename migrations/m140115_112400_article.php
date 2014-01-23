<?php

use yii\db\Schema;

class m140115_112400_article extends \yii\db\Migration
{
	public function up()
	{
    $this->createTable('tbl_article',array(
        'id'             => 'INTEGER PRIMARY KEY AUTO_INCREMENT',
        'article'        => 'VARCHAR(200) DEFAULT "Product" NOT NULL',
        'article_number' => 'VARCHAR(200) DEFAULT "0000" NOT NULL',
        'status'         => 'VARCHAR(255) NOT NULL DEFAULT "created"',
        'system_key'     => 'VARCHAR(100) NOT NULL',
        'system_name'    => 'VARCHAR(100) NOT NULL',
        'system_upate'   => 'INTEGER DEFAULT NULL',
        'creator_id'     => 'INTEGER NOT NULL',
        'time_deleted'   => 'INTEGER DEFAULT NULL',
        'time_create'    => 'INTEGER DEFAULT NULL'
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

    $this->createTable('tbl_price',array(
        'id'             => 'INTEGER PRIMARY KEY AUTO_INCREMENT',
        'article_id'     => 'INTEGER NOT NULL',
        'price'          => 'FLOAT DEFAULT "0.00"',
        'status'         => 'VARCHAR(255) NOT NULL DEFAULT "created"',
        'creator_id'     => 'INTEGER NOT NULL',
        'time_deleted'   => 'INTEGER DEFAULT NULL',
        'time_create'    => 'INTEGER DEFAULT NULL'
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

    //add the related fk's
    $this->addForeignKey('FK_price_article','tbl_price','article_id','tbl_article','id');

	}

	public function down()
	{
    $this->dropForeignKey('FK_price_article','tbl_price');
		$this->dropTable('tbl_article');
    $this->dropTable('tbl_price');
	}
}
