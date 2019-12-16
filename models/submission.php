<?php

Class Submission {
    public $id;
    public $title;
    public $tool;
    public $description;
    public $url;
    public $cost;

    public function __construct($id, $title, $tool, $description, $url, $cost) {
        $this->id = $id;
        $this->title = $title;
        $this->tool = $tool;
        $this->description = $description;
        $this->url = $url;
        $this->cost = $cost;
    }
}

Class Submissions {
  static function all(){

      //create an empty array
      $submissions = array();

      //query the database
      $results = pg_query("SELECT * FROM submissions");


      $row_object = pg_fetch_object($results);
      // var_dump($row_object);
      // print_r($row_object->id);
      // var_dump($row_object);

      while($row_object){
          $new_submission = new Submission(
            $row_object->id,
            $row_object->title,
            $row_object->tool,
            $row_object->description,
            $row_object->url,
            $row_object->cost
          );

      $submissions[] = $new_submission; //push stuff onto array

      $row_object = pg_fetch_object($results);
      }

      return $submissions;
  }

  static function create($submission){
    $query = "INSERT INTO submissions ( title, tool, description, url, cost ) VALUES ($1, $2, $3, $4, $5)";
    $query_params = array($submission->title, $submission->tool, $submission->description, $submission->url, $submission->cost);
    pg_query_params($query, $query_params);

    return self::all();
  }

  static function update($updated_submission){
    // echo "update in progress <br />";
    // var_dump($updated_submission);
    $query = "UPDATE submissions SET title = $1, tool = $2, description = $3, url = $4, cost = $5 WHERE id = $6";
    $query_params = array($updated_submission->title, $updated_submission->tool, $updated_submission->description, $updated_submission->url, $updated_submission->cost, $updated_submission->id);
    $result = pg_query_params($query, $query_params);

    return self::all();
  }

  static function delete($id){
    $query = "DELETE FROM submissions WHERE id = $1";
    $query_params = array($id);
    $result = pg_query_params($query, $query_params);

    return self::all();
  }

}

?>
