<?php

namespace App\Controller;

use App\Entity\UserCliente;
use App\Repository\UserClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityClienteController extends AbstractController
{
    #[Route(path: '/client/auth/login', name: 'app_login_client')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('securitycliente/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/client/auth/login_check', name: 'app_login_client_check')]
    public function logincheck(Security $security, AuthenticationUtils $authenticationUtils, Request $request, UserClienteRepository $userClienteRepository): Response
    {


        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('securitycliente/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);

        /* $user = new UserCliente();
        $data = json_decode($request->getContent(), true);

        $userna = $request->getPayload()->get('_username');
        $pass = $request->getPayload()->get('_password');
        $user->setUsername($userna);
        $user->setPassword($pass);
        $userbd = $userClienteRepository->validarCredenciales($userna, $pass);
        $lastUsername = $authenticationUtils->getLastUsername();
        if ($userbd) {
            $security->login($user, 'form_login', 'cliente');

            $token = new UsernamePasswordToken($user, null, 'app_user_client_provider', $user->getRoles());

            // Almacenar el token en la sesión
            $redirectResponse = $security->login($user);
            return $redirectResponse;
            //return $this->redirectToRoute('app_cliente_dashboard');

        } else {
            return $this->render('securitycliente/login.html.twig', [
                'error' => ["message" => 'USUARIO O CONTRASENA INVALIDA'],
                'last_username' => $lastUsername,

            ]);
        } */








        // use the redirection logic applied to regular login
        /* $redirectResponse =  $security->login($user, 'form_login', 'cliente');
        return $redirectResponse; */
    }

    #[Route(path: '/client/logout', name: 'app_logout_client')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
