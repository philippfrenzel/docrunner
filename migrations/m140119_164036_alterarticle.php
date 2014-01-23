<?php

use yii\db\Schema;

class m140119_164036_alterarticle extends \yii\db\Migration
{
	public function up()
	{
    $this->addColumn('tbl_article', 'countryCode','INTEGER');
    $this->addColumn('tbl_price','party_id','INTEGER DEFAULT NULL');

    //add the related fk's
    $this->addForeignKey('FK_article_country','tbl_article','countryCode','tbl_country','id');
	}

	public function down()
	{
    //drop the related fk's
    $this->dropForeignKey('FK_article_country','tbl_article');

		$this->dropColumn('tbl_article','countryCode');
    $this->dropColumn('tbl_price','party_id');
	}
}
