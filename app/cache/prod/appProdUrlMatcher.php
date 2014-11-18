<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // _user
        if ($pathinfo === '/user') {
            return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::indexAction',  '_route' => '_user',);
        }

        // _login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::loginAction',  '_route' => '_login',);
        }

        // _login_check
        if ($pathinfo === '/user_check') {
            return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::securityCheckAction',  '_route' => '_login_check',);
        }

        // _logout
        if ($pathinfo === '/logout') {
            return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::logoutAction',  '_route' => '_logout',);
        }

        if (0 === strpos($pathinfo, '/signup')) {
            // _signup
            if ($pathinfo === '/signup') {
                return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::signUpAction',  '_route' => '_signup',);
            }

            // _create
            if ($pathinfo === '/signup_create') {
                return array (  '_controller' => 'Bo\\AnnonceBundle\\Controller\\DefaultController::createUserAction',  '_route' => '_create',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
