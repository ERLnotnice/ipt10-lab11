<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\CourseEnrolment;
use App\Models\Student;
use App\Controllers\BaseController;

class EnrolmentController extends BaseController
{
    public function enrollmentForm()
    {
        $courseObj = new Course();
        $studentObj = new Student();

        $template = 'enrollment-form';
        $data = [
            'courses' => $courseObj->all(),
            'students' => $studentObj->all()
        ];

        $output = $this->render($template, $data);
        return $output;
    }

    public function enroll()
    {
        // Retrieve form data
        $course_code = $_POST['course_code'];
        $student_code = $_POST['student_code'];
        $enrollment_date = $_POST['enrollment_date'];

        // Create an instance of CourseEnrolment
        $courseEnrolmentObj = new CourseEnrolment();

        // Enroll the student in the course
        $courseEnrolmentObj->enroll($course_code, $student_code, $enrollment_date);

        // Redirect to the specific course page after enrollment
        header("Location: /courses/{$course_code}");
        exit(); // Ensure the script stops executing after the redirect
    }
}
