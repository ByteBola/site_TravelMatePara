<?php

  class Report {

    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $length;
    public $users_id;

    public function imageGenerateName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  interface ReportDAOInterface {

    public function buildReport($data);
    public function findAll();
    public function getLatestReport();
    public function getReportsByCategory($category);
    public function getReportByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(Report $report);
    public function update(Report $report);
    public function destroy($id);

  }