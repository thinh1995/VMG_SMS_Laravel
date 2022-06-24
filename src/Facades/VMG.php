<?php

namespace Lucifer\VmgSmsLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the VMG facade class.
 *
 * @author Thinh Nguyen <cuongthinhtuan2006@gmail.com>
 *
 * @method static array sendSMS(string $token, array $data) Send SMS to customer.
 */
class VMG extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'vmg';
    }
}