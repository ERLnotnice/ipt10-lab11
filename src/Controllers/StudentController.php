<?php

namespace App\Controllers;

use App\Models\Student;
use App\Controllers\BaseController;

class StudentController extends BaseController
{
    // Method to handle the request for listing all students
    public function list()
    {
        // Create an instance of the Student model
        $obj = new Student();

        // Fetch all students from the model
        $students = $obj->all();

        // Define the template name
        $template = 'students';

        // Prepare the data to pass to the template
        $data = [
            'items' => $students // Pass the list of students to the view
        ];

        // Render the template with the data
        $output = $this->render($template, $data);

        // Return the rendered output
        return $output;
    }
}
