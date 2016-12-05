<?php

namespace Hochstrasser\Wirecard\Model\Common;

use Hochstrasser\Wirecard\Model\Model;

class Basket extends Model
{
    private $items = [];

    /**
     * Sets total amount of shopping basket
     *
     * @param float $amount
     * @return Basket
     */
    function setAmount($amount)
    {
        return $this->addParam('amount', $amount);
    }

    /**
     * Returns total amount of shopping basket
     *
     * @return float
     */
    function getAmount()
    {
        return $this->getParam('amount');
    }

    /**
     * Sets currency as ISO code or numeric identifier
     *
     * @param string|int $currency
     * @return Basket
     */
    function setCurrency($currency)
    {
        return $this->addParam('currency', $currency);
    }

    /**
     * Returns the currency as ISO code or numeric identifier
     *
     * @returns string|int
     */
    function getCurrency()
    {
        return $this->getParam('currency');
    }

    /**
     * Adds an item to the basket
     *
     * @param BasketItem $item
     * @return Basket
     */
    function addItem(BasketItem $item)
    {
        $basketItems = $this->getParam('basketItems') ?: 0;
        $basketItems++;

        $this->items[$basketItems] = $item;
        $this->addParam('basketItems', $basketItems);

        foreach ($item->toArray() as $param => $value) {
            $this->addParam('basketItem'.$basketItems.ucfirst($param), $value);
        }

        return $this;
    }

    /**
     * Returns a list of added BasketItem objects
     *
     * @return array
     */
    function getItems()
    {
        return $this->items;
    }
}
