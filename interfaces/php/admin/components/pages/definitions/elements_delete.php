<?php
// add unique page settings:
$page_title = 'Elements: Delete Element';
$page_tips = 'None yet.';

if (!$request_parameters) {
	header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
}

$page_request = new CASHRequest(
	array(
		'cash_request_type' => 'element', 
		'cash_action' => 'getelement',
		'element_id' => $request_parameters[0]
	)
);

if ($page_request->response['status_uid'] == 'element_getelement_200') {
	
	$elements_data = getElementsData();
	$effective_user = getPersistentData('cash_effective_user');
	
	if ($page_request->response['payload']['user_id'] == $effective_user) {
		if (isset($_POST['doelementdelete'])) {
			$element_delete_request = new CASHRequest(
				array(
					'cash_request_type' => 'element', 
					'cash_action' => 'deleteelement',
					'element_id' => $request_parameters[0]
				)
			);
			if ($element_delete_request->response['status_uid'] == 'element_deleteelement_200') {
				header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
			}
		}
		$page_title = 'Elements: Delete “' . $page_request->response['payload']['name'] . '”';
	} else {
		header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
	}
} else {
	header('Location: ' . ADMIN_WWW_BASE_PATH . '/elements/view/');
}
?>