<?php
function CutString(string $string, int $limit): string
{
    if (strlen($string) > $limit) {
        $string = substr($string, 0, $limit) . "...";
        return $string;
    } else {
        return $string;
    }
}
?>