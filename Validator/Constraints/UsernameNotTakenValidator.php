<?php
namespace UserBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UsernameNotTakenValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($username, Constraint $constraint)
    {
        $result = $this->em->getRepository('UserBundle:User')->findByUsername($username);

        if ($result != null)
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $username)
                ->addViolation();
        }
    }
}