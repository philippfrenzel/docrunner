<?php

use yii\db\Schema;

class m140102_173240_second_pochange extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_purchaseorderline','order_uom','INTEGER UNSIGNED NOT NULL DEFAULT 1');
    $this->addColumn('tbl_purchaseorderline','order_currency','VARCHAR(3) DEFAULT "EUR"');
	}

	public function down()
	{
		$this->dropColumn('tbl_purchaseorderline','order_uom');
    $this->dropColumn('tbl_purchaseorderline','order_currency');
	}
}
