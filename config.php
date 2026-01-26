<?php
// config.php
// Fait par l'IA
session_start();

define("USERS_FILE", __DIR__ . "/users.json");

function load_users(): array {
  if (!file_exists(USERS_FILE)) return [];
  $raw = file_get_contents(USERS_FILE);
  $data = json_decode($raw, true);
  return is_array($data) ? $data : [];
}

function save_users(array $users): void {
  file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function find_user_by_email(string $email, array $users): ?array {
  foreach ($users as $u) {
    if (isset($u["email"]) && strtolower($u["email"]) === strtolower($email)) return $u;
  }
  return null;
}

function is_logged_in(): bool {
  return !empty($_SESSION["user"]);
}

function require_login(): void {
  if (!is_logged_in()) {
    header("Location: login.php?error=login_required");
    exit;
  }
}
