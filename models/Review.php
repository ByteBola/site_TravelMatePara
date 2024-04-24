<?php

  class Review {

    public $id;
    public $rating;
    public $review;
    public $users_id;
    public $reports_id;

  }

  interface ReviewDAOInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getReportsReview($id);
    public function hasAlreadyReviewed($id, $userId);
    public function getRatings($id);

  }