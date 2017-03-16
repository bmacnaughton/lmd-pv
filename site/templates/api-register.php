<?php

require_once './inc/ajax-request.php';

// set vars with the default output
$statuscode = 200;
$response = [];

$request = new ajax\Request(['ajax-only' => true]);

wire('log')->save('ajax', 'seeing a ' . $request->method());

if (!$request->is_good()) {
    return $request->echoResponse();
}

if (!$request->method('POST')) {
    return $request->echoErrorResponse(400, ['error' => 'invalid method ' . $request->method()]);
}

return $request->echoResponse(['status' => 'wonderful']);

if ($request->method('GET')) {
  $root = $pages->get("/");
  $p = null;
  $urlSegmentsLength = count($input->urlSegments());

  if ($urlSegmentsLength) {
    $segments = implode($input->urlSegments(), '/');
    $p = $pages->get('/'.$segments.'/');
  } else {
    // get home if there are no segments
    $p = $pages->get('/');
  }

  if ($p->id) {
    // page exist, get fields
    $pageFields = new PageFields($p, [
      'queries' => $input->get->getArray(),
      'fld_include_all' => false
    ]);

    // enable debug mode
    if ($input->get('debug') && $config->debug) return;

    $response = $pageFields->getPageFields($p);
    return $request->echoResponse($response);
  } else {
    // page does not exist
    return $request->echoErrorResponse(404, ['error' => 'Page not found']);
  }
} else {
  // Not a get request
  $response['error'] = 'Wrong request';
  $statuscode = 404; // Not Found (see /site/templates/inc/Rest.php)
  return $request->echoErrorResponse(400, ['error' => 'Invalid request method']);
}
