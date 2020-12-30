<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/", name="news")
     */
    public function index(Request $request, NewsRepository $newsRepository): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $newsRepository->getPaginator($offset);

        return $this->render(
            'news/index.html.twig',
            [
                'newsCollection' => $paginator,
                'previous' => $offset - NewsRepository::PAGINATOR_PER_PAGE,
                'next' => min(count($paginator), $offset + NewsRepository::PAGINATOR_PER_PAGE),
            ]
        );
    }

    /**
     * @Route("/news/new", name="news_new")
     */
    public function new(): Response
    {
        $news = new News();
        $news->setCreatedAt(new \DateTimeImmutable());

        $form = $this->createForm(NewsType::class, $news);

        return $this->render('news/new.html.twig', ['form' => $form]);
    }

    /**
     * @Route("/news/{id}", name="news_view")
     */
    public function view(News $news): Response
    {
        return $this->render(
            'news/view.html.twig',
            [
                'news' => $news
            ]
        );
    }
}
