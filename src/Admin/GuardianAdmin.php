<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class GuardianAdmin extends AbstractAdmin
{
    private EntityManagerInterface $entityManager;
    private array $students;

    public function __construct(string $code, string $class, string $baseControllerName, EntityManagerInterface $entityManager)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->entityManager = $entityManager;
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
        $filter->add('email', StringFilter::class, ['global_search' => true, 'label' => 'Email']);
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
            ->add('email', null, [
                'label' => 'E-mail',
            ])
            ->add('students', null, [
                'label' => 'Studenti',
                'by_reference' => false,
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
                ->add('email', TextType::class, ['label' => 'E-mail'])
                ->add('students', null, [
                    'label' => 'Studenti',
                    'by_reference' => true,
                ])
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('firstname', null, ['label' => 'Jméno'])
            ->add('lastname', null, ['label' => 'Příjmení'])
            ->add('email', null, ['label' => 'E-mail'])
            ->add('students', null, ['label' => 'Studenti'])
        ;
    }

    protected function prePersist(object $object): void
    {
        foreach ($object->getStudents() as $student){
            $student->addGuardian($object);
        }

        parent::prePersist($object);
    }

    protected function preUpdate(object $object): void
    {
        $originalStudents = $this->entityManager->getRepository(Student::class)->createQueryBuilder('s')
            ->innerJoin('s.guardians','guardians')
            ->where('guardians.id = :guardianId')
            ->setParameter('guardianId', $object->getId()->toBinary())
            ->getQuery()
            ->getResult();
        $removedStudents = array_diff($originalStudents, $object->getStudents()->toArray());
        foreach($removedStudents as $removedStudent){
            $object->removeStudent($removedStudent);
        }

        foreach ($object->getStudents() as $student){
            $student->addGuardian($object);
        }
        parent::prePersist($object);
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }
}
