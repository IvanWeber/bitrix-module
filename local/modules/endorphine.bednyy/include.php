<?php

use BitrixMainEventManager;
use EndorphineBednyyEventHandler;

EventManager::getInstance()->addEventHandler(
    "sale",
    "OnSaleOrderSaved",
    [EventHandler::class, "onOrderSave"]
);
