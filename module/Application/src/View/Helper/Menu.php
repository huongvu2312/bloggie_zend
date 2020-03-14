<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * This view helper class displays a menu bar.
 */
class Menu extends AbstractHelper
{
    /**
     * Menu items array.
     * @var array 
     */
    protected $items = [];

    /**
     * Active item's ID.
     * @var string  
     */
    protected $activeItemId = '';

    /**
     * Constructor.
     * @param array $items Menu items.
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * Sets menu items.
     * @param array $items Menu items.
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * Sets ID of the active items.
     * @param string $activeItemId
     */
    public function setActiveItemId($activeItemId)
    {
        $this->activeItemId = $activeItemId;
    }

    /**
     * Renders the menu.
     * @return string HTML code of the menu.
     */
    public function render()
    {
        if (count($this->items) == 0)
            return ''; // Do nothing if there are no items.

        $result = '<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">';
        $result .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';

        // Render items
        foreach ($this->items as $item) {
            if ($item['side'] == 'left') {
                $result .= '<ul class="navbar-nav">';
                foreach ($item as $link) {
                    $result .= $this->renderItem($link);
                }
                $result .= '</ul>';
            } else if ($item['side'] == 'right') {
                $result .= '<ul class="navbar-nav ml-auto">';
                foreach ($item as $link) {
                    $result .= $this->renderItem($link);
                }
                $result .= '</ul>';
            }
        }

        $result .= '</div>';
        $result .= '</nav>';

        return $result;
    }

    /**
     * Renders an item.
     * @param array $item The menu item info.
     * @return string HTML code of the item.
     */
    protected function renderItem($item)
    {
        $id = isset($item['id']) ? $item['id'] : '';
        $isActive = ($id == $this->activeItemId);
        $label = isset($item['label']) ? $item['label'] : '';
        $result = '';

        $escapeHtml = $this->getView()->plugin('escapeHtml');

        if (isset($item['dropdown'])) {
            $dropdownItems = $item['dropdown'];

            $result .= '<li class="nav-item dropdown' . ($isActive ? ' active' : '') . '">';
            $result .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $result .= $escapeHtml($label);
            $result .= '</a>';

            $result .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
            foreach ($dropdownItems as $item) {
                $link = isset($item['link']) ? $item['link'] : '#';
                $label = isset($item['label']) ? $item['label'] : '';

                $result .= '<a class="dropdown-item" href="' . $escapeHtml($link) . '">' . $escapeHtml($label) . '</a>';
            }
            $result .= '</div>';
            $result .= '</li>';
        } else {
            $link = isset($item['link']) ? $item['link'] : '#';

            $result .= $isActive ? '<li class="active">' : '<li>';
            $result .= '<a class="nav-link" href="' . $escapeHtml($link) . '">' . $escapeHtml($label) . '</a>';
            $result .= '</li>';
        }

        return $result;
    }
}
