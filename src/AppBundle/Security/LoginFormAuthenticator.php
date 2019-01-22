<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 17-Jan-19
 * Time: 6:49 PM
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;


    /**
     * LoginFormAuthenticator constructor.
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em, RouterInterface $router,
                                UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function getCredentials(Request $request)
    {

        $isLoginSubmit = $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');

        if (!$isLoginSubmit)
        {
            // skip authentication
            return;

        }

        $form = $this->formFactory->create('AppBundle\Form\LoginForm');
        $form->handleRequest($request);

        $data = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['_username']
        );

        return $data;




    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['_username'];
        return $this->em->getRepository('AppBundle:User')
            ->findOneBy(['email' => $username]);


    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];

        if ($this->userPasswordEncoder->isPasswordValid($user, $password))
        {
            return true;
        }

        return false;

    }

    protected function getLoginUrl()
    {

        return $this->router->generate('security_login');
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        $key = '_security.main.target_path';
        $redirectUrl = $request->getSession()->get($key);


        if(!empty($redirectUrl)) {
            return new RedirectResponse($redirectUrl);
        }

        else
        {
            return new RedirectResponse($this->router->generate('homepage'));

        }
//
//
//        dump($x);
////        die('lel');
//
//        if (!$x)
//        {
//            return new RedirectResponse($x);
//        }
//        else {
//        return new RedirectResponse($this->router->generate('homepage'));
//
//        }
    }



}