<?php


namespace BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\CommentaireRepository")
 * @ORM\Table(name="`Commentaire`")
 * @ORM\HasLifecycleCallbacks()
 */

class Commentaire
{


    /**
     * @var string
     *
     * @ORM\Column(name="`content`", type="text", unique=false)
     */
    private $content;
    /**
     * @var integer
     *
     * @ORM\Column(name="`like`", type="integer", unique=false)
     */
    private $like;
    /**
     * @var integer
     *
     * @ORM\Column(name="`dislike`", type="integer", unique=false)
     */
    private $dislike;

    /**
     * @return int
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * @param int $like
     */
    public function setLike($like)
    {
        $this->like = $like;
    }

    /**
     * @return int
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * @param int $dislike
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;
    }




    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @Assert\DateTime
     */
    private $posted_at;


    /**
     * @ORM\PrePersist
     */

    public function setPostedAt()
    {
        $this->posted_at = new \DateTime('now');
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }



    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }
    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

}