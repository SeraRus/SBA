<?php
function mailValid($mail_) {
    if (strpos($mail_, '@') === false || strpos($mail_, '@@') !== false) {
        return false;
    }
    list($user, $domain) = explode("@", $mail_);
    $pattern = '/[^a-zA-Z0-9.+]/';
    if (preg_match($pattern, $user)) {
        return false;
    }
    if ($user[0] == '.' || substr($user, -1) == '.' || strpos($user, '..') !== false) {
        return false;
    }
    $pattern = '/[^a-zA-Z0-9\-.]{3,}/';
    if (preg_match($pattern, $domain) || strpos($domain, '+') !== false) {
        return false;
    }
    if (strpos($domain, '.') === false || $domain[0] == '.' || substr($domain, -1) == '.' || strpos($domain, '..') !== false) {
        return false;
    }
    if (strpos($domain, "-.") !== false || strpos($domain, ".-") !== false) {
        return false;
    }
    return true;
}