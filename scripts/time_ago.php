<?php
date_default_timezone_set('Asia/Jakarta');
$current_time = time();
$time_diff = $current_time - strtotime($data['created_at']);
$timeAgo;
if ($time_diff < 60) {
    if ($time_diff > 1) {
        $timeAgo = $time_diff . " seconds ago";
    } else {
        $timeAgo = $time_diff . " second ago";
    }
} elseif ($time_diff < 3600) {
    $minutes_diff = round($time_diff / 60);
    if ($minutes_diff > 1) {
        $timeAgo = $minutes_diff . " minutes ago";
    } else {
        $timeAgo = $minutes_diff . " minute ago";
    }
} elseif ($time_diff < 86400) {
    $hours_diff = round($time_diff / 3600);
    if ($hours_diff > 1) {
        $timeAgo = $hours_diff . " hours ago";
    } else {
        $timeAgo = $hours_diff . " hour ago";
    }
} elseif ($time_diff < 604800) {
    $days_diff = round($time_diff / 86400);
    if ($days_diff > 1) {
        $timeAgo = $days_diff . " days ago";
    } else {
        $timeAgo = $days_diff . " day ago";
    }
} elseif ($time_diff < 2419200) {
    $weeks_diff = round($time_diff / 604800);
    if ($weeks_diff > 1) {
        $timeAgo = $weeks_diff . " weeks ago";
    } else {
        $timeAgo = $weeks_diff . " week ago";
    }
} elseif ($time_diff < 31536000) {
    $months_diff = round($time_diff / 2419200);
    if ($months_diff > 1) {
        $timeAgo = $months_diff . " months ago";
    } else {
        $timeAgo = $months_diff . " month ago";
    }
} else {
    $years_diff = round($time_diff / 31536000);
    if ($years_diff > 1) {
        $timeAgo = $years_diff . " years ago";
    } else {
        $timeAgo = $years_diff . " year ago";
    }
}
?>