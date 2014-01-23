<?php

use yii\db\Schema;

class m131231_093649_alterorderline extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_purchaseorderline','party_id','INTEGER DEFAULT NULL');
    $this->addColumn('tbl_purchaseorderline','date_delivery','DATE');
    $this->addColumn('tbl_purchaseorderline','article','VARCHAR(200) DEFAULT "Product" NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('tbl_purchaseorderline','party_id');
    $this->dropColumn('tbl_purchaseorderline','date_delivery');
    $this->dropColumn('tbl_purchaseorderline','article');
	}
}
