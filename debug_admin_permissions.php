<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;

$admin = User::where('email', 'admin@gmail.com')->first();

echo "========================================\n";
echo "ADMIN USER DETAILED CHECK\n";
echo "========================================\n\n";

echo "User: {$admin->name} ({$admin->email})\n";
echo "ID: {$admin->id}\n";
echo "Has hasPermissionTo method: " . (method_exists($admin, 'hasPermissionTo') ? 'YES' : 'NO') . "\n\n";

// Check roles
$roles = $admin->roles()->get();
echo "Direct Roles (" . $roles->count() . "):\n";
foreach ($roles as $role) {
    echo "  - {$role->name} (ID: {$role->id})\n";
}

// Check permissions via role
echo "\nPermissions via roles:\n";
$rolePerms = DB::table('permissions')
    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
    ->join('model_has_roles', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
    ->where('model_has_roles.model_id', $admin->id)
    ->where('model_has_roles.model_type', 'App\\Models\\User')
    ->select('permissions.name', 'permissions.id')
    ->distinct()
    ->get();

foreach ($rolePerms as $perm) {
    echo "  - {$perm->name} (ID: {$perm->id})\n";
}

// Check specific hotel permissions
echo "\nSpecific Hotel Permissions Check:\n";
$hotelPerms = ['hotel-list', 'hotel-create', 'hotel-edit', 'hotel-delete'];
foreach ($hotelPerms as $perm) {
    $hasIt = $admin->hasPermissionTo($perm);
    echo "  - $perm: " . ($hasIt ? "✅ YES" : "❌ NO") . "\n";
}

// Check permission IDs
echo "\nPermission IDs:\n";
$permIds = DB::table('permissions')->whereIn('name', $hotelPerms)->get();
foreach ($permIds as $p) {
    echo "  - {$p->name}: ID {$p->id}\n";
}

// Check role_has_permissions for admin role
echo "\nRole-Permission mappings for Admin role (ID 2):\n";
$rolePerm = DB::table('role_has_permissions')->where('role_id', 2)->get();
echo "  Total mappings: " . count($rolePerm) . "\n";
foreach ($rolePerm as $rp) {
    $permName = DB::table('permissions')->find($rp->permission_id)?->name ?? 'UNKNOWN';
    echo "  - Permission ID {$rp->permission_id} ({$permName})\n";
}
