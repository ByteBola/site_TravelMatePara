<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Report.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ReportDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$reportDao = new ReportDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

$userData = $userDao->verifyToken();

if ($type === "create") {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    $report = new Report();

    if (!empty($title) && !empty($description) && !empty($category)) {
        $report->title = $title;
        $report->description = $description;
        $report->trailer = $trailer;
        $report->category = $category;
        $report->length = $length;
        $report->users_id = $userData->id;

        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {
                $imageFile = in_array($image["type"], $jpgArray) ? imagecreatefromjpeg($image["tmp_name"]) : imagecreatefrompng($image["tmp_name"]);
                $imageName = $report->imageGenerateName();
                imagejpeg($imageFile, "./img/reports/" . $imageName, 100);
                $report->image = $imageName;
            } else {
                $message->setMessage("Tipo inválido de imagem!", "error", "back");
            }
        }
        $reportDao->create($report);
    } else {
        $message->setMessage("Adicione título, descrição e categoria!", "error", "back");
    }
} elseif ($type === "delete") {
    $id = filter_input(INPUT_POST, "id");
    $report = $reportDao->findById($id);

    if ($report && $report->users_id === $userData->id) {
        $reportDao->destroy($id);
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} elseif ($type === "update") {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    $report = $reportDao->findById($id);

    if ($report && $report->users_id === $userData->id) {
        if (!empty($title) && !empty($description) && !empty($category)) {
            $report->title = $title;
            $report->description = $description;
            $report->trailer = $trailer;
            $report->category = $category;
            $report->length = $length;

            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                if (in_array($image["type"], $imageTypes)) {
                    $imageFile = in_array($image["type"], $jpgArray) ? imagecreatefromjpeg($image["tmp_name"]) : imagecreatefrompng($image["tmp_name"]);
                    $imageName = $report->imageGenerateName();
                    imagejpeg($imageFile, "./img/reports/" . $imageName, 100);
                    $report->image = $imageName;
                } else {
                    $message->setMessage("Tipo inválido de imagem!", "error", "back");
                }
            }
            $reportDao->update($report);
        } else {
            $message->setMessage("Adicione título, descrição e categoria!", "error", "back");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
