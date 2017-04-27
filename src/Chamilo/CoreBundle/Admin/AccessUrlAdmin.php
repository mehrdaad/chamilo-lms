<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Class AccessUrlAdmin
 * @package Chamilo\CoreBundle\Admin
 */
class AccessUrlAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('url', 'url')
            ->add('description', 'ckeditor')
            ->add('active')
            ->add('limitCourses')
            ->add('limitActiveCourses')
            ->add('limitSessions')
            ->add('limitUsers')
            ->add('limitTeachers')
            ->add('limitDiskSpace')
            ->add('email', 'email')
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('url')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('url')
        ;
    }

    /**
     * @param $course
     * @return mixed|void
     */
    public function preUpdate($course)
    {
        //$course->setUsers($course->getUsers());
    }
}
