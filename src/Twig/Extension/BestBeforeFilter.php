<?php declare(strict_types=1);

namespace App\Twig\Extension;

use DateTime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class BestBeforeFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('bestBeforeLabel', [$this, 'formatBestBeforeLabel']),
        ];
    }

    public function formatBestBeforeLabel(?\DateTime $date)
    {
        $label = '';

        if(is_null($date)) {
            return $label;
        }

        $today = new DateTime("now");

        $interval = $today->diff($date);

        $numberOfDays = (int)$interval->format('%r%a');

        if($numberOfDays < 0) {
            $label = 'label label-danger';
        }

        return $label;
    }
}
