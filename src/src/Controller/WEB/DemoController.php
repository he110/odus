<?php

declare(strict_types=1);

namespace App\Controller\WEB;

use App\Document\Bot;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    /**
     * @Route(path="/test")
     */
    public function test(DocumentManager $dm): Response
    {
        $bot = new Bot();
        $bot->setName('Тестовый');

        $dm->persist($bot);
        $dm->flush();

        return $this->json(['status' => $bot->getId()]);
    }
}
