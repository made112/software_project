<?php

namespace App\Http\Helpers;

use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class Helpers
{



    public static function GetTimeZone()
    {
        return $timezones = array(
            'Pacific/Midway'       => "(GMT-11:00) Midway Island",
            'US/Samoa'             => "(GMT-11:00) Samoa",
            'US/Hawaii'            => "(GMT-10:00) Hawaii",
            'US/Alaska'            => "(GMT-09:00) Alaska",
            'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana'      => "(GMT-08:00) Tijuana",
            'US/Arizona'           => "(GMT-07:00) Arizona",
            'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
            'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
            'America/Mexico_City'  => "(GMT-06:00) Mexico City",
            'America/Monterrey'    => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
            'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
            'America/Bogota'       => "(GMT-05:00) Bogota",
            'America/Lima'         => "(GMT-05:00) Lima",
            'America/Caracas'      => "(GMT-04:30) Caracas",
            'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz'       => "(GMT-04:00) La Paz",
            'America/Santiago'     => "(GMT-04:00) Santiago",
            'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland'            => "(GMT-03:00) Greenland",
            'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
            'Atlantic/Azores'      => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca'    => "(GMT) Casablanca",
            'Europe/Dublin'        => "(GMT) Dublin",
            'Europe/Lisbon'        => "(GMT) Lisbon",
            'Europe/London'        => "(GMT) London",
            'Africa/Monrovia'      => "(GMT) Monrovia",
            'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
            'Europe/Berlin'        => "(GMT+01:00) Berlin",
            'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
            'Europe/Brussels'      => "(GMT+01:00) Brussels",
            'Europe/Budapest'      => "(GMT+01:00) Budapest",
            'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
            'Europe/Madrid'        => "(GMT+01:00) Madrid",
            'Europe/Paris'         => "(GMT+01:00) Paris",
            'Europe/Prague'        => "(GMT+01:00) Prague",
            'Europe/Rome'          => "(GMT+01:00) Rome",
            'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
            'Europe/Skopje'        => "(GMT+01:00) Skopje",
            'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
            'Europe/Vienna'        => "(GMT+01:00) Vienna",
            'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
            'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
            'Europe/Athens'        => "(GMT+02:00) Athens",
            'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
            'Africa/Cairo'         => "(GMT+02:00) Cairo",
            'Africa/Harare'        => "(GMT+02:00) Harare",
            'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
            'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
            'Europe/Kiev'          => "(GMT+02:00) Kyiv",
            'Europe/Minsk'         => "(GMT+02:00) Minsk",
            'Europe/Riga'          => "(GMT+02:00) Riga",
            'Europe/Sofia'         => "(GMT+02:00) Sofia",
            'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
            'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
            'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
            'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
            'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
            'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
            'Europe/Moscow'        => "(GMT+03:00) Moscow",
            'Asia/Tehran'          => "(GMT+03:30) Tehran",
            'Asia/Baku'            => "(GMT+04:00) Baku",
            'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
            'Asia/Muscat'          => "(GMT+04:00) Muscat",
            'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
            'Asia/Kabul'           => "(GMT+04:30) Kabul",
            'Asia/Karachi'         => "(GMT+05:00) Karachi",
            'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
            'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty'          => "(GMT+06:00) Almaty",
            'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
            'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth'      => "(GMT+08:00) Perth",
            'Asia/Singapore'       => "(GMT+08:00) Singapore",
            'Asia/Taipei'          => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
            'Asia/Seoul'           => "(GMT+09:00) Seoul",
            'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
            'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
            'Australia/Darwin'     => "(GMT+09:30) Darwin",
            'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
            'Australia/Canberra'   => "(GMT+10:00) Canberra",
            'Pacific/Guam'         => "(GMT+10:00) Guam",
            'Australia/Hobart'     => "(GMT+10:00) Hobart",
            'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney'     => "(GMT+10:00) Sydney",
            'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
            'Asia/Magadan'         => "(GMT+12:00) Magadan",
            'Pacific/Auckland'     => "(GMT+12:00) Auckland",
            'Pacific/Fiji'         => "(GMT+12:00) Fiji",
        );
    }

    public static function GenerateLicenses($license_code)
    {
        $code = explode('-', $license_code);
        $str = '';
        foreach ($code as $key => $co) {
            $array_code = str_split($co, 5);
            if ($array_code) {
                foreach ($array_code as $ar) {
                    if ($ar == '{[X]}') {
                        $str .= self::GetRandomNumber();
                    } elseif ($ar == '{[Y]}') {
                        $str .= self::GetRandomString();
                    } else {
                        $str .= self::GetRandomNumAndString();
                    }
                }
            }
            if ($key != count($code) - 1) {
                $str .= '-';
            }
        }
        return $str;
    }

    public static function GetRandomNumAndString()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = $chars[rand(0, $size - 1)];
        return $str;
    }

    public static function GetRandomString()
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $size = strlen($chars);
        $str = $chars[rand(0, $size - 1)];
        return $str;
    }

    public static function GetRandomNumber()
    {
        $chars = "0123456789";
        $size = strlen($chars);
        $str = $chars[rand(0, $size - 1)];
        return $str;
    }


    // may put this function somewhere else
    public static function  merge_parameters_to_url($url, array $parameters = [])
    {
        foreach ($parameters as $key => $value) {
            $value = urlencode($value);
            $url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
            $url = substr($url, 0, -1);
            if (strpos($url, '?') === false) {
                $url = $url . '?' . $key . '=' . $value;
            } else {
                $url = $url . '&' . $key . '=' . $value;
            }
        }

        return $url;
    }

    public static function get_youtube_id($url)
    {
        $youtubeid = explode('v=', $url);
        $youtubeid = explode('&', $youtubeid[1]);
        $youtubeid = $youtubeid[0];
        return $youtubeid;
    }

    public static function get_youtube_thumb($id)
    {
        if (url_exists('https://i.ytimg.com/vi_webp/' . $id . '/sddefault.webp')) {
            $image = 'https://i.ytimg.com/vi_webp/' . $id . '/sddefault.webp';
        } elseif (url_exists('https://i.ytimg.com/vi_webp/' . $id . '/maxresdefault.webp')) {
            $image = 'https://i.ytimg.com/vi_webp/' . $id . '/maxresdefault.webp';
        } elseif (url_exists('https://i.ytimg.com/vi_webp/' . $id . '/mqdefault.webp')) {
            $image = 'https://i.ytimg.com/vi_webp/' . $id . '/mqdefault.webp';
        } elseif (url_exists('https://i.ytimg.com/vi/' . $id . '/maxresdefault.jpg')) {
            $image = 'https://i.ytimg.com/vi/' . $id . '/maxresdefault.jpg';
        } elseif (url_exists('https://i.ytimg.com/vi/' . $id . '/mqdefault.jpg')) {
            $image = 'https://i.ytimg.com/vi/' . $id . '/mqdefault.jpg';
        } else {
            $image = false;
        }
        return $image;
    }

    public static function randomString($length = 6, $type = 0)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        } //end for loop
        if ($type == 1) {
            return md5($str);
        }
        return $str;
    }
    /**********************************************************************************************************************/
    public static function randomNumber($length, $type = 0)
    {
        $chars = "0123456789";
        $str = "";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        } //end for loop
        if ($type == 1) {
            return md5($str);
        }
        return $str;
    }
    /**********************************************************************************************************************/
    public static function cutText($str, $limit, $withDots = true)
    {
        $str = strip_tags($str);
        $str = trim($str);
        if (strlen($str) > $limit) {
            $str = substr($str, 0, strrpos(substr($str, 0, $limit), ' '));
            $str .= ($withDots) ? '...' : '';
        }
        return $str;
    }
    /**********************************************************************************************************************/
    public static function getCurrentPageURL()
    {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
    /**********************************************************************************************************************/
    public static function getMonthName($month = '')
    {
        $months = array(
            "Jan" => "يناير",
            "Feb" => "فبراير",
            "Mar" => "مارس",
            "Apr" => "أبريل",
            "May" => "مايو",
            "Jun" => "يونيو",
            "Jul" => "يوليو",
            "Aug" => "أغسطس",
            "Sep" => "سبتمبر",
            "Oct" => "أكتوبر",
            "Nov" => "نوفمبر",
            "Dec" => "ديسمبر"
        );
        return $months[$month];
    }
    /**********************************************************************************************************************/
    public static function stringReplace($text, $type = 0)
    {
        $search = array();
        if ($type == 1) { // clear details
            $search = array();
            $str = str_replace($search, '', $text);
            //   $str = strip_tags($str);
            $str = trim($str);
            return $str;
        } else if ($type == 2) { //clear to link ;
            $search = array(';', '/', '.', ',', '!', '@', '#', '$', '%', '^', '*', '(', ')', '=', '+', '~', '&', '"', '||', "'", '&quot;', '&ldquo;', '&rdquo;', '&lsquo;', '&rsquo;', '&mdash;', '&ndash;', '<div>', '</div>', '|', '&laquo;', '&nbsp;', '&raquo;', '&middot');
            $text = str_replace($search, '', $text);
            return str_replace(" ", "-", strip_tags($text));
        } else if ($type == 3) { //clear to link ;
            $search = array('"', '||', '&quot;', '&ldquo;', '&rdquo;', '&lsquo;', '&rsquo;', '&mdash;', '&ndash;', '<div>', '</div>', '|', '&laquo;', '&nbsp;', '&raquo;', '&middot');
            $text = str_replace($search, '', $text);
            $text = strip_tags($text);
            return trim($text);
        }
    }
    /**********************************************************************************************************************/
    public static function checkMobileNo($phoneNumber = '')
    {
        $phone = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (strlen($phone) === 10) {
            return 1;
        } else {
            return 0;
        }
    }

    /**********************************************************************************************************************/
    public static  function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);

        $diff->d -= $diff->w * 7;
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        if ($diff->days > 60) {
            return date('d-m-Y h:i A', strtotime($datetime));
        } else {
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }
    }
    /**********************************************************************************************************************/
    public static function city($city_id)
    {
        $city = array(
            '7303419' => 'القدس',
            '281133' => 'غزة',
            '282239' => 'رام الله',
            '281124' => 'خان يونس',
            '281102' => 'رفح',
            '284315' => 'بيت لحم',
            '285066' => 'الخليل',
            '323786' => 'أنقرة',
            '745044' => 'اسطنبول',
            '750268' => 'بورصة',
            '325361' => 'أضنة',
            '745047' => 'اسبير',
            '315367' => 'أرزروم',
            '323776' => 'أنطاليا',
            '738648' => 'طربزون',
        );
        return $city[$city_id];
    }
    /**********************************************************************************************************************/
    public static function time_ago($datetime, $full = false)
    {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'سنة',
            'm' => 'شهر',
            'w' => 'اسبوع',
            'd' => 'يوم',
            'h' => 'ساعة',
            'i' => 'دقيقة',
            's' => 'ثانية',
        );
        $string1 = array(
            'y' => 'سنتين',
            'm' => 'شهرين',
            'w' => 'اسبوعان',
            'd' => 'يومان',
            'h' => 'ساعتين',
            'i' => 'دقيقتان',
            's' => 'ثانيتين',
        );
        $string2 = array(
            'y' => 'سنوات',
            'm' => 'شهور',
            'w' => 'اسابيع',
            'd' => 'يوم',
            'h' => 'ساعة',
            'i' => 'دقائق',
            's' => 'ثانية',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                if ($diff->$k == 1) {
                    $v = $string[$k];
                } else if ($diff->$k == 2) {
                    $v = $string1[$k];
                } else if ($diff->$k > 2) {
                    $v = $string2[$k];
                    $v = $diff->$k . ' ' . $v;
                }

                // echo $v;exit;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? 'منذ ' . implode(', ', $string) : 'الآن';
    }
    /**********************************************************************************************************************/
    public static function getDateTimeMessage($date)
    {
        $result = '';
        $lastUpdateMessage = date('Y-m-d', strtotime($date));
        if (date('Y-m-d') == $lastUpdateMessage) {
            $result = date('H:i', strtotime($date));
        } else {
            $FirstDay = date("Y-m-d", strtotime('sunday last week'));
            $LastDay = date("Y-m-d", strtotime('sunday this week'));
            if ($lastUpdateMessage > $FirstDay && $lastUpdateMessage < $LastDay) {
                $result = date('l', strtotime($date));
            } else {
                $result = date('F-d', strtotime($date));
            }
        }
        return $result;
    }
    public static function dateFormat($date, $check = true)
    {
        $time = mktime(0, 0, 0, date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)));
        $TDays = round($time / (60 * 60 * 24));
        $HYear = round($TDays / 354.37419);
        $Remain = $TDays - ($HYear * 354.37419);
        $HMonths = round($Remain / 29.531182);
        $HDays = $Remain - ($HMonths * 29.531182);
        $HYear = $HYear + 1389;
        $HMonths = $HMonths + 10;
        $HDays = $HDays + 23;
        if ($HDays > 29.531188 and round($HDays) != 30) {
            $HMonths = $HMonths + 1;
            $HDays = Round($HDays - 29.531182);
        } else {
            $HDays = Round($HDays);
        }
        if ($HMonths > 12) {
            $HMonths = $HMonths - 12;
            $HYear = $HYear + 1;
        }
        $NowDay = $HDays;
        $NowMonth = $HMonths;
        $NowYear = $HYear;
        if ($HMonths == "1") {
            $HMonths2 = "محرم";
        } elseif ($HMonths == "2") {
            $HMonths2 = "صفر";
        } elseif ($HMonths == "3") {
            $HMonths2 = "ربيع الأول";
        } elseif ($HMonths == "4") {
            $HMonths2 = "ربيع الثاني";
        } elseif ($HMonths == "5") {
            $HMonths2 = "جمادي الأول";
        } elseif ($HMonths == "6") {
            $HMonths2 = "جمادي ثاني";
        } elseif ($HMonths == "7") {
            $HMonths2 = "رجب";
        } elseif ($HMonths == "8") {
            $HMonths2 = "شعبان";
        } elseif ($HMonths == "9") {
            $HMonths2 = "رمضان";
        } elseif ($HMonths == "10") {
            $HMonths2 = "شوال";
        } elseif ($HMonths == "11") {
            $HMonths2 = "ذو القعدة";
        } elseif ($HMonths == "12") {
            $HMonths2 = "ذو الحجة";
        }


        $MDay_Num = date('w', strtotime($date));
        if ($MDay_Num == "0") {
            $MDay_Name = 'الأحد';
        } elseif ($MDay_Num == "1") {
            $MDay_Name = 'الاثنين';
        } elseif ($MDay_Num == "2") {
            $MDay_Name = 'الثلاثاء';
        } elseif ($MDay_Num == "3") {
            $MDay_Name = 'الأربعاء';
        } elseif ($MDay_Num == "4") {
            $MDay_Name = 'الخميس';
        } elseif ($MDay_Num == "5") {
            $MDay_Name = 'الجمعة';
        } elseif ($MDay_Num == "6") {
            $MDay_Name = 'السبت';
        }
        $NowDayName = $MDay_Name;
        $day = date('d', strtotime($date)) . " " . self::get_month_name(date('M', strtotime($date))) . " " . date('Y', strtotime($date));
        if ($check) {
            return $NowDate = $MDay_Name . " , " . $day . " - " . $HDays . " " . $HMonths2 . " " . $HYear . " هـ";
        } else {
            return $NowDate = $MDay_Name . " , " . $day;
        }
    }

    public static function get_month_name($month)
    {
        $months = array(
            "Jan" => 'ينار',
            "Feb" => 'فبراير',
            "Mar" => 'مارس',
            "Apr" => 'أبريل',
            "May" => 'مايو',
            "Jun" => 'يونيو',
            "Jul" => 'يوليو',
            "Aug" => 'أغسطس',
            "Sep" => 'سبتمبر',
            "Oct" => 'أكتوبر',
            "Nov" => 'نوفمبر',
            "Dec" => 'ديسمبر',
        );
        return $months[$month];
    }

    public static function getDayName($date = '')
    {
        $MDay_Num = date('w', strtotime($date));
        if ($MDay_Num == "0") {
            $MDay_Name = 'الأحد';
        } elseif ($MDay_Num == "1") {
            $MDay_Name = 'الاثنين';
        } elseif ($MDay_Num == "2") {
            $MDay_Name = 'الثلاثاء';
        } elseif ($MDay_Num == "3") {
            $MDay_Name = 'الأربعاء';
        } elseif ($MDay_Num == "4") {
            $MDay_Name = 'الخميس';
        } elseif ($MDay_Num == "5") {
            $MDay_Name = 'الجمعة';
        } elseif ($MDay_Num == "6") {
            $MDay_Name = 'السبت';
        }
        return $MDay_Name;
    }

    public static function hft_nice_number($n)
    {
        $n = (0 + str_replace(",", "", $n));

        if (!is_numeric($n)) return 0;

        if ($n > 1000000000000) return round(($n / 1000000000000), 1) . ' trillion';
        else if ($n > 1000000000) return round(($n / 1000000000), 1) . ' billion';
        else if ($n > 1000000) return round(($n / 1000000), 1) . ' M';
        else if ($n > 1000) return round(($n / 1000), 1) . ' k';

        return number_format($n);
    }

    public static function resizeImage($photoName, $file, $width, $height, $uploadPath)
    {
        require_once 'SimpleImage.php';
        $image = new SimpleImage();
        $image->load($file);
        $image->resize($width, $height);
        $image->save($uploadPath . $photoName);

        if (file_exists($uploadPath . $photoName)) {
            return true;
        }
    }

    public static function resizeImage2($photoName, $file, $width, $height, $uploadPath)
    {
        require_once 'SimpleImage.php';
        $image = new SimpleImage();
        $image->load($file);
        $image->resizeToWidth($width);
        $image->save($uploadPath . $photoName);

        if (file_exists($uploadPath . $photoName)) {
            return true;
        }
    }


    public static function  getColorOfActivity(Activity $activity)
    {

        if (str_contains($activity->description, 'update')) {
            return "bg-warning";
        } else if (str_contains($activity->description, 'create')) {
            return "bg-success";
        } else if (str_contains($activity->description, 'delete')) {
            return "bg-danger";
        } else {
            return "bg-info";
        }
    }

    public static function getRandomColor()
    {
        $colors =  ['#7A8AFF', '#B8ADFD', '#FCA9CF', '#9ebee5', '#ff9800', '#191919', '#0b8495', '#008000', '#ff99ab', '#ffa500', '#ff0000', '#ff0176', '#83d1d7', '#360be3', '#ffa5a5', '#003e8b', '#009519', '#73859d', '#71E3EB', '#EC5A5A'];
        return $colors[array_rand($colors)];
    }

    public static function  getChartFilter()
    {
        $range = request()->input('format');

        switch ($range) {
            case 'last_month':
                return "%e";
                break;

            case 'all_dates':
                return "%Y";
                break;
        }

        return "%b";
    }

    public static function getMonths($prev, $now)
    {
        $month = array();
        $i = 0;


        while ($prev <= $now) {
            if ($i == 0) {
                $month[] = date('Y', strtotime($prev)) . '-' . date('M', strtotime($prev));
                if (Carbon::createFromFormat('Y-m-d H:i:s', $prev)->daysInMonth == '30') {
                    $prev = date("Y-m-d H:i:s", strtotime($prev . " + 30 days"));
                } else if ((Carbon::createFromFormat('Y-m-d H:i:s', $prev)->daysInMonth == '31')) {
                    $prev = date("Y-m-d H:i:s", strtotime($prev . " + 31 days"));
                } else if ((Carbon::createFromFormat('Y-m-d H:i:s', $prev)->daysInMonth == '29')) {
                    $prev = date("Y-m-d H:i:s", strtotime($prev . " + 29 days"));
                } else if ((Carbon::createFromFormat('Y-m-d H:i:s', $prev)->daysInMonth == '28')) {
                    $prev = date("Y-m-d H:i:s", strtotime($prev . " + 28 days"));
                }
            }
        }
        return $month;
    }


    function array_string($arr, $opts = 'php')
    {

        if (is_array($opts)) $opts['depth']++;
        else {
            if (!is_string($opts)) {
                $in = $opts;
                $opts = is_integer($in) ? "json" : 'php';
                if ($in) $opts .= " pretty print";
            }
            $args = preg_split('/[^a-z0-9]/i', $opts);
            if (in_array('json', $args))
                $opts = array('open' => '{', 'close' => '}', 'sep' => ': ', 'integers' => false);
            else $opts = array('open' => '[', 'close' => ']', 'sep' => ' => ', 'integers' => true);
            if (!in_array('pretty', $args)) $opts = $opts + array('indent' => '', 'eol' => '');
            else $opts = $opts + array('indent' => '  ', 'eol' => "\n");
            $opts['depth'] = 1; #starts at 1
            $opts['print'] = in_array('print', $args) || in_array('echo', $args) ? true : false;
        }
        end($arr);
        $last = key($arr);
        $result = "$opts[open]$opts[eol]";

        foreach ($arr as $k => $v) {
            $result .= str_repeat($opts['indent'], $opts['depth']);
            if (!$opts['integers']) $result .= "\"$k\"$opts[sep]";
            else $result .= is_integer($k) ? " $k$opts[sep]" : "\"$k\"$opts[sep]";
            if (is_array($v))   $result .= array_string($v, $opts);
            elseif (is_bool($v))    $result .= $v ? "true" : "false";
            elseif (is_numeric($v)) $result .= $v;
            else                   $result .= "\"" . addslashes($v) . "\"";
            $result .= $last === $k ? $opts['eol'] : ", $opts[eol]";
        }
        $opts['depth']--;
        $result .= str_repeat($opts['indent'], $opts['depth']) . $opts['close'];
        if ($opts['depth'] === 0) {
            $result .= $opts['eol'];
            if ($opts['print']) echo $result;
        }
        return $result;
    }

    public static function remove_utf8_bom($text){
        $bom = pack('H*','EFBBBF');
        $text = preg_replace("/^$bom/", '', $text);
        return $text;
    }
}
