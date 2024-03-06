<?php

declare(strict_types=1);

namespace App\Admin;

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

final class TimelineAdmin extends AbstractAdmin
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
        $sortValues[DatagridInterface::SORT_BY] = 'classroom';
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
        $filter->add('schoolYear.year', StringFilter::class, ['global_search' => true, 'label' => 'Školní rok']);
        $filter->add('classroom.name', StringFilter::class, ['global_search' => true, 'label' => 'Třída']);
        $filter->add('active', BooleanFilter::class, ['global_search' => true, 'label' => 'Aktivní']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('schoolYear', null, [
                'label' => 'Školní rok',
            ])
            ->add('classroom', null, [
                'label' => 'Třída',
            ])
            ->add('active', null, [
                'label' => 'Aktivní',
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
                ->add('classroom', null, ['label' => 'Třída'])
                ->add('schoolYear', null, ['label' => 'Školní rok'])
                ->add('active', null, ['label' => 'Aktivní'])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('schoolYear', null, ['label' => 'Školní rok'])
            ->add('classroom', null, ['label' => 'Třída'])
            ->add('active', null, ['label' => 'Aktivní'])
            ->add('questionnaires', null, ['label' => 'Dotazníky'])
        ;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('delete');
        parent::configureRoutes($collection);
    }
}
