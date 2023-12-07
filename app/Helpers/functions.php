<?php

if ( ! function_exists('randString')) {
    /*
     * @param length string
     * return string
     */
    function randString($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }

        return $str;
    }
}

if ( ! function_exists('safeTitle')) {
    function safeTitle($str = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }
}

if ( ! function_exists('renderPaginate'))
{
    /**
     * @param $currentPage
     * @param $perPage
     * @param $lastPage
     * @param $link
     * @return string
     * echo paginate
     */
    function renderPaginate($paginate,$filter = '')
    {
        return '<div class="custome-paginate clearfix">
                <div class="pull-left mg-t-b-20">
                    <p>Trang <b>'.$paginate->currentPage().'</b> - Số bản ghi hiển thị <b>'.$paginate->perPage().'</b> - Tổng số trang <b>'.$paginate->lastPage().'</b> - Tổng số bản ghi <b>'.$paginate->total().'</b></p>
                </div>
                <div class="pull-right">'.$paginate->appends($filter)->links().'</div>
            </div>';
    }
}

if ( ! function_exists('convertDate'))
{
    function convertDate($stringDate)
    {
        $date = str_replace('/', '-', $stringDate);
        return date('Y-m-d', strtotime($date));
    }

}

/**
 * function Cut string
 *
 * @param    string $text
 * @return     string lenght $num
 */
function the_excerpt($text ,$num){

    if(strlen($text)> $num){

        $cutstring = substr($text,0,$num);
        $word = substr($text,0,strrpos($cutstring,' '));
        return $word ;

    }
    else{
        return $text;
    }

}

/**
 * get number year
 * @param $dateStart
 * @param $dateEnd
 * @return int
 * @throws Exception
 */
function getDay($expiryDate)
{
    $dateNow = date('Y-m-d') ; //current date
    return (strtotime($expiryDate) - strtotime($dateNow)) / (60 * 60 * 24);
}

/**
 * @param $product
 * @param $flagPrice
 * @param $customPrice
 * @return mixed
 */
function getPriceProduct($product, $flagPrice, $customPrice)
{
    switch ($flagPrice) {
        case 1 :
            $price = $product->p_entry_price;
            break;
        case 2 :
            $price = $product->p_retail_price;
            break;
        case 3 :
            $price = $product->p_cost_price;
            break;
        case 4 :
            $price = $customPrice;
            break;
        default :
            $price = $product->p_entry_price;
            break;
    }
    return $price;
}