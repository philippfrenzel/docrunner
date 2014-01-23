<?php

use yii\db\Schema;

class m140112_194653_workflowfields extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_purchaseorder','status','VARCHAR(200) DEFAULT "created" NOT NULL');
    $this->addColumn('tbl_purchaseordergroup','status','VARCHAR(200) DEFAULT "created" NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_purchaseorder','status');
    $this->dropColumn('tbl_purchaseordergroup','status');
	}
}
