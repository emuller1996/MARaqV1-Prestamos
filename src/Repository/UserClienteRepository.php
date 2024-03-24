<?php

namespace App\Repository;

use App\Entity\UserCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<UserCliente>
 *
 * @method UserCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCliente[]    findAll()
 * @method UserCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserClienteRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCliente::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof UserCliente) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * Valida el nombre de usuario y la contraseña.
     *
     * @param string $nombreUsuario
     * @param string $contraseña
     * @return Usuario|null
     */
    public function validarCredenciales(string $username,  $pass): UserCliente
    {

        // Buscar el usuario por su nombre de usuario
        $usuario = $this->findOneBy(['username' => $username]);

        // Verificar si se encontró el usuario
        if (!$usuario) {
            return new UserCliente(); // Usuario no encontrado
        }

        // Validar la contraseña hash
        if (password_verify($pass, $usuario->getPassword())) {
            return  $usuario; // Contraseña válida
        } else {
            return  $usuario; // Contraseña no válida
        }
        /* return $this->createQueryBuilder('u')
            ->andWhere('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult(); */
    }

//    /**
//     * @return UserCliente[] Returns an array of UserCliente objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCliente
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
