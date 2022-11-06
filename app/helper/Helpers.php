<?php
if (!function_exists('currency_IDR')) {
    function currency_IDR($value)
    {
        return "Rp " . number_format($value, 0, ',', '.') . ',00';
    }
}


if (!function_exists('draw_rating')) {
    function draw_rating($sum, $review)
    {

        if ($review == 0 && $sum == 0) {
            for ($i = 0; $i < 5; $i++) {
                echo '<i class="fa fa-star" style="color:black;"></i>';
            }
        } else {

            $total  = floor($sum / $review);
            for ($i = 0; $i < $total; $i++) {
                echo '<i class="fa fa-star" style="color:gold;"></i>';
            }
        }
    }
}
