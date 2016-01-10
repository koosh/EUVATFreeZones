<?php

namespace koosh\VATUtility;

class EUVATFreeZoneTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEUVATFreeZone()
    {
        // The Aland Islands in Finland.
        // Based on just ISO.
        $this->assertTrue(EUVATFreeZone::isEUTaxFreeZone('AX', 12345));

        // Based on ISO and zip.
        $this->assertTrue(EUVATFreeZone::isEUTaxFreeZone('FI', 22100));

        // Helsinki in Finland.
        // Based on just ISO.
        $this->assertFalse(EUVATFreeZone::isEUTaxFreeZone('FI', 12345));
        // Based on ISO and zip.
        $this->assertFalse(EUVATFreeZone::isEUTaxFreeZone('FI', '00100'));
    }
}
