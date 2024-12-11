<?php

namespace EndorphineBednyy;

use BitrixMainLoader;
use BitrixSaleOrder;

class EventHandler
{
    public static function onOrderSave(BitrixMainEvent $event)
    {
        Loader::includeModule("sale");

        /** @var Order $order */
        $order = $event->getParameter("ENTITY");
        if (!$order instanceof Order) {
            return;
        }

        // Получаем значение свойства с адресом
        $propertyCollection = $order->getPropertyCollection();
        $addressProperty = $propertyCollection->getItemByOrderPropertyCode("ADDRESS");
        if (!$addressProperty) {
            return;
        }
        $address = $addressProperty->getValue();

        // Обрабатываем адрес через DaData API
        $dadataApi = new DadataApi();
        $parsedAddress = $dadataApi->parseAddress($address);

        // Записываем результат в служебные свойства заказа
        if ($parsedAddress) {
            foreach ($parsedAddress as $code => $value) {
                $property = $propertyCollection->getItemByOrderPropertyCode($code);
                if ($property) {
                    $property->setValue($value);
                }
            }
        }
    }
}
