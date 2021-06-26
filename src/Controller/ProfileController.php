<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

class ProfileController extends AbstractController
{
    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    public function themes(ParameterBagInterface $params, UserInterface $user,
        EncoderInterface $encoder, DecoderInterface $decoder): Response
    {
        // include bootswatch themes description
        $themes = $decoder->decode(file_get_contents(implode(DIRECTORY_SEPARATOR, [
            $params->get('kernel.project_dir'), 'assets', 'styles', 'themes', 'themes.json'
        ])), 'json');

        // remove disabled themes
        $themes_new = [];
        foreach ($themes as $k=>$v) {
            //if ($this->getParameter('kernel.environment') !== 'prod'
                //and $v['name'] !== 'Default') {
                //continue;
            //}
            if ($v['enabled']) {
                $themes_new[] = $v;
            }
        }

        $params = [
            'themes_json'=>$encoder->encode($themes_new, 'json'),
            'user'=>$user,
        ];
        return $this->render('profile/themes.html.twig', $params);
    }

    public function changeTheme(Request $request, UserInterface $user) {
        $new_theme = $request->get('new_theme');
        $user->setTheme($new_theme);
        $this->em->persist($user);
        $this->em->flush($user);
        return $this->redirectToRoute('profile_theme');
    }
}
