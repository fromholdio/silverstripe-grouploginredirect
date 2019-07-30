<?php

namespace Fromholdio\GroupLoginRedirect\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;

class LoginGroupExtension extends DataExtension
{
    private static $has_one = [
        'LoginTargetPage' => SiteTree::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('LoginTargetPageID');
        $targetPageField = TreeDropdownField::create(
            'LoginTargetPageID',
            'Login Target Page',
            SiteTree::class
        );
        $targetPageField->setDescription(
            'Select a page that users in this group will be force-redirected to on login.'
        );
        $fields->insertAfter('ParentID', $targetPageField);
    }
}