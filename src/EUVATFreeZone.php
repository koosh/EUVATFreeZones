<?php

namespace koosh\VATUtility;

/**
 * Simple check for areas in the European Union where VAT is not applicable
 * when charging from inside the EU.
 *
 * Class EUVATFreeZone
 * @package koosh\VATUtility
 */
class EUVATFreeZone
{
    /**
     * ISO 3166-2 list of EU countries with tax free zones.
     *
     * @var array
     */
    public static $EUCountriesWithTaxFreeZones = array(
        'GR',
        'ES',
        'FR',
        'DE',
        'FI',
        'IT',
    );

    /**
     * ISO 3166-2 list of EU regions (not countries) with tax free zones.
     *
     * @var array
     */
    public static $EUTaxFreeZones = array(
        'RE',
        'GP',
        'MQ',
        'PF',
        'GF',
        'YT',
        'NC',
        'PM',
        'WF',
        'BL',
        'MF',
        'JE',
        'GG',
        'IM',
        'AX',
    );

    /**
     * Check using the ISO and the zip/postal code if the region is
     * is a tax free zone in the EU.
     *
     * @param $iso  string  ISO 3166-2 code for the county or region
     * @param $zip  string  Zip/postal code
     * @return bool
     */
    public static function isEUTaxFreeZone($iso, $zip)
    {
        if (in_array($iso, self::$EUTaxFreeZones)) {
            // Tax free region from ISO.
            return true;
        }

        if (!in_array($iso, self::$EUCountriesWithTaxFreeZones)) {
            // Not applicable.
            return false;
        }

        $zip = trim(str_replace(' ', '', $zip));

        if ($iso == 'ES') {
            $part = substr($zip, 0, 2);
            // Canary Islands.
            if ($part == '35') {
                return true;
            }
            // Tenerife
            if ($part == '38') {
                return true;
            }
            // Ceuta.
            if ($part == '51') {
                return true;
            }
            // Mellila.
            if ($part == '52') {
                return true;
            }
        } elseif ($iso == 'GB') {
            $part = strtoupper(substr($zip, 0, 2));
            if ($part == 'GY') {
                // Guernsey.
                return true;
            } elseif ($part == 'JE') {
                // Jersey.
                return true;
            } elseif ($part == 'IM') {
                // Isle of Man.
                return true;
            }
        } elseif ($iso == 'FI') {
            // Aland islands.
            if (22100 <= $zip && $zip <= 22999) {
                return true;
            }
        } elseif ($iso == 'IT') {
            // Livigno 23030.
            // Campione d'Italia 22060.
            if (in_array($zip, array(23030, 22060))) {
                return true;
            }
        } elseif ($iso == 'DE') {
            // Heligoland 27498.
            // Büsingen 78266.
            if (in_array($zip, array(27498, 78266))) {
                return true;
            }
        } elseif ($iso == 'GR') {
            // Mount Athos 630 87, 630 86
            if (in_array($zip, array(63087, 63086))) {
                return true;
            }
        } elseif ($iso == 'FR') {
            if ($zip == '97133') {
                // Saint-Barthélemy.
                return true;
            }
            if ($zip == '97150') {
                // Saint-Martin.
                return true;
            }
            $list = array(
                '974', // Reunion.
                '975', // Saint Pierre and Miquelon.
                '973', // French Guiana.
                '971', // Guadeloupe.
                '972', // Martinique.
                '976', // Mayotte.
                '977', // Saint-Barthélemy.
                '978', // Saint-Martin.
                '987', // French Polynesia.
                '988', // New Caledonia.
                '986', // Wallis and Futuna.
            );
            if (in_array(substr($zip, 0, 3), $list)) {
                return true;
            }

            if (substr($zip, 0, 2) == 'WF') {
                // Wallis and Futuna.
                return true;
            }
        }

        return false;
    }
}