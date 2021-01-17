<?php

namespace App\Controller\Admin;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
     
            yield TextField::new('name');
            yield TextField::new('eau','Souce d\'eau')
                ->setRequired(true);
            yield AssociationField::new('user')
                ->setRequired(true);
            yield ImageField::new('poster')
                ->setBasePath('images')
                ->setUploadDir('public/images')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setRequired(true);
            
            yield TextEditorField::new('commentaire');
         
    }
    
}
