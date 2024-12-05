<?php

namespace Kevinfrom\EconomicApi\Data\Enums;

enum AccountType: string
{
    case profitAndLoss = 'profitAndLoss';
    case status = 'status';
    case totalFrom = 'totalFrom';
    case heading = 'heading';
    case headingStart = 'headingStart';
    case sumInterval = 'sumInterval';
    case sumAlpha = 'sumAlpha';
}
