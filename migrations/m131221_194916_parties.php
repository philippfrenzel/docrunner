<?php

use yii\db\Schema;

class m131221_194916_parties extends \yii\db\Migration
{
	public function up()
	{
        $this->createTable('tbl_party',array(
            'id'                      => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'organisationName'        => 'VARCHAR(255) NOT NULL',
            'partyNote'               => 'MEDIUMTEXT',
            'taxNumber'               => 'VARCHAR(100) NOT NULL',
            'registrationNumber'      => 'VARCHAR(100)',
            'registrationCountryCode' => 'INTEGER',
            'party_type'              => 'INTEGER NOT NULL DEFAULT 1', //this will hold the static types!
            'system_key'              => 'VARCHAR(100) NOT NULL',
            'system_name'             => 'VARCHAR(100) NOT NULL',
            'system_upate'            => 'INTEGER DEFAULT NULL',
            'creator_id'              => 'INTEGER NOT NULL',
            'time_deleted'            => 'INTEGER DEFAULT NULL',
            'time_create'             => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

        $this->createTable('tbl_contact',array(
            'id'           => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'party_id'     => 'INTEGER UNSIGNED NOT NULL',
            'contactName'  => 'VARCHAR(255) NOT NULL',
            'department'   => 'VARCHAR(100)',
            'email'        => 'VARCHAR(200)',
            'phone'        => 'VARCHAR(100)',
            'mobile'       => 'VARCHAR(100)',
            'fax'          => 'VARCHAR(100)',
            'user_id'      => 'INTEGER DEFAULT NULL', //to have a relation to users table
            'system_key'   => 'VARCHAR(100)',
            'system_name'  => 'VARCHAR(100)',
            'system_upate' => 'INTEGER DEFAULT NULL',
            'creator_id'   => 'INTEGER NOT NULL',
            'time_deleted' => 'INTEGER DEFAULT NULL',
            'time_create'  => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

        //add the related fk's
        $this->addForeignKey('FK_contact_party','tbl_contact','party_id','tbl_party','id');

        $this->createTable('tbl_address',array(
            'id'                => 'INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'party_id'          => 'INTEGER UNSIGNED NOT NULL',
            'postCode'          => 'VARCHAR(100)',
            'streetDescription' => 'VARCHAR(200)',
            'addressLine'       => 'VARCHAR(200)',
            'postBox'           => 'VARCHAR(100)',
            'cityName'          => 'VARCHAR(100)',
            'region'            => 'VARCHAR(100)', //can hold the nuts definition if needed
            'countryCode'       => 'INTEGER',
            'system_key'        => 'VARCHAR(100)',
            'system_name'       => 'VARCHAR(100)',
            'system_upate'      => 'INTEGER DEFAULT NULL',
            'creator_id'        => 'INTEGER NOT NULL',
            'time_deleted'      => 'INTEGER DEFAULT NULL',
            'time_create'       => 'INTEGER',
        ),'CHARACTER SET utf8 COLLATE utf8_bin ENGINE = InnoDB;');

        //add the related fk's
        $this->addForeignKey('FK_address_party','tbl_address','party_id','tbl_party','id');
	}

	public function down()
	{
        $this->dropForeignKey('FK_address_party','tbl_address');
        $this->dropForeignKey('FK_contact_party','tbl_contact');        
		
        $this->dropTable('tbl_party');
        $this->dropTable('tbl_contact');
        $this->dropTable('tbl_address');
	}
}
