<?php
namespace Drupal\raychat\Controller;

use Drupal\Core\Controller\ControllerBase;

class RaychatController extends ControllerBase{
	public function content(){
		return array(
			'#type' => 'markup',
			'#markup' => $this->t('Raychat!'),
		);
	}
}