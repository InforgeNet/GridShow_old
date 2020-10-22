<?php

namespace Inforge\GridShow;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installStep1()
	{
		$this->schemaManager()->createTable('xf_if_gs_tiles', function (Create $table)
		{
			$table->addColumn('tile_id', 'int')->autoIncrement();
			$table->addColumn('title', 'varchar', 200);
			$table->addColumn('category', 'varchar', 25)->setDefault('');
			$table->addColumn('link', 'varchar', 200);
			$table->addColumn('image_url', 'varchar', 200);
			$table->addColumn('display_order', 'int')->setDefault(0);
			$table->addColumn('active', 'tinyint')->setDefault(1);
			$table->addPrimaryKey('tile_id');
		});
	}

	public function installStep2()
	{
		$this->createWidget('if_gs_home_gridshow', 'if_gs_widget', [
			'positions' => [ 'forum_list_above_nodes' => 5 ],
			'display_condition' => '$xf.visitor->hasPermission("ifgs", "view")'
		], '[Inforge] GridShow Widget');
	}

	public function installStep3()
	{
		$this->applyGlobalPermission('ifgs', 'view');
	}

	public function uninstallStep1()
	{
		$this->deleteWidget('if_gs_home_gridshow');
	}

	public function uninstallStep2()
	{
		$this->schemaManager()->dropTable('xf_if_gs_tiles');
	}
}
