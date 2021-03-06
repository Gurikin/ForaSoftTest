<?php
/**
 * Created by PhpStorm.
 * User: gurik
 * Date: 06.10.2018
 * Time: 8:03
 */
namespace AppBundle\Entity;
use AppBundle\Entity\UserTestResult;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserTestResult", mappedBy="user")
     */
    private $usersTestsResults;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->usersTestsResults = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add usersTestsResult
     *
     * @param \AppBundle\Entity\UserTestResult $usersTestsResult
     *
     * @return User
     */
    public function addUsersTestsResult(\AppBundle\Entity\UserTestResult $usersTestsResult)
    {
        $this->usersTestsResults[] = $usersTestsResult;

        return $this;
    }

    /**
     * Remove usersTestsResult
     *
     * @param \AppBundle\Entity\UserTestResult $usersTestsResult
     */
    public function removeUsersTestsResult(\AppBundle\Entity\UserTestResult $usersTestsResult)
    {
        $this->usersTestsResults->removeElement($usersTestsResult);
    }

    /**
     * Get usersTestsResults
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsersTestsResults()
    {
        return $this->usersTestsResults;
    }
}
