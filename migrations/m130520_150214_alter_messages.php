<?php

class m130520_150214_alter_messages extends \yii\db\Migration
{
	public function up()
	{
		$this->addColumn('tbl_messages','module','VARCHAR(50) DEFAULT "MESSAGES"');
	}

	public function down()
	{
		$this->dropColumn('tbl_messages','module');
	}
}
