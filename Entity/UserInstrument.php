<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CompositionBundle\Entity\Instrument;

/**
 * UserInstrument
 *
 * @ORM\Table(name="user_instrument")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserInstrumentRepository")
 */
class UserInstrument
{
    const EXPERIENCE_VERY_LOW = 'user_instrument.experience.very_low';
    const EXPERIENCE_LOW = 'user_instrument.experience.low';
    const EXPERIENCE_MIDDLE = 'user_instrument.experience.middle';
    const EXPERIENCE_HIGH = 'user_instrument.experience.high';
    const EXPERIENCE_VERY_HIGH = 'user_instrument.experience.very_high';


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="string", length=40, nullable=true)
     */
    private $experience = self::EXPERIENCE_MIDDLE;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="userInstrument")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="CompositionBundle\Entity\Instrument", inversedBy="userInstruments")
     */
    private $instrument;


    public function getExperienceAsInt($experience)
    {
        switch($experience)
        {
            case UserInstrument::EXPERIENCE_VERY_LOW :
                return 1;
            case UserInstrument::EXPERIENCE_LOW :
                return 2;
            case UserInstrument::EXPERIENCE_MIDDLE :
                return 3;
            case UserInstrument::EXPERIENCE_HIGH :
                return 4;
            case UserInstrument::EXPERIENCE_VERY_HIGH :
                return 5;
            default :
                return 0;
        }

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set experience
     *
     * @param string $experience
     *
     * @return UserInstrument
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return UserInstrument
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set instrument
     *
     * @param Instrument $instrument
     *
     * @return UserInstrument
     */
    public function setInstrument(Instrument $instrument = null)
    {
        $this->instrument = $instrument;

        return $this;
    }

    /**
     * Get instrument
     *
     * @return Instrument
     */
    public function getInstrument()
    {
        return $this->instrument;
    }
}
