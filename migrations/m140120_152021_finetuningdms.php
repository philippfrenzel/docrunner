<?php

use yii\db\Schema;

class m140120_152021_finetuningdms extends \yii\db\Migration
{
	public function up()
	{
      $this->addColumn('tbl_dmsys','filename','VARCHAR(255) DEFAULT "tmp.txt" NOT NULL');
      $this->addColumn('tbl_dmsys','filetype','VARCHAR(30) DEFAULT "image/png"');
	}

	public function down()
	{
		$this->dropColumn('tbl_dmsys','filename');
    $this->dropColumn('tbl_dmsys','filetype');
	}
}
