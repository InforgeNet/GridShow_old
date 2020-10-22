<?php

namespace Inforge\GridShow\XF\Admin\Controller;

class Asset extends XFCP_Asset
{
	protected function getAssetPermissionMap(): array
	{
		$map = parent::getAssetPermissionMap();
		$map['gridshow_images'] = 'ifGsTiles';
		return $map;
	}
}
