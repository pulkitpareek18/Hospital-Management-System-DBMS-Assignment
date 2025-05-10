<?php
function showAlert($message, $type = 'success') {
    $bgColor = $type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
    return "<div class='mt-4 p-3 {$bgColor} rounded-md'>{$message}</div>";
}

function getBasePath() {
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
    
    // Check if we're in the views directory
    if (strpos($pathInfo['dirname'], '/views') !== false) {
        return $protocol.'://'.$hostName.str_replace('/views', '', $pathInfo['dirname']).'/';
    } else {
        return $protocol.'://'.$hostName.$pathInfo['dirname'].'/';
    }
}
?>