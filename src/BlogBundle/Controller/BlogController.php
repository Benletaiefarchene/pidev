<?php

namespace BlogBundle\Controller;
use blackknight467\StarRatingBundle\Form\RatingType;
use BlogBundle\Entity\Post;
use BlogBundle\Entity\Commentaire;
use BlogBundle\Repository\CommentaireRepository;
use BlogBundle\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use BlogBundle\Form\PostType;


class BlogController extends Controller
{
    public function homeAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository('BlogBundle:Post')->findAll();
        return $this->render('front.html.twig', array(
            "posts" =>$posts
        ));
        return $this->redirectToRoute('home_page');
    }

    public function addAction(Request $request)
    {

        $post = new Post();
        $form= $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $post->setCreator($this->getUser());
            $post->setPostdate(new \DateTime('now'));

            $em->persist($post);
            $em->flush();

            $this->addFlash('info', 'Created Successfully !');
        }
        return $this->render('@Blog/Post/add.html.twig', array(
            "Form"=> $form->createView()
        ));
        return $this->redirectToRoute('list_post');
    }

    public function listpostAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository('BlogBundle:Post')->findAll();
        return $this->render('@Blog/Post/list.html.twig', array(
            "posts" =>$posts
        ));
        return $this->redirectToRoute('list_post');

    }
    public function updatetAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $transp=$em->getRepository(Post::class)->find($id);
        if($request->isMethod('POST'))
        {
            $transp->setTitle($request->get('title'));
            $transp->setPhoto($request->get('photo'));
            $transp->setrating($request->get('rating'));



            $em->flush();
            return $this->redirectToRoute("list_post");
        }
        return $this->render('@Blog/Post/update.html.twig',array('transp'=>$transp));
    }

    public function deletepostAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $Post=$em->getRepository('BlogBundle:Post')->find($id);
        $em->remove($Post);
        $em->flush();
        return $this->redirectToRoute('list_post');
    }
    public function showdetailedAction($id,Request $request)
    { $post = new Post();
        $form= $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        $em= $this->getDoctrine()->getManager();
        $p=$em->getRepository('BlogBundle:Post')->find($id);
        return $this->render('@Blog/Post/detailedpost.html.twig', array(
            'title'=>$p->getTitle(),
            'date'=>$p->getPostdate(),
            'photo'=>$p->getPhoto(),
            'descripion'=>$p->getDescription(),
            'rating'=>$p->getRating(),
            'posts'=>$p,
            'comments'=>$p,
            'id'=>$p->getId()

        ));
        return $this->render('@Blog/Post/detailedpost.html.twig', array(
            "form"=> $form->createView()));

    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts =  $em->getRepository('BlogBundle:Post')->findtitleByString($requestString);
        $post =  $em->getRepository('BlogBundle:Post')->findDescByString($requestString);
        $date =  $em->getRepository('BlogBundle:Post')->findDateByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        if(!$post) {
        $result['posts']['error'] = "Post Not found :( ";
         } else {
        $result['posts'] = $this->getRealEntities($post);
    }
        if(!$date) {
            $result['posts']['error'] = "Post Not found :( ";
        } else {
            $result['posts'] = $this->getRealEntities($date);
        }
        return new Response(json_encode($result));


    }
    public function getRealEntities($posts){
                foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getPhoto(),$posts->getTitle(),];

        }
        foreach ($posts as $post) {
            $realEntities[$post->getId()] = [$post->getPhoto(), $post->getTitle(),];
        }
        foreach ($posts as $date) {
            $realEntities[$date->getId()] = [$date->getPhoto(), $date->getTitle(),];
        }
        return $realEntities;
    }

    public function addCommentAction(Request $request, UserInterface $user)
    {

        $ref = $request->headers->get('referer');

        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->findPostByid($request->request->get('post_id'));

        $comment = new Commentaire();

        $comment->setUser($user);
        $comment->setPost($post);
        $comment->setContent($request->request->get('comment'));
        $comment->setLike(0);
        $comment->setDislike(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
            'info', 'Comment published !.'
        );

        return $this->redirect($ref);

    }

    public function deleteCommentAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $comment=$em->getRepository('BlogBundle:Commentaire')->find($id);
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute('list_post');
    }

    public function  likeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('BlogBundle:Commentaire')->find($id);
        $new = $commentaire->getLike()+1;
        $commentaire->setLike($new);
        dump($commentaire);
        $em->persist($commentaire);
        $em->flush();
        return new Response($new);
    }

    public function  dislikeAction($id) {
        $em = $this->getDoctrine()->getManager();
        $commentaire = $em->getRepository('BlogBundle:Commentaire')->find($id);
        $new = $commentaire->getDislike()+1;
        $commentaire->setDislike($new);
        dump($commentaire);
        $em->persist($commentaire);
        $em->flush();
        return new Response($new);
    }
    public function updatetcommAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $transp=$em->getRepository(Commentaire::class)->find($id);
        if($request->isMethod('POST'))
        {
            $transp->setcontent($request->get('content'));




            $em->flush();
            return $this->redirectToRoute("list_post");
        }
        return $this->render('@Blog/Post/updatecomm.html.twig',array('transp'=>$transp));
    }


    public function blockAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $post->setBlocke(true);
        $em->persist($post);
        $em->flush();
    }
    public function unblockAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $post->setBlocke(false);
        $em->persist($post);
        $em->flush();
    }
}