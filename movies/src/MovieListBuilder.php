<?php

namespace Drupal\movies;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

class MovieListBuilder extends EntityListBuilder {

  /**
   * Builds the header for the movies table.
   */
  public function buildHeader() {
    $header = [];

    $header['title'] = $this->t('Title');
    $header['release_date'] = $this->t('Release date');
    $header['rating'] = $this->t('Rating');

    return $header + parent::buildHeader();
  }

  /**
   * Builds each row for the movies table.
   */
  public function buildRow(EntityInterface $entity) {
    $row = [];

    $row['title'] = $entity->label();
    $row['release_date'] = $entity->getReleaseDate();
    $row['rating'] = $entity->getRating();

    return $row + parent::buildRow($entity);
  }
}
