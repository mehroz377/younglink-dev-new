<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Classroom;
use App\Entity\SchoolEmployee;
use App\Enum\SchoolEmployeeRole;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SchoolEmployeeAdmin extends AbstractAdmin
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
        $sortValues[DatagridInterface::SORT_BY] = 'lastname';
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
        $filter->add('firstname', StringFilter::class, ['global_search' => true, 'label' => 'Jméno']);
        $filter->add('lastname', StringFilter::class, ['global_search' => true, 'label' => 'Příjmení']);
        $filter->add('schoolEmployeeRole', ChoiceFilter::class, [
            'global_search' => true,
            'label' => 'Pozice',
            'field_type' => ChoiceType::class,
            'field_options' => [
                'choices' => [
                    'Administrátor' => SchoolEmployeeRole::ADMINISTRATOR->value,
                    'Ředitel' => SchoolEmployeeRole::DIRECTOR->value,
                    'Školní psycholog' => SchoolEmployeeRole::PSYCHOLOGIST->value,
                    'Učitel' => SchoolEmployeeRole::TEACHER->value,
                ]
            ]
            ]);
        $filter->add('school.name', StringFilter::class, ['global_search' => true, 'label' => 'Název školy']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('firstname', null, [
                'label' => 'Jméno',
            ])
            ->add('lastname', null, [
                'label' => 'Příjmení',
            ])
            ->add('schoolEmployeeRole', null, [
                'label' => 'Pozice',
                'template' => 'admin/list/schoolEmployeeRole.html.twig',
            ])
            ->add('school', null, [
                'label' => 'Škola',
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
                ->add('firstname', TextType::class, ['label' => 'Jméno'])
                ->add('lastname', TextType::class, ['label' => 'Příjmení'])
                ->add('school', null, ['label' => 'Škola'])
                ->add('schoolEmployeeRole', ChoiceType::class, [
                    'label' => 'Pozice',
                    'choices' => [
                        'Administrátor' => SchoolEmployeeRole::ADMINISTRATOR->value,
                        'Ředitel' => SchoolEmployeeRole::DIRECTOR->value,
                        'Školní psycholog' => SchoolEmployeeRole::PSYCHOLOGIST->value,
                        'Učitel' => SchoolEmployeeRole::TEACHER->value,
                    ]
                ])
            ->add('classrooms', null, [
                'label' => 'Třídy',
                'by_reference' => false,
            ])
            // TODO vyřešit type
//                ->add('classrooms', CollectionType::class, [
//                    'entry_type' => ,
//                    'label' => 'Třídy',
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'by_reference' => false,
//                ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('firstname', null, ['label' => 'Jméno'])
            ->add('lastname', null, ['label' => 'Příjmení'])
            ->add('school', null, ['label' => 'Škola'])
            ->add('schoolEmployeeRole', null, [
                'label' => 'Pozice',
                'template' => 'admin/show/schoolEmployeeRole.html.twig'
            ])
            ->add('classrooms', null, [
                'label' => 'Třídy',
                'by_reference' => false,
            ])
        ;
    }

    /** @param SchoolEmployee $object */
    protected function preRemove(object $object): void
    {
        $object->getSchool()->removeSchoolEmployee($object);
        /** @var Classroom $classroom */
        foreach ($object->getClassrooms() as $classroom) {
            $object->removeClassroom($classroom);
            $classroom->removeSchoolEmployee($object);
        }
        parent::preRemove($object); // TODO: Change the autogenerated stub
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }
}
