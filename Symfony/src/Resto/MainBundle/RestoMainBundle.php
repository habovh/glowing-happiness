<?php

namespace Resto\MainBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RestoMainBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
