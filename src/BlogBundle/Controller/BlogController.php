<?php

namespace BlogBundle\Controller;
use BlogBundle\Entity\Post;
use BlogBundle\Entity\Commentaire;
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
        return $this->render('@Blog/Post/home.html.twig', array(
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
    public function showdetailedAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $p=$em->getRepository('BlogBundle:Post')->find($id);
        return $this->render('@Blog/Post/detailedpost.html.twig', array(
            'title'=>$p->getTitle(),
            'date'=>$p->getPostdate(),
            'photo'=>$p->getPhoto(),
            'descripion'=>$p->getDescription(),
            'posts'=>$p,
            'comments'=>$p,
            'id'=>$p->getId()
        ));
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
}