<?php

namespace Inforge\GridShow\Repository;

class Tile extends \XF\Mvc\Entity\Repository
{
	public function getActiveTiles()
	{
		return $this->finder('Inforge\GridShow:Tile')
			->where('active', true)->order('display_order')->limit(9);
	}

	public function getTiles()
	{
		return $this->finder('Inforge\GridShow:Tile')->order('display_order');
	}
}
