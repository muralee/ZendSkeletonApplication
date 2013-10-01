<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
		//add this to your class

 /*
//Setup the encryption class to use AES
$cipher = BlockCipher::factory('mcrypt',
    array('algorithm' => 'aes')
);
//Set your encryption key/salt
$cipher->setKey('this is the encryption key');
 
//The text to encrypt
$text = 'This is the message to encrypt';
 
//Encrypt the data
echo '<br>Encrypted ::: ' . $encrypted = $cipher->encrypt($text);
 
//Decrypt the data
echo '<br>Decrypted ::: ' . $text = $cipher->decrypt($encrypted);

exit;*/
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
		
		/*	$controller = $e->getTarget();
				if (something.....) {
					$controller->plugin('redirect')->toRoute('yourroute');
				}*/
				
		/*$e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_ROUTE,
            function($e) {
				$sm = $e->getApplication()->getServiceManager();

				$routeMatch = $e->getRouteMatch();
				echo '<br>1 '.$routeMatch->getMatchedRouteName();
				echo '<br>1 '.$routeMatch->getParam('lang');
				echo '<br>1 '.$routeMatch->getParam('action');
				echo '<br>1 '.$routeMatch->getParam('controller');
				
				$controller = 'User\Controller\UserController';
				
				$newRoute = new RouteMatch(array(),
					array(
						'controller' => $controller, 
						'action'     => 'add',
						'lang' => $routeMatch->getParam('lang')
					)
				);
				

				$e->setRouteMatch($newRoute);
				
				echo '<br>I am here';
            }
         );*/
		 
		$e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_DISPATCH,
            function($e) {
				$sm = $e->getApplication()->getServiceManager();
				$translator = $sm->get('translator');
		
				$routeMatch = $e->getRouteMatch();
				echo '<br>2 '.$routeMatch->getMatchedRouteName();
				echo '<br>2 '.$routeMatch->getParam('lang');
				echo '<br>2 '.$routeMatch->getParam('action');
				echo '<br>2 ID ::: '.$routeMatch->getParam('id');
				echo '<br>2 pageId ::: '.$routeMatch->getParam('pageId');
				$translator->setLocale($routeMatch->getParam('lang'));
                
				
            }
         );
		 
		
			
		
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
