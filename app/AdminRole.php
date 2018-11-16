<?php

namespace App;

use \App\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    //获取当前角色的所有权限
    public function permissions()
    {
        return $this->belongsToMany(\APP\AdminPermission::class, 'admin_permission_role', 'role_id', 'permission_id')
            ->withPivot(['role_id', 'permission_id']);
    }

    //给角色赋予权限
    public function grantPermission($permission)
    {
        return $this->permissions()->save($permission);
    }

    //删除角色赋予权限
    public function deletePermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    //判断角色是否有权限
    public function hasPermission($permission)
    {
        return $this->permissions()->contains($permission);
    }
}
