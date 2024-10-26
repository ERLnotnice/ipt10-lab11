<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class Student extends BaseModel
{
    // Method to retrieve all students
    public function all()
    {
        // SQL query to select all records from the 'students' table
        $sql = "SELECT * FROM students";

        // Prepare the SQL query
        $statement = $this->db->prepare($sql);

        // Execute the query
        $statement->execute();

        // Fetch all results as instances of the Student class
        $result = $statement->fetchAll(PDO::FETCH_CLASS, '\App\Models\Student');

        // Return the result
        return $result;
    }
}
