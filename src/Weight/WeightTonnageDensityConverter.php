<?php
/**
 * TonneConverter.php
 *
 * @author: Dean Haines
 * @copyright: Dean Haines, 2018, UK
 * @license: GPL V3.0+ See LICENSE.md
 */

namespace vbpupil\Weight;

use Chippyash\Type\String\StringType;
use Exception;
use vbpupil\Cubic\CubicUnit;

/**
 * Class WeightTonnageDensityConverter
 */
class WeightTonnageDensityConverter
{
    /**
     * @var array
     */
    protected $density = array(
        'acetone' => 795,
        'acetylene' => 1.1709,
        'air' => 1.928,
        'alcohol' => 789,
        'ammonia' => 0.7714,
        'antifreeze' => 1112,
        'argon' => 1.7839,
        'asphalt' => 1100,
        'azote' => 1.251,
        'beer' => 1041,
        'brass' => 8500,
        'bronze' => 8600,
        'butter' => 920,
        'cadmium' => 8640,
        'caprolon' => 1150,
        'carbon_monoxide' => 1.25,
        'cast_iron' => 7300,
        'cement' => 2900,
        'chlorine_oxide' => 3.89,
        'chlorine' => 3.22,
        'clay' => 1750,
        'concrete' => 2400,
        'concrete_solution' => 2100,
        'copper' => 8900,
        'crushed_stone' => 1350,
        'diesel' => 860,
        'dioxide_of_chlorine' => 3.09,
        'ethane' => 1356,
        'ether' => 740,
        'fiberglass' => 1900,
        'fluorine' => 1695,
        'fluoroplast' => 1400,
        'garbage' => 250,
        'gasoline' => 750,
        'glass' => 2500,
        'glycerin' => 1260,
        'gold' => 19300,
        'gravel' => 1550,
        'ground' => 1800,
        'helium' => 0.1785,
        'hydrogen' => 0.08987,
        'ice' => 917,
        'indium' => 7300,
        'kerosene' => 810,
        'krypton' => 3.74,
        'lead' => 11400,
        'liquid_hydrogen' => 70,
        'mercury' => 13600,
        'methane' => 0.6682,
        'methyl_alcohol' => 810,
        'milk' => 1030,
        'neon' => 0.8999,
        'nitrous_oxide' => 1978,
        'nitrogen' => 1251,
        'nitrogen_fluoride' => 2.9,
        'nitric_oxide' => 1.3402,
        'oil' => 850,
        'olive_oil' => 920,
        'oxygen' => 1.429,
        'ozone' => 2.22,
        'paint' => 1300,
        'paladius' => 12160,
        'paper' => 950,
        'petrol' => 750,
        'phosphorous_fluoride' => 3907,
        'platinum' => 21450,
        'polyamide' => 1150,
        'polycarbonate' => 1200,
        'polyethylene' => 960,
        'polypropylene' => 900,
        'polystyrene' => 1050,
        'polyvinyl_chloride' => 1400,
        'porcelain' => 2300,
        'propane' => 1.864,
        'radon' => 9.73,
        'rubber' => 1050,
        'sand' => 1800,
        'sea_water' => 1025,
        'silver' => 11500,
        'slag' => 3550,
        'snow' => 200,
        'soil' => 1800,
        'steel' => 7800,
        'stone' => 2200,
        'sunflower oil' => 915,
        'sulfuric_acid' => 1840,
        'tin' => 7300,
        'trimethylamine' => 2.58,
        'tungsten' => 19300,
        'viniplast' => 1450,
        'water' => 1000,
        'wood_birch' => 650,
        'wood_bud' => 690,
        'wood_cork' => 480,
        'wood_larch' => 660,
        'wood_linden' => 530,
        'wood_pine' => 520,
        'wood_spruce' => 450,
        'xenon' => 5.89,
        'zinc' => 7130
    );

    /**
     * @var
     */
    protected $material;

    /**
     * @var CubicUnit
     */
    protected $cubicM;


    /**
     * WeightTonnageDensityConverter constructor.
     * @param $material
     * @param CubicUnit $cubicM
     * @throws Exception
     */
    public function __construct($material, CubicUnit $cubicM)
    {
        $this->setMaterial($material);
        $this->cubicM = $cubicM;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->calculate();
    }

    /**
     * @return array
     */
    protected function calculate()
    {
        if (isset($this->density[$this->material])) {
            $results = [];
            $results['tonne'] = $this->density[$this->material] / 1000 * $this->cubicM->getValue(new StringType('m'));
            $results['us_ton'] = $results['tonne'] * 1.10231;
            $results['imperial_ton'] = $results['tonne'] * 0.984207;

            return $results;
        }
    }

    /**
     * @param $material
     * @return bool
     * @throws Exception
     */
    public function setMaterial($material)
    {
        if (is_numeric($material)) {
            $this->density['custom'] = $material;
            $material = 'custom';
        }

        if (isset($material) && $material != '') {
            $material = strtolower($material);

            if (!array_key_exists($material, $this->density)) {
                throw new Exception("Unsupported material: {$material}");
            }

            $this->material = $material;
            return true;
        }
    }
}