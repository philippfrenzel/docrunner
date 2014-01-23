<?php

use yii\db\Schema;

class m140108_170923_reportsto extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_contact','parent_mail','VARCHAR(200) DEFAULT NULL');
    $this->addColumn('tbl_contact','backup_mail','VARCHAR(200) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_contact','parent_mail');
    $this->dropColumn('tbl_contact','backup_mail');
	}
}
