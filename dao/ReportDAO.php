<?php

require_once("models/Report.php");
require_once("models/Message.php");

// Review DAO
require_once("dao/ReviewDAO.php");

class ReportDAO implements ReportDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildReport($data)
    {
        $report = new Report();

        $report->id = $data["id"];
        $report->title = $data["title"];
        $report->description = $data["description"];
        $report->image = $data["image"];
        $report->trailer = $data["trailer"];
        $report->category = $data["category"];
        $report->length = $data["length"];
        $report->users_id = $data["users_id"];

        

        return $report;
    }
    public function findAll()
    {
    }
    public function getLatestReport()
    {
    }
    public function getMoviesByReport($category)
    {
    }
    public function getReportByUserId($id)
    {
    }
    public function findById($id)
    {
    }
    public function findByTitle($title)
    {
    }
    public function create(Report $movie)
    {
    }
    public function update(Report $movie)
    {
    }
    public function destroy($id)
    {
    }
}
