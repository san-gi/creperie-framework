<?php

namespace App\Controller\Admin;

use App\Entity\Factures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class FacturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Factures::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('etat'),
            DateField::new('date'),
            AssociationField::new('crepes')
        ];
    }

}
