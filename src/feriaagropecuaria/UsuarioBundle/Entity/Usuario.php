<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 09/02/2016
 * Time: 22:18
 */

namespace feriaagropecuaria\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Usuario
 * @ORM\Entity()
 *
 */

class Usuario implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idUsuario;

    /**
     * @ORM\Column(name="Usuario", type="string")
     * @Assert\NotBlank(message="debe especificar el valor del usuario")
     */
    protected $Usuario;

    /**
     * @ORM\Column(name="Password", type="string")
     * @Assert\NotBlank(message="debe especificar el valor de la contraseña")
     */
    protected $password;

    protected $Salt;
    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->Usuario;
    }

    /**
     * @param mixed $Usuario
     */
    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $Pass
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->Salt;
    }

    /**
     * @param mixed $Salt
     */
    public function setSalt($Salt)
    {
        $this->Salt = $Salt;
    }


    function eraseCredentials()
    {
    }
    function getRoles()
    {
        return array('ROLE_USUARIO');
    }
    function getUsername()
    {
        return $this->getUsuario();
    }


    public function __toString()
    {
        return $this->getUsuario();
    }

}