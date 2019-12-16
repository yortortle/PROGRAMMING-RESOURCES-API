<?php

Class Snippet {
    public $id;
    public $title;
    public $description;

    public function __construct($id, $title, $description) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }
}

Class Snippets {
  static function all(){

      //create an empty array
      $snippets = array();

      //query the database
      $results = pg_query("SELECT * FROM snippets");


      $row_object = pg_fetch_object($results);
      // var_dump($row_object);
      // print_r($row_object->id);
      // var_dump($row_object);

      while($row_object){
          $new_snippet = new Snippet(
            $row_object->id,
            $row_object->title,
            $row_object->description
          );

      $snippets[] = $new_snippet; //push stuff onto array

      $row_object = pg_fetch_object($results);
      }

      return $snippets;
  }

  static function create($snippet){
    $query = "INSERT INTO snippets ( title, description ) VALUES ($1, $2)";
    $query_params = array($snippet->title, $snippet->description);
    pg_query_params($query, $query_params);

    return self::all();
  }

  static function update($updated_snippet){
    // echo "update in progress <br />";
    // var_dump($updated_snippet);
    $query = "UPDATE snippets SET title = $1, description = $2 WHERE id = $3";
    $query_params = array($updated_snippet->title, $updated_snippet->description, $updated_snippet->id);
    $result = pg_query_params($query, $query_params);

    return self::all();
  }

  static function delete($id){
    $query = "DELETE FROM snippets WHERE id = $1";
    $query_params = array($id);
    $result = pg_query_params($query, $query_params);

    return self::all();
  }

}

?>
