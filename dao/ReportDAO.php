<?php

require_once("models/Report.php");
require_once("models/Message.php");

// Review DAO
require_once("dao/ReviewDAO.php");

class ReportDao implements ReportDAOInterface
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

        // Recebe as ratings do Relato
        $reviewDao = new ReviewDao($this->conn, $this->url);

        $rating = $reviewDao->getRatings($report->id);

        $report->rating = $rating;


        return $report;
    }

    public function findAll()
    {
    }

    public function getLatestReport()
    {
        $reports = [];
        $stmt = $this->conn->query("SELECT * FROM reports ORDER BY id DESC");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reportsArray = $stmt->fetchAll();
            foreach ($reportsArray as $report) {
                $reports[] = $this->buildReport($report);
            }
        }

        return $reports;
    }

    public function getReportsByCategory($category)
    {
        $reports = [];
        $stmt = $this->conn->prepare("SELECT * FROM reports WHERE category = :category ORDER BY id DESC");
        $stmt->bindParam(":category", $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reportsArray = $stmt->fetchAll();
            foreach ($reportsArray as $report) {
                $reports[] = $this->buildReport($report);
            }
        }

        return $reports;
    }

    public function getReportByUserId($id)
    {
        $reports = [];
        $stmt = $this->conn->prepare("SELECT * FROM reports WHERE users_id = :users_id");
        $stmt->bindParam(":users_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reportsArray = $stmt->fetchAll();
            foreach ($reportsArray as $report) {
                $reports[] = $this->buildReport($report);
            }
        }

        return $reports;
    }

    public function findById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM reports WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reportData = $stmt->fetch();
            $report = $this->buildReport($reportData);
            return $report;
        } else {
            return false;
        }
    }

    public function findByTitle($title)
    {
        $reports = [];
        $stmt = $this->conn->prepare("SELECT * FROM reports WHERE title LIKE :title");
        $stmt->bindValue(":title", '%' . $title . '%');
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reportsArray = $stmt->fetchAll();
            foreach ($reportsArray as $report) {
                $reports[] = $this->buildReport($report);
            }
        }

        return $reports;
    }

    public function create(Report $report)
    {
        $stmt = $this->conn->prepare("INSERT INTO reports (title, description, image, trailer, category, length, users_id) VALUES (:title, :description, :image, :trailer, :category, :length, :users_id)");
        $stmt->bindParam(":title", $report->title);
        $stmt->bindParam(":description", $report->description);
        $stmt->bindParam(":image", $report->image);
        $stmt->bindParam(":trailer", $report->trailer);
        $stmt->bindParam(":category", $report->category);
        $stmt->bindParam(":length", $report->length);
        $stmt->bindParam(":users_id", $report->users_id);
        $stmt->execute();
        $this->message->setMessage("Relatório adicionado com sucesso!", "success", "index.php");
    }

    public function update(Report $report)
    {
        $stmt = $this->conn->prepare("UPDATE reports SET title = :title, description = :description, image = :image, category = :category, trailer = :trailer, length = :length WHERE id = :id");
        $stmt->bindParam(":title", $report->title);
        $stmt->bindParam(":description", $report->description);
        $stmt->bindParam(":image", $report->image);
        $stmt->bindParam(":category", $report->category);
        $stmt->bindParam(":trailer", $report->trailer);
        $stmt->bindParam(":length", $report->length);
        $stmt->bindParam(":id", $report->id);
        $stmt->execute();
        $this->message->setMessage("Relatório atualizado com sucesso!", "success", "dashboard.php");
    }

    public function destroy($id) {
        // Primeiro, remova referências associadas na tabela `reviews`
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE reports_id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        // Agora é seguro excluir a linha na tabela `reports`
        $stmt = $this->conn->prepare("DELETE FROM reports WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        $this->message->setMessage("Relatório removido com sucesso!", "success", "dashboard.php");
    }
    
}
