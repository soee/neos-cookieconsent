<?php
namespace Soee\CookieConsent\DataSource;

use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\I18n\EelHelper\TranslationHelper;

/**
 * Class PaletteDataSource
 * @package Soee\Bootstrap\DataSource
 */
class PaletteDataSource extends AbstractDataSource
{
    /**
     * @var string
     */
    static protected $identifier = 'soee-cookieconsent-palettes';

    /**
     * @var array
     */
    protected $settings;

    /**
     * Soee.Bootstrap settings
     *
     * @param array $settings
     */
    public function injectSettings(array $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Get data
     *
     * @param NodeInterface $node The node that is currently edited (optional)
     * @param array $arguments Additional arguments (key / value)
     * @return array JSON serializable data
     */
    public function getData(NodeInterface $node = null, array $arguments)
    {
        if (!is_array($this->settings['palettes']) || empty($this->settings['palettes'])) {
            return [];
        }

        $data = [];
        $translationHelper = new TranslationHelper();

        foreach($this->settings['palettes'] as $paletteKey => $paletteConfiguration) {
            $data[] = ['value' => $paletteKey, 'label' => $translationHelper->translate($paletteConfiguration['label'])];
        }

        return $data;
    }
}
