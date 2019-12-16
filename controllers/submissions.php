<?php

$dbcon = pg_connect("host=localhost dbname=resources");
header('Content-Type: application/json');

include_once __DIR__ . '/../models/submission.php';

if($_REQUEST['action'] === 'index'){
  echo json_encode(Submissions::all());
} else if ($_REQUEST['action'] === 'post') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_submission = new Submission(null, $body_object->title, $body_object->tool, $body_object->description, $body_object->url, $body_object->cost);
  $all_submissions = Submissions::create($new_submission);
  echo json_encode($all_submissions);
} else if ($_REQUEST['action'] === 'update') {
  // echo "hello";
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_submission = new Submission($_REQUEST['id'], $body_object->title, $body_object->tool, $body_object->description, $body_object->url, $body_object->cost);
  $all_submissions = Submissions::update($updated_submission);

  echo json_encode($all_submissions);
} else if ($_REQUEST['action'] === 'delete') {
  $all_submissions = Submissions::delete($_REQUEST['id']);
  echo json_encode($all_submissions);
  }
?>
