<?php

namespace App\Models;

use App\Models\BaseModel;
use \PDO;

class CourseEnrolment extends BaseModel
{
    public function enroll($course_code, $student_code, $enrollment_date)
    {
        $sql = "INSERT INTO course_enrolments (course_code, student_code, enrolment_date) VALUES (:course_code, :student_code, :enrollment_date)";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'course_code' => $course_code,
            'student_code' => $student_code,
            'enrollment_date' => $enrollment_date
        ]);
    }
}
