<?php

namespace Inforge\GridShow\Widget;

class GridShow extends \XF\Widget\AbstractWidget
{
	public function render()
	{
		$repo = $this->getTileRepo();
		$tiles = $repo->getActiveTiles()->fetch();
		$viewParams = [
			'tiles' => $tiles
		];
		return $this->renderer('if_gs_gridshow_widget', $viewParams);
	}

	protected function getTileRepo()
	{
		return $this->repository('Inforge\GridShow:Tile');
	}
}
