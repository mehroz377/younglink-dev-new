<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Questionnaire;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class QuestionnaireAdmin extends AbstractAdmin
{
    public function __construct(string $code, string $class, string $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);
    }

    /** @param array<string, string|int> $sortValues */
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        // display the first page (default = 1)
        $sortValues[DatagridInterface::PAGE] = 1;

        // reverse order (default = 'ASC')
        $sortValues[DatagridInterface::SORT_ORDER] = 'DESC';

        // name of the ordered field (default = the model's id field, if any)
        $sortValues[DatagridInterface::SORT_BY] = 'name';
    }

    /**
     * @param array<string> $action
     */
    protected function configureSideMenu(
        MenuItemInterface $menu,
        array $action,
        ?AdminInterface $childAdmin = null
    ): void {
        if (!$childAdmin && !in_array($action, ['edit', 'show'], true)) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Upravit stránku', [
                'uri' => $admin->generateUrl('edit', ['id' => $id]),
            ]);
        }

        if (!$this->isGranted('LIST')) {
            return;
        }
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('name', StringFilter::class, ['global_search' => true, 'label' => 'Název dotazníku']);
        $filter->add('finished', BooleanFilter::class, ['global_search' => true, 'label' => 'Dokončený']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name', null, [
                'label' => 'Název dotazníku',
            ])
            ->add('timeline', null, [
                'label' => 'Časová osa',
            ])
            ->add('position', null, [
                'label' => 'Pozice',
            ])
            ->add('type', null, [
                'label' => 'Druh šetření',
                'template' => 'admin/list/questionnaireType.html.twig',
            ])
            ->add('finished', null, [
                'label' => 'Dokončený',
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                ],
                'label' => 'Akce',
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
                ->add('name', TextType::class, ['label' => 'Název dotazníku'])
                ->add('timeline', null, ['label' => 'Časová osa'])
                ->add('position', null, ['label' => 'Pozice'])
                ->add('type', ChoiceType::class, [
                    'label' => 'Druh šetření',
                    'choices' => [
                        'Kontrolní šetření' => Questionnaire::CONTROL_QUESTIONNAIRE,
                        'Celé šetření' => Questionnaire::FULL_QUESTIONNAIRE,
                    ]
                ])
                ->add('fillDate', DateType::class, [
                    'label' => 'Datum vyplnění',
                    'input' => 'datetime_immutable',
                    'widget' => 'single_text',
                ])
                ->add('finished', null, ['label' => 'Dokončeno'])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name', null, ['label' => 'Název dotazníku'])
            ->add('timeline', null, ['label' => 'Časová osa'])
            ->add('position', null, ['label' => 'Pozice'])
            ->add('type', null, [
                'label' => 'Druh dotazníku',
                'template' => 'admin/show/questionnaireType.html.twig',
            ])
            ->add('fillDate', null, ['label' => 'Vyplnit do'])
            ->add('finished', null, ['label' => 'Dokončeno'])
            ->add('students', null, ['label' => 'Studenti'])
        ;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('delete');
        parent::configureRoutes($collection);
    }
}
