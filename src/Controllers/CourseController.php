<?php

namespace App\Controllers;

use App\Models\Course;
use App\Controllers\BaseController;
use Fpdf\Fpdf;

class CourseController extends BaseController
{
    public function list()
    {
        $obj = new Course();
        $courses = $obj->all();

        $template = 'courses';
        $data = [
            'items' => $courses
        ];

        return $this->render($template, $data);
    }

    public function viewCourse($course_code)
    {
        $courseObj = new Course();
        $course = $courseObj->find($course_code);
        $enrollees = $courseObj->getEnrollees($course_code);

        $template = 'single-course';
        $data = [
            'course' => $course,
            'enrollees' => $enrollees
        ];

        return $this->render($template, $data);
    }

    public function exportCourseEnrollees($course_code)
{
    // Clear output buffer to prevent any previous output
    ob_end_clean();

    // Fetch course data using course code
    $courseObj = new Course();
    $course = $courseObj->find($course_code);
    if (!$course) {
        die('Course not found'); // Handle case where course is not found
    }

    // Fetch list of enrollees for the course
    $enrollees = $courseObj->getEnrollees($course_code);

    // Create PDF using FPDF
    require_once __DIR__ . '/../../vendor/autoload.php'; // Include Composer's autoloader

    $pdf = new \FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Course information
    $pdf->Cell(0, 10, 'Course Information', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Course Code: ' . $course->course_code, 0, 1);
    $pdf->Cell(0, 10, 'Course Name: ' . $course->course_name, 0, 1); // Use course_name
    $pdf->Cell(0, 10, 'Description: ' . $course->description, 0, 1);
    $pdf->Cell(0, 10, 'Credits: ' . $course->credits, 0, 1);
    $pdf->Ln(10);

    // Enrollees list
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Enrollees', 0, 1);
    $pdf->SetFont('Arial', '', 12);

    foreach ($enrollees as $enrollee) {
        $pdf->Cell(0, 10, 'Name: ' . $enrollee['student_name'], 0, 1); // Assuming this is the correct field
        // Add any other fields for the enrollee here
    }

    // Output the PDF to the browser
    $pdf->Output('D', 'Course_Enrollees_' . $course_code . '.pdf'); // D for download
}

}
