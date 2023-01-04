<?php


namespace Umulmrum\Holiday\Provider\Cuba;


use Umulmrum\Holiday\Constant\HolidayName;
use Umulmrum\Holiday\Constant\HolidayType;
use Umulmrum\Holiday\Model\Holiday;
use Umulmrum\Holiday\Model\HolidayList;
use Umulmrum\Holiday\Provider\CommonHolidaysTrait;
use Umulmrum\Holiday\Provider\CompensatoryDaysTrait;
use Umulmrum\Holiday\Provider\HolidayProviderInterface;
use Umulmrum\Holiday\Provider\Religion\ChristianHolidaysTrait;

/**
 * The Nearest Compensatory Day rule is not always apply on Cuba. Mostly depends of labour Saturdays and even on Sundays
 * is not always apply.
 *
 * Reference for holidays days in Cuba https://www.gacetaoficial.gob.cu/es/ley-no-116-codigo-de-trabajo art.94 y art.100
 */
class Cuba implements HolidayProviderInterface
{
    use ChristianHolidaysTrait;
    use CommonHolidaysTrait;

    /**
     * {@inheritdoc}
     */
    public function calculateHolidaysForYear(int $year): HolidayList
    {
        $holidays = new HolidayList();
        $this->addLiberationDay($holidays, $year);
        $this->addVictoryDay($holidays, $year);
        $this->addGoodFriday($holidays, $year);
        $this->addLaborDay($holidays, $year);
        $this->addNationalRebellionDayCelebration25($holidays, $year);
        $this->addNationalRebellionDay($holidays, $year);
        $this->addNationalRebellionDayCelebration27($holidays, $year);
        $this->addIndependenceDay($holidays, $year);
        $this->addChristmasDay($holidays, $year);
        $this->addNewYearsEve($holidays, $year);
        $this->addDaysByMinisterResolution($holidays,$year);
        return $holidays;
    }

    private function addLiberationDay(HolidayList $holidays, int $year): void
    {
        if ($year >= 1959) {
            $date = "{$year}-01-01";
            $holiday = Holiday::create(HolidayName::LIBERATION_DAY, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        } else {
            $holiday = $this->getNewYear($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addVictoryDay(HolidayList $holidays, int $year): void
    {
        if ($year >= 1959) {
            $date = "{$year}-01-02";
            $holiday = Holiday::create(HolidayName::VICTORY_DAY, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        } else {
            $holiday = $this->getNewYear($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addGoodFriday(HolidayList $holidays, int $year): void
    {
        //https://www.ecured.cu/Viernes_Santo
        if($year >= 2013){
            $holiday = $this->getGoodFriday($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addLaborDay(HolidayList $holidays, int $year): void
    {
        $holiday = $this->getLaborDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
        $holidays->add($holiday);
    }

    private function addNationalRebellionDayCelebration25(HolidayList $holidays, int $year): void
    {
        if ($year >= 1959) {
            $date = "{$year}-07-25";
            $holiday = Holiday::create(HolidayName::NATIONAL_REBELLION_DAY_CELEBRATION, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addNationalRebellionDay(HolidayList $holidays, int $year): void
    {
        if ($year >= 1959) {
            $date = "{$year}-07-26";
            $holiday = Holiday::create(HolidayName::NATIONAL_REBELLION_DAY, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addNationalRebellionDayCelebration27(HolidayList $holidays, int $year): void
    {
        if ($year >= 1959) {
            $date = "{$year}-07-27";
            $holiday = Holiday::create(HolidayName::NATIONAL_REBELLION_DAY_CELEBRATION, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
            $holidays->add($holiday);
        }
    }

    private function addIndependenceDay(HolidayList $holidays, int $year): void
    {
        $date = "{$year}-10-10";
        $holiday = Holiday::create(HolidayName::INDEPENDENCE_DAY, $date, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
        $holidays->add($holiday);
    }

    private function addChristmasDay(HolidayList $holidays, int $year): void
    {
        $holiday = $this->getChristmasDay($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
        $holidays->add($holiday);
    }

    private function addNewYearsEve(HolidayList $holidays, int $year): void
    {
        $holiday = $this->getNewYearsEve($year, HolidayType::OFFICIAL | HolidayType::DAY_OFF);
        $holidays->add($holiday);
    }

    private function addDaysByMinisterResolution(HolidayList $holidays, int $year): void
    {
        if($year === 2022){
            //http://www.cubadebate.cu/noticias/2021/12/23/proximo-3-de-enero-sera-dia-feriado-en-cuba/
            $holidays->add(Holiday::create(HolidayName::MINISTERIAL_RESOLUTION, "2022-01-03", HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        }elseif ($year === 2023){
            https://www.granma.cu/cuba/2022-12-14/disponen-receso-de-las-actividades-laborales-el-proximo-3-de-enero
            $holidays->add(Holiday::create(HolidayName::MINISTERIAL_RESOLUTION, "2023-01-03", HolidayType::OFFICIAL | HolidayType::DAY_OFF));
        }
    }

}
