<?php

/**
* Scenario :Allow upload for photo media types.
*/
    use Page\Login as LoginPage;
    use Page\Constants as ConstantsPage;
    use Page\UploadMedia as UploadMediaPage;
    use Page\DashboardSettings as DashboardSettingsPage;
    use Page\BuddypressSettings as BuddypressSettingsPage;

    $I = new AcceptanceTester($scenario);
    $I->wantTo('Allow upload for photo media types');

    $loginPage = new LoginPage($I);
    $loginPage->loginAsAdmin(ConstantsPage::$userName,ConstantsPage::$password);

    $settings = new DashboardSettingsPage($I);
    $settings->gotoTab($I,ConstantsPage::$typesTab,ConstantsPage::$typesTabUrl);
    $settings->verifyEnableStatus($I,ConstantsPage::$photoLabel,ConstantsPage::$photoCheckbox);

    $buddypress = new BuddypressSettingsPage($I);
    $buddypress->gotoActivityPage($I,ConstantsPage::$userName);

    $uploadmedia = new UploadMediaPage($I);
    $uploadmedia->uploadMediaFromActivity($I,ConstantsPage::$imageName);

    $I->seeInSource('<li class="rtmedia-list-item media-type-photo">');
    echo nl2br("Photo is uploaded.. \n");

?>