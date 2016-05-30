<?php

namespace Drupal\movies\Plugin\Block;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\movies\Entity\Movie;

/**
 * Provides a 'Popular Movies' Block
 *
 * @Block(
 *   id = "movies_popular_movies_block",
 *   admin_label = @Translation("Popular Movies"),
 * )
 */
class PopularMoviesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Setup the base build with cache tags.
    $build = [
      '#cache' => [
        'tags' => ['movie_list'],
      ],
    ];

    // Create a cacheable metadata object from the current build.
    $cacheability = CacheableMetadata::createFromRenderArray($build);

    // We want to list the movies.
    $build['movies'] = [
      '#theme' => 'item_list',
      '#items' => [],
    ];

    // Add each movie to the list and include both a rating and a label.
    foreach ($this->getPopularMovies() as $movie) {

      // The FormattableMarkup class lets us format the string.
      $text = new FormattableMarkup('@movie (@rating)', [
        '@movie' => $movie->label(),
        '@rating' => $movie->getRating(),
      ]);

      // Add the movie to the #items array as a link.
      $build['movies']['#items'][] = Link::fromTextAndUrl($text, $movie->toUrl());

      // Add the movie as a cacheable dependency.
      $cacheability->addCacheableDependency($movie);
    }

    // Add a link so users can view all movies.
    $build['view_more'] = [
      '#type' => 'more_link',
      '#title' => $this->t('View all movies'),
      '#url' => Url::fromRoute('entity.movie.collection'),
    ];

    // Apply the cache settings to the build.
    $cacheability->applyTo($build);

    return $build;
  }

  /**
   * Get popular movies by performing a query that sorts movies on rating and
   * gets the 5 highest rated movies.
   *
   * @return Movie[]
   */
  public function getPopularMovies() {
    // First perform the quert to get the entity ids.
    $ids = \Drupal::entityQuery('movie')
      ->sort('rating', 'DESC')
      ->range(0, 5)
      ->execute();

    // Then load the entities we found with the entity type manager.
    return \Drupal::entityTypeManager()
      ->getStorage('movie')
      ->loadMultiple($ids);
  }
}
