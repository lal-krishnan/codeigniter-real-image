<?php
$roles=['Admin', 'Designer', 'Fabrication','Customer','Front Office']; 
$permissions=['order_close', 'order_create', 'price_update', 'delete_order'];
$rolePermissions=[
    'Admin' => ['order_close', 'order_create', 'price_update', 'delete_order'],
    'Designer' => ['order_create'],
    'Front Office' => ['order_close', 'order_create', 'price_update', 'delete_order'],
]; // Example role permissions
if (!function_exists('has_permission')) {
    /**
     * Check if the current user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    function has_permission(string $permission): bool
    {
        $session = session();
        $userPermissions = $session->get('user_permissions') ?? [];

        return in_array($permission, $userPermissions);
    }
}

if (!function_exists('is_role')) {
    /**
     * Check if the current user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    function is_role(string $role): bool
    {
        $session = session();
        $userRole = $session->get('user_role');

        return $userRole === $role;
    }
}

if (!function_exists('check_access')) {
    /**
     * Redirect the user if they do not have the required permission.
     *
     * @param string $permission
     */
    function check_access(string $permission)
    {
        if (!has_permission($permission)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
}