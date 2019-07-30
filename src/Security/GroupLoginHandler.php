<?php

namespace Fromholdio\GroupLoginRedirect\Security;

use SilverStripe\Security\Group;
use SilverStripe\Security\MemberAuthenticator\LoginHandler;
use SilverStripe\Security\Security;

class GroupLoginHandler extends LoginHandler
{
    protected function redirectAfterSuccessfulLogin()
    {
        $groups = Group::get()->exclude('LoginTargetPageID', 0);
        if ($groups->count() > 0) {
            $member = Security::getCurrentUser();
            if ($member && $member->exists()) {
                foreach($groups as $group) {
                    if ($member && $member->inGroup($group->ID, true)) {
                        $targetPage = $group->LoginTargetPage();
                        if ($targetPage && $targetPage->exists()) {
                            return $this->redirect($targetPage->AbsoluteLink());
                        }
                    }
                }
            }
        }
        return parent::redirectAfterSuccessfulLogin();
    }
}