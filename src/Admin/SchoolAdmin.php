<?php

declare(strict_types=1);

namespace App\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SchoolAdmin extends AbstractAdmin
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
        $filter->add('name', StringFilter::class, ['global_search' => true, 'label' => 'Název školy']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name', null, [
                'label' => 'Název školy',
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
                ->add('name', TextType::class, ['label' => 'Název školy']);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name', null, ['label' => 'Název školy'])
            ->add('district', null, ['label' => 'Okres'])
            ->add('schoolEmployees', null, ['label' => 'Zaměstnanci školy'])
            ->add('classrooms', null, ['label' => 'Třídy'])
        ;
    }

    /**
     * @throws ModelManagerException
     */
    protected function preRemove(object $object): void
    {
        if (!$object->getClassrooms()->isEmpty() || !$object->getSchoolEmployees()->isEmpty()){
            throw new ModelManagerException(message: 'Pro smazání školy je nutné nejprve odebrat všechny její třídy a zaměstnance.');
        }
        parent::preRemove($object);
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }
}
