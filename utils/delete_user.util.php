<?php
declare(strict_types=1);
include_once UTILS_PATH . '/envSetter.util.php';

class DeleteUser
{
    /**
     * Deletes a user by UUID
     *
     * @param PDO    $pdo
     * @param string $userId
     * @return bool
     * @throws PDOException on failure
     */
    public static function deleteById(PDO $pdo, string $userId): bool
    {
        $stmt = $pdo->prepare('DELETE FROM public."users" WHERE id = :id');
        return $stmt->execute([':id' => $userId]);
    }
}