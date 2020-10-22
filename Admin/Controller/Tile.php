<?php

namespace Inforge\GridShow\Admin\Controller;

use XF\Mvc\ParameterBag;

class Tile extends \XF\Admin\Controller\AbstractController
{
	public function actionIndex()
	{
		$repo = $this->getTileRepo();
		$viewParams = [
			'tiles' => $repo->getTiles()->fetch()
		];
		return $this->view('Inforge\GridShow:TileList', 'if_gs_tile_list', $viewParams);
	}

	protected function tileAddEdit(\Inforge\GridShow\Entity\Tile $tile)
	{
		$viewParams = [
			'tile' => $tile
		];
		return $this->view('Inforge\GridShow:Tile\Edit', 'if_gs_tile_edit', $viewParams);
	}

	public function actionAdd()
	{
		$tile = $this->em()->create('Inforge\GridShow:Tile');
		return $this->tileAddEdit($tile);
	}

	public function actionEdit(ParameterBag $params)
	{
		$tile = $this->assertTileExists($params->tile_id);
		return $this->tileAddEdit($tile);
	}

	public function actionDelete(ParameterBag $params)
	{
		$tile = $this->assertTileExists($params->tile_id);
		$plugin = $this->plugin('XF:Delete');
		return $plugin->actionDelete(
			$tile,
			$this->buildLink('if-gs-list/delete', $tile),
			$this->buildLink('if-gs-list/edit', $tile),
			$this->buildLink('if-gs-list'),
			$tile->title
		);
	}

	public function actionSave(ParameterBag $params)
	{
		$this->assertPostOnly();
		if ($params->tile_id)
			$tile = $this->assertTileExists($params->tile_id);
		else
			$tile = $this->em()->create('Inforge\GridShow:Tile');
		$this->tileSaveProcess($tile)->run();
		return $this->redirect($this->buildLink('if-gs-list') . $this->buildLinkHash($tile->tile_id));
	}

	public function actionToggle()
	{
		$plugin = $this->plugin('XF:Toggle');
		return $plugin->actionToggle('Inforge\GridShow:Tile');
	}

	protected function tileSaveProcess(\Inforge\GridShow\Entity\Tile $tile)
	{
		$form = $this->formAction();
		$input = $this->filter([
			'title' => 'str',
			'category' => 'str',
			'link' => 'str',
			'image_url' => 'str',
			'display_order' => 'uint',
			'active' => 'bool'
		]);
		$form->basicEntitySave($tile, $input);
		return $form;
	}

	protected function assertTileExists($id, $with = null, $phraseKey = null)
	{
		return $this->assertRecordExists('Inforge\GridShow:Tile', $id, $with, $phraseKey);
	}

	protected function getTileRepo()
	{
		return $this->repository('Inforge\GridShow:Tile');
	}
}
