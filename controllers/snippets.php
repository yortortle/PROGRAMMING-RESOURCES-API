<?php

$dbcon = pg_connect("host=localhost dbname=resources");
header('Content-Type: application/json');

include_once __DIR__ . '/../models/snippet.php';

if($_REQUEST['action'] === 'index'){
  echo json_encode(Snippets::all());
} else if ($_REQUEST['action'] === 'post') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_snippet = new Snippet(null, $body_object->title, $body_object->description);
  $all_snippets = Snippets::create($new_snippet);
  echo json_encode($all_snippets);
} else if ($_REQUEST['action'] === 'update') {
  // echo "hello";
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_snippet = new Snippet($_REQUEST['id'], $body_object->title, $body_object->description);
  $all_snippets = Snippets::update($updated_snippet);

  echo json_encode($all_snippets);
} else if ($_REQUEST['action'] === 'delete') {
  $all_snippets = Snippets::delete($_REQUEST['id']);
  echo json_encode($all_snippets);
  }
?>
