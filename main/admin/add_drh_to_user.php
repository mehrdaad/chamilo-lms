<?php
/* For licensing terms, see /license.txt */
use Chamilo\UserBundle\Entity\User,
    Chamilo\CoreBundle\Entity\UserRelUser;

$cidReset = true;

require_once __DIR__.'/../inc/global.inc.php';

api_protect_admin_script();

if (!isset($_REQUEST['u'])) {
    api_not_allowed(true);
}

$em = Database::getManager();
$relationsRepo = $em->getRepository('ChamiloCoreBundle:UserRelUser');
/** @var User $user */
$user = UserManager::getManager()->find($_REQUEST['u']);

if (!$user) {
    api_not_allowed(true);
}

$subscribedUsers = $user->getHrm();

$hrmOptions = [];

/** @var UserRelUser $subscribedUser */
foreach ($subscribedUsers as $subscribedUser) {
    /** @var User $hrm */
    $hrm = UserManager::getManager()->find($subscribedUser->getFriendUserId());

    if (!$hrm) {
        continue;
    }

    $hrmOptions[$hrm->getId()] = $hrm->getCompleteNameWithUsername();
}

$form = new FormValidator('assign_hrm');
$form->addUserAvatar('u', get_lang('User'), 'medium');
$form->addSelectAjax(
    'hrm',
    get_lang('HrmList'),
    $hrmOptions,
    ['multiple' => 'multiple', 'url' => api_get_path(WEB_AJAX_PATH).'user_manager.ajax.php?a=user_by_role']
);
$form->addButtonSave(get_lang('Send'));
$form->setDefaults([
    'u' => $user,
    'hrm' => array_keys($hrmOptions)
]);

if ($form->validate()) {
    /** @var UserRelUser $subscribedUser */
    foreach ($subscribedUsers as $subscribedUser) {
        $em->remove($subscribedUser);
    };

    $em->flush();

    $values = $form->exportValues();

    foreach ($values['hrm'] as $hrmId) {
        /** @var User $hrm */
        $hrm = UserManager::getManager()->find($hrmId);

        if (!$hrm) {
            continue;
        }

        if ($hrm->getStatus() !== DRH) {
            continue;
        }

        UserManager::subscribeUsersToHRManager($hrm->getId(), [$user->getId()], false);
    }

    Display::addFlash(
        Display::return_message(get_lang('AssignedUsersHaveBeenUpdatedSuccessfully'), 'success')
    );

    header('Location: '.api_get_path(WEB_CODE_PATH).'admin/user_information.php?user_id='.$user->getId());
    exit;
}

$interbreadcrumb[] = ['name' => get_lang('PlatformAdmin'), 'url' => 'index.php'];
$interbreadcrumb[] = ['name' => get_lang('UserList'), 'url' => 'user_list.php'];
$interbreadcrumb[] = ['name' => $user->getCompleteName(), 'url' => 'user_information.php?user_id='.$user->getId()];

$toolName = get_lang('AssignHrmToUser');

$view = new Template($toolName);
$view->assign('header', $toolName);
$view->assign('content', $form->returnForm());
$view->display_one_col_template();
