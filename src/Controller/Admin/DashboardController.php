<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Page;
use App\Entity\User;
use App\Entity\Order;
use App\Entity\Skills;
use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\Project;
use App\Entity\Category;
use App\Entity\Customers;
use App\Entity\Testimonial;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController {

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response {
        // return parent::index();
        return $this->render('Admin/dashboard.html.twig');


        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SKDigit - Admin dashboard');
    }
    public function configureMenuItems(): iterable {

        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Pages', 'fas fa-file', Page::class);

        yield MenuItem::linkToCrud('Project', 'fas fa-box', Project::class);
        yield MenuItem::linkToCrud('Customers', 'fas fa-user', Customers::class);
        yield MenuItem::linkToCrud('Tag', 'fas fa-list', Tag::class);
        yield MenuItem::linkToCrud('Testimonial', 'fas fa-comment', Testimonial::class);
        yield MenuItem::linkToCrud('Skills', 'fas fa-list', Skills::class);
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-envelope', Contact::class);
    }
}
