<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;
use UserBundle\Form\UserInstrumentType;
use Symfony\Component\HttpFoundation\Request;


class UserController extends FOSRestController
{
    /**
     * @Route("member/user/{id}", name="user_view")
     */
    public function viewAction(User $user)
    {
        return $this->handleView($this
            ->view($user)
            ->setTemplateVar('user')
            ->setTemplate('UserBundle:User:view.html.twig')
        );
    }

    /**
     * @Route("admin/user/{id}/update", name="user_edit")
     */
    public function updateAction(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user, ['role' => $this->getUser()->getRoles()]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_adminView', array('id' => $user->getId()));
        }

        return $this->handleView(
        $this->view($form->createView())
            ->setTemplateVar('form')
            ->setTemplate('UserBundle:User:edit.html.twig')
        );
    }

    /**
     * @Route("member/profile/update", name="profile_edit")
     */
    public function updateProfileAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }

        return $this->handleView(
        $this->view($form->createView())
            ->setTemplateVar('form')
            ->setTemplate('UserBundle:User:edit.html.twig')
        );
    }

    /**
     * @Route("admin/user/{id}/remove", name="user_delete")
     */
    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->routeRedirectView('user_adminList');
    }

    /**
     * @Route("member/users", name="user_list")
     */
    public function listAction()
    {
        $userRepository = $this->getDoctrine()->getRepository('UserBundle:User');

        $users = $userRepository->findAll();

        $view = $this->view($users)
            ->setTemplateVar('users')
            ->setTemplate('UserBundle:User:list.html.twig');

        return $this->handleView($view);
    }

    /**
     * @Route("admin/users", name="user_adminList")
     */
    public function adminListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userList = $em->getRepository(User::class)->findAll();

        return $this->handleView($this->view($userList)
            ->setTemplateVar('users')
            ->setTemplate('UserBundle:User:admin_list.html.twig'));
    }

    /**
     * @Route("admin/user/{id}", name="user_adminView")
     */
    public function adminViewAction(User $user)
    {
        return $this->handleView($this
                ->view($user)
                ->setTemplateVar('user')
                ->setTemplate('UserBundle:User:admin_view.html.twig')
        );
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("admin/enable/{id}", name="user_enable")
     */
    public function enableAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $user->setEnabled(!$this->getUser()->isEnabled());

        $em->persist($user);
        $em->flush();

        return $this->handleView($this
            ->view($user)
            ->setTemplateVar('user')
            ->setTemplate('UserBundle:User:view.html.twig')
        );
    }

    /**
     * @Route("member/instruments/update", name="instruments_edit")
    */
    public function updateInstrumentsAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserInstrumentType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }


        return $this->handleView($this
            ->view($user)
            ->setTemplateVar('user')
            ->setTemplate('UserBundle:User:instruments_edit.html.twig')
        );
    }
}