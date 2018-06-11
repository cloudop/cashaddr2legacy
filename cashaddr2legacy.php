<?php
require_once('./vendor/autoload.php');
use CashAddr\CashAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Buffertools\Buffer;
use BitWasp\Bitcoin\Base58;

function cashaddr2legacy($cashaddr)
{
    $cashaddr = 'bitcoincash:'. $cashaddr;
    $pubkeyHash = CashAddress::decode($cashaddr);
    $network = Bitcoin::getNetwork();
    $prefixByte = pack("H*", $network->getAddressByte());
    $payload = new Buffer($prefixByte. $pubkeyHash[2]);
    $address = Base58::encodeCheck($payload);
    return $address;
}
