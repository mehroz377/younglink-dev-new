<?php

declare(strict_types=1);

namespace App\Admin;

use App\Enum\Gender;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class StudentAdmin extends AbstractAdmin
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
        $filter->add('egoId', StringFilter::class, ['global_search' => true, 'label' => 'Ego ID']);
        $filter->add('classroom.name', StringFilter::class, ['global_search' => true, 'label' => 'Třída']);
        $filter->add('school.name', StringFilter::class, ['global_search' => true, 'label' => 'Název školy']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('lastname', null, [
                'label' => 'Příjmení',
            ])
            ->add('firstname', null, [
                'label' => 'Jméno',
            ])
            ->add('egoId', null, [
                'label' => 'Ego ID',
            ])
            ->add('classroom', null, [
                'label' => 'Třída',
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
                ->add('gender', ChoiceType::class, [
                    'label' => 'Pohlaví',
                    'choices' => [
                        'Muž' => Gender::MALE,
                        'Žena' => Gender::FEMALE,
                    ]
                ])
                ->add('egoId', TextType::class, ['label' => 'Ego ID', 'required' => false])
                ->add('email', TextType::class, ['label' => 'E-mail'])
                ->add('classroom', null, ['label' => 'Třída'])
                ->add('school', null, ['label' => 'Škola'])
                ->add('guardians', null, [
                    'label' => 'Rodiče',
                    'by_reference' => true,
                ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('firstname', null, ['label' => 'Jméno'])
            ->add('lastname', null, ['label' => 'Příjmení'])
            ->add('egoId', null, ['label' => 'Ego ID'])
            ->add('email', null, ['label' => 'E-mail'])
            ->add('gender', null, [
                'label' => 'Pohlaví',
                'template' => 'admin/show/gender.html.twig'
            ])
            ->add('classroom', null, ['label' => 'Třída'])
            ->add('school', null, ['label' => 'Škola'])
            ->add('guardians', null, ['label' => 'Rodiče'])
            ->add('questionnaires', null, ['label' => 'Dotazníky'])
        ;
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }
}
