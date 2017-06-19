<?php
namespace UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UsernameNotTaken extends Constraint
{
    public $message = 'Ce nom d\'utilisateur est déjà utilisé';
}