<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $path): never
{
    header('Location: ' . $path);
    exit;
}

function csrfToken(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verifyCsrfToken(mixed $token): void
{
    if (!is_string($token) || !hash_equals(csrfToken(), $token)) {
        http_response_code(403);
        exit('Solicitação inválida. Atualize a página e tente novamente.');
    }
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function consumeFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    return is_array($flash) ? $flash : null;
}

function storeFormState(array $data, array $errors): void
{
    $_SESSION['form_state'] = ['data' => $data, 'errors' => $errors];
}

function consumeFormState(): array
{
    $state = $_SESSION['form_state'] ?? ['data' => [], 'errors' => []];
    unset($_SESSION['form_state']);

    return [
        is_array($state['data'] ?? null) ? $state['data'] : [],
        is_array($state['errors'] ?? null) ? $state['errors'] : [],
    ];
}

function positiveId(mixed $value): ?int
{
    $id = filter_var($value, FILTER_VALIDATE_INT);

    return $id !== false && $id > 0 ? $id : null;
}

