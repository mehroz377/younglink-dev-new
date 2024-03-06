<?php

declare(strict_types=1);

namespace App\Admin\ProfessionalHelp;

use App\Form\ImageFileWithPreviewType;
use App\Service\FileUploader;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\StringFilter;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class ProfessionalHelpExpertAdmin extends AbstractAdmin
{
    private FileUploader $fileUploader;

    public function __construct(string $code, string $class, string $baseControllerName, FileUploader $fileUploader)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->fileUploader = $fileUploader;
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('firstname', StringFilter::class, ['global_search' => true, 'label' => 'Jméno']);
        $filter->add('lastname', StringFilter::class, ['global_search' => true, 'label' => 'Příjmení']);
        $filter->add('specialization', StringFilter::class, ['global_search' => true, 'label' => 'Specializace']);
        $filter->add('description', StringFilter::class, ['global_search' => true, 'label' => 'Popis']);
        $filter->add('district.name', StringFilter::class, ['global_search' => true, 'label' => 'Okres']);
    }

    /** @param array<string, string|int> $sortValues */
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        // display the first page (default = 1)
        $sortValues[DatagridInterface::PAGE] = 1;

        // reverse order (default = 'ASC')
        $sortValues[DatagridInterface::SORT_ORDER] = 'DESC';

        // name of the ordered field (default = the model's id field, if any)
        $sortValues[DatagridInterface::SORT_BY] = 'id';
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
            ->add('firstname', null, [
                'label' => 'Jméno',
            ])
            ->add('lastname', null, [
                'label' => 'Příjmení',
            ])
            ->add('specialization', null, [
                'label' => 'Specializace',
            ])
            ->add('district', null, [
                'label' => 'Okres',
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
                ->add('firstname', TextType::class, ['label' => 'Jméno'])
                ->add('lastname', TextType::class, ['label' => 'Příjmení'])
                ->add('specialization', TextType::class, ['label' => 'Specializace'])
                ->add('phone', TextType::class, ['label' => 'Telefon'])
                ->add('email', EmailType::class, ['label' => 'E-mail'])
                ->add('url', TextType::class, ['label' => 'Webová stránka'])
                ->add('labels', null, ['label' => 'Štítky'])
                ->add('district', null, ['label' => 'Okres'])
                ->add('description', TextareaType::class, [
                    'label' => 'Popis',
                    'empty_data' => '',
                    'attr' => array(
                        'class' => 'ckeditor',
                    ),
                ])
                ->add('uploadedImage', ImageFileWithPreviewType::class, [
                    'label' => 'Obrázek',
                    'required' => false,
                    'data_attribute' => 'image',
                ])
           ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('firstname', null, ['label' => 'Jméno'])
            ->add('lastname', null, ['label' => 'Příjmení'])
            ->add('specialization', null, ['label' => 'Specializace'])
            ->add('phone', null, ['label' => 'Telefon'])
            ->add('email', null, ['label' => 'E-mail'])
            ->add('url', null, ['label' => 'Webová stránka'])
            ->add('image', null, ['label' => 'Obrázek'])
            ->add('description', null, ['label' => 'Popis'])
            ->add('labels', null, ['label' => 'Štítky'])
            ->add('district', null, ['label' => 'Okres'])
        ;
    }

    protected function prePersist(object $object): void
    {
        $this->manageFileUpload($object);
    }

    protected function preUpdate(object $object): void
    {
        $this->manageFileUpload($object);
    }

    private function manageFileUpload(object $object): void
    {
        if ($object->getUploadedImage() instanceof UploadedFile) {
            $object->setImage($this->fileUploader->saveFile($object->getUploadedImage()));
        }
    }

    protected function configureBatchActions(array $actions): array
    {
        unset($actions['delete']);
        return parent::configureBatchActions($actions);
    }
}
