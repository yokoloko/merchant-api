<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/")
 */
class UserController
{
    /**
     * @Route(
     *     name="api_users_post",
     *     path="/users",
     *     path="/user/register",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_collection_operation_name"="post"
     *     }
     * )
     * @param User $data
     * @param UserPasswordEncoderInterface $encoder
     * @return User
     */
    public function postAction(User $data, UserPasswordEncoderInterface $encoder): User
    {
        return $this->encodePassword($data, $encoder);
    }

    /**
     * @Route(
     *     name="api_users_put",
     *     path="/users/{id}",
     *     requirements={"id"="\d+"},
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_item_operation_name"="put"
     *     }
     * )
     * @param User $data
     * @param UserPasswordEncoderInterface $encoder
     * @return User
     */
    public function putAction(User $data, UserPasswordEncoderInterface $encoder): User
    {
        return $this->encodePassword($data, $encoder);
    }

    /**
     * @param User $data
     * @param UserPasswordEncoderInterface $encoder
     * @return User
     */
    protected function encodePassword(User $data, UserPasswordEncoderInterface $encoder): User
    {
        $encoded = $encoder->encodePassword($data, $data->getPassword());
        $data->setPassword($encoded);

        return $data;
    }
}
