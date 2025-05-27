<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony gère cette méthode automatiquement
    }

    #[Route('/account', name: 'api_account_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], 400);
        }

        $email = $data['email'] ?? null;
        $plainPassword = $data['password'] ?? null;
        $name = $data['name'] ?? null;

        if (!$email || !$plainPassword || !$name) {
            return $this->json(['error' => 'Missing required fields'], 400);
        }

        $user = new User();
        $user->setEmail($email);
        $user->setName($name);
        $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));
        $user->setRoles(['ROLE_USER']);

        // Validation Symfony
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return $this->json(['error' => $errorsString], 400);
        }

        $em->persist($user);
        $em->flush();

        return $this->json(['message' => 'User created successfully'], 201);
    }
}
