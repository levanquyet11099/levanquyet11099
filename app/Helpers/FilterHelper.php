<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 1/8/19
 * Time: 2:50 PM
 */

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Model\Document;

class FilterHelper
{
    public static $time_list = [
        '1' => 'Today',
        '2' => 'Yesterday',
        '3' => 'This week',
        '4' => 'Last week',
        '5' => 'This month',
        '6' => 'Last month'
    ];

    /**
     * Filter list
     * @var array
     */
    protected $filter = [];

    /**
     * Created by : BillJanny
     * Date: 11:42 PM - 2/4/2017
     * Set mot vai thuoc tinh filter
     * @param $field
     * @param $ope
     * @param $defValue
     * @return
     */
    public function setFilter(Request $request, $field, $ope, $defValue = null)
    {
        $value = ($defValue == null) ? $request->get($field) : $defValue;
        if ($value != '' || $value != null)
        {
            if (strtoupper($ope) == 'LIKE')
            {
                $value = '%' . trim($value) . '%';
            }
            $this->filter[] = [$field, $ope, trim($value)];
        }
    }

    /**
     * Get all filter
     * @return [type] [description]
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * B
     * @param $date_range
     * @return array
     */
    public static function getStartEndTime($date_range, $config=[])
    {
        $dates = explode(' - ', $date_range);

        if (array_get($config, 'his'))
        {
            $start_date = date('Y-m-d H:i:s', strtotime($dates[0]));
            $end_date = date('Y-m-d H:i:s', strtotime($dates[1]));
        }else
        {
            $start_date = date('Y-m-d 00:00:00', strtotime($dates[0]));
            $end_date = date('Y-m-d 23:59:59', strtotime($dates[1]));
        }
        return [
            'start' => $start_date,
            'end' => $end_date
        ];
    }

    /**
     * B
     * @param $sites
     * @return array
     */
    public static function parseIdDomain($sites){
        $sites = explode(",",$sites);
        $ids = [];
        $domains = [];
        foreach ($sites as $site){
            if(strpos($site, ".")){
                $domains[] = PhpUri::parse($site)->getUniDomain();
            }else{
                $ids[] = intval($site);
            }
        }
        return [$ids, $domains];
    }

    public static function checkCodeDocument($number, $year) {
        $number = $number + 1;
        $y = substr($year, intval(strlen($year) - 2), intval(strlen($year)));
        $codeMaster = '00000';
        $numCode =  strlen($number);
        $textCode = substr($codeMaster, 0, intval(5 - $numCode));
        $code = $y.$textCode.$number;
        $dataCode = Document::where('dcm_code','like', '%'.$code.'%')->whereYear('created_at', $year)->get()->toArray();

        if(empty($dataCode)) {
            return $code;
        } else {
            return self::checkCodeDocument($number, $year);
        }
    }
}