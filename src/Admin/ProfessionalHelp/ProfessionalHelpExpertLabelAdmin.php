<?php

declare(strict_types=1);

namespace App\Admin\ProfessionalHelp;

use App\Entity\ProfessionalHelp\ProfessionalHelpExpert;
use Doctrine\ORM\EntityManagerInterface;
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

final class ProfessionalHelpExpertLabelAdmin extends AbstractAdmin
{
    private EntityManagerInterface $entityManager;

    public function __construct(string $code, string $class, string $baseControllerName, EntityManagerInterface $entityManager)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->entityManager = $entityManager;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('name', StringFilter::class, ['global_search' => true, 'label' => 'Název']);
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

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('name', null, [
                'label' => 'Název',
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'edit' => [],
                ],
                'label' => 'Akce',
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
                ->add('name', TextType::class, ['label' => 'Název']);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('name', null, ['label' => 'Název'])
        ;
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }

    /**
     * @throws ModelManagerException
     */
    protected function preRemove(object $object): void
    {
        $experts = $this->entityManager->getRepository(ProfessionalHelpExpert::class)->createQueryBuilder('e')
            ->innerJoin('e.labels','labels')
            ->where('labels.id = :labelId')
            ->setParameter('labelId', $object->getId())
            ->getQuery()
            ->getResult();

        if (!empty($experts)){
            throw new ModelManagerException(message: 'Není možné odebrat štítek, pokud existuje expert která jej má přiřazený.');
        }
        parent::preRemove($object);
    }
}
