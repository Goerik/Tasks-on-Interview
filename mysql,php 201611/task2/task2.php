<?php


$conn = new PDO('mysql:host=127.0.0.1;port=33006;dbname=database;charset=utf8', 'root', '1234567');

$conn->query('SET SESSION TRANSACTION READ UNCOMMITTED');

$domainStatistics = [];

foreach ($conn->query("SELECT email FROM users") as $row)
{

    $emails = array_map('trim', explode(",", $row['email']));

    $emails = array_filter($emails, function ($value) { return $value !== ''; });

    $domains = array_map(function ($email) { return explode("@", $email)[1]; }, $emails);

    if (is_array($domains)) {
        foreach ($domains as $domain)
        {
            $domainStatistics[$domain] = ($domainStatistics[$domain] ?? 0) + 1;
        }
    }
}

arsort($domainStatistics);

foreach ($domainStatistics as $domain => $userCount)
{
    echo $domain . ": " . $userCount . "\n";
}

