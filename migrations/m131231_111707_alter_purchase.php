<?php

use yii\db\Schema;

class m131231_111707_alter_purchase extends \yii\db\Migration
{
	public function up()
	{
    $this->dropForeignKey('FK_purchaseorder_party','tbl_purchaseorder');
    $this->dropColumn('tbl_purchaseorder','party_id');
    $this->addColumn('tbl_purchaseorder','contact_id','INTEGER UNSIGNED NOT NULL DEFAULT 1');
    $this->addForeignKey('FK_purchaseorder_contact','tbl_purchaseorder','contact_id','tbl_contact','id');
	}

	public function down()
	{
    $this->addColumn('tbl_purchaseorder','party_id','INTEGER UNSIGNED NOT NULL DEFAULT 1');
    $this->addForeignKey('FK_purchaseorder_party','tbl_purchaseorder','party_id','tbl_party','id');
    $this->dropForeignKey('FK_purchaseorder_contact','tbl_purchaseorder');
    $this->dropColumn('tbl_purchaseorder','contact_id');
	}
}
