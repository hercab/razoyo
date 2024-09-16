<?php declare(strict_types=1);

namespace Razoyo\CarProfile\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class CarProfile implements ArgumentInterface
{
    /**
     * Get Config
     *
     * @param \Magento\Framework\View\Element\Template $block
     * @return array
     */
    public function getConfig($block): array
    {
        $config = ['url' => '/rest/V1/cars/'];
        $car = $block->getData('car');
        if ($car) {
            $config['car'] = $car->getData();
        }
        return $config;
    }
}
