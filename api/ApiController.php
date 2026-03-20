<?php

class ApiController
{
  private $data;
  private $config;

  public function __construct($data, $config)
  {
    $this->data = $data;
    $this->config = $config['api'];
  }

  public function addLead()
  {
    $payload = [
      "firstName"   => $this->data['firstName'] ?? '',
      "lastName"    => $this->data['lastName'] ?? '',
      "phone"       => $this->data['phone'] ?? '',
      "email"       => $this->data['email'] ?? '',
      "countryCode" => "GB",
      "box_id"      => $this->config['box_id'],
      "offer_id"    => $this->config['offer_id'],
      "password"    => "qwerty12",
      "language"    => "en",
      "ip"          => $_SERVER['REMOTE_ADDR'] === '::1' ? '1.1.1.1' : $_SERVER['REMOTE_ADDR'],
      "landingUrl"  => (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']
    ];

    $url = $this->config['url'] . '/addlead';
    $token = $this->config['token'];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'token: ' . $token
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    header('Content-Type: application/json');
    echo $response;
  }

  public function getStatuses()
  {
    $dateFrom = date('Y-m-d H:i:s', strtotime('-30 days'));
    $dateTo   = date('Y-m-d H:i:s');

    $payload = [
      "date_from" => $dateFrom,
      "date_to"   => $dateTo,
      "page"      => 0,
      "limit"     => 100
    ];

    $url = $this->config['url'] . '/getstatuses';
    $token = $this->config['token'];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json',
      'token: ' . $token
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    header('Content-Type: application/json');
    echo $response;
    exit;
  }
}
