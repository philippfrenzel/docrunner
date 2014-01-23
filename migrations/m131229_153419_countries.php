<?php

use yii\db\Schema;

class m131229_153419_countries extends \yii\db\Migration
{
	public function up()
	{
    $this->createTable('tbl_country',array(
        'id'            => 'INTEGER PRIMARY KEY AUTO_INCREMENT',
        'country_code'  => 'VARCHAR(2)',
        'country_name'  => 'VARCHAR(100)',
    ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

    //add the related fk's
    $this->addForeignKey('FK_party_country','tbl_party','registrationCountryCode','tbl_country','id');
    $this->addForeignKey('FK_address_country','tbl_address','countryCode','tbl_country','id');
	}

	public function down()
	{
    $this->dropForeignKey('FK_party_country','tbl_party');
    $this->dropForeignKey('FK_address_country','tbl_address');
		
    $this->dropTable('tbl_country');
	}
}
