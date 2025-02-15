<?php 
class Course {
    private $conn;
    private $table_name = "courses";
    public $id;
    public $title;
    public $description;
    public $course_manager_name;
    public $rating;
    public $date;
    public $location;
    public $image;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function findCourse($id) {
        $query = "SELECT * FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll() {
        $query = "SELECT * FROM courses";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCourse($id) {
        $query = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function updateCourse() {
        $query = "UPDATE courses SET title = ?, description = ?, course_manager_name = ?, rating = ?, date = ?, location = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->title, $this->description, $this->course_manager_name, $this->rating, $this->date, $this->location, $this->image, $this->id]);
    }}?>