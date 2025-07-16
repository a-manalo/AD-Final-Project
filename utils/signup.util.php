<?php
declare(strict_types=1);

include_once UTILS_PATH . '/envSetter.util.php';

class Signup
{
    /**
     * Validate the raw input; returns an array of error messages (empty if valid)
     *
     * @param array $data  Expecting keys: first_name, middle_name, last_name, username, password, role
     * @return string[]    List of validation errors
     */
    public static function validate(array $data): array
    {
        $errors = [];

        // Trim all inputs once
        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';
        $confirm = $data['confirm_password'] ?? '';

        // 1) Required fields
        if ($username === '') {
            $errors[] = 'Username is required.';
        }
        if ($password !== $confirm) {
            $errors[] = 'Passwords do not match.';
        }

        // 2) Password policy
        $pwLen = strlen($password);
        if (
            $pwLen < 8
            || !preg_match('/[A-Z]/', $password)
            || !preg_match('/[a-z]/', $password)
            || !preg_match('/\d/', $password)
            || !preg_match('/\W/', $password)
        ) {
            $errors[] = 'Password must be at least 8 characters and include uppercase, lowercase, number, and special character.';
        }

        return $errors;
    }

    /**
     * Create the user in the database. Throws on error.
     *
     * @param PDO   $pdo
     * @param array $data  Same keys as validate()
     * @return void
     * @throws PDOException on SQL errors (including duplicate username)
     */
    public static function create(PDO $pdo, array $data): void
    {
        // Prepare insert
        $stmt = $pdo->prepare("
            INSERT INTO public.\"users\" (username, password)
            VALUES (:username, :password)
        ");

        // Hash password
        $hashed = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->execute([
            ':username' => trim($data['username']),
            ':password' => $hashed,
        ]);
    }
}