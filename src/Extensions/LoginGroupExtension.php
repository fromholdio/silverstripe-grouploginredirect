<?php

namespace Fromholdio\GroupLoginRedirect\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TreeDropdownField;

class LoginGroupExtension extends Extension
{
    private static array $has_one = [
        'LoginTargetPage' => SiteTree::class
    ];

    public function updateCMSFields(FieldList $fields): void
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
