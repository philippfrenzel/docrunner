<?php

use yii\db\Schema;

class m140120_172336_approvalbytopurchaseorder extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_purchaseorder','approver_id','INTEGER DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_purchaseorder','approver_id');
	}
}
