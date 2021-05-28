<?php

namespace App\Controller\Admin;

use App\Entity\Crepe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CrepeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Crepe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name'),
            TextField::new('description'),
            TextField::new('img'),
            IntegerField::new('price'),
            AssociationField::new('ingredients')

        ];
    }

}
