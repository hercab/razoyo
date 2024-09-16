<?php declare(strict_types=1);

namespace Razoyo\CarProfile\Api\Data;

/**
 * Interface for Car search results.
 * @api
 * @since 1.0.0
 */
interface CarSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Car list.
     *
     * @return \Razoyo\CarProfile\Api\Data\CarInterface[]
     */
    public function getItems();

    /**
     * Set Car list.
     *
     * @param \Razoyo\CarProfile\Api\Data\CarInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
