<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Model;

use Razoyo\CarProfile\Api\Data\CarSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Car search results.
 */
class CarSearchResults extends SearchResults implements CarSearchResultsInterface
{
}
