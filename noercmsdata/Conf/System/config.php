<?php
return array (
  'USER_AUTH_ON' => true,
  'USER_AUTH_TYPE' => 2,
  'USER_AUTH_KEY' => 'user_id',
  'ADMIN_AUTH_KEY' => 'administrator',
  'USER_AUTH_MODEL' => 'User',
  'AUTH_PWD_ENCODER' => 'md5',
  'USER_AUTH_GATEWAY' => '?g=Admin&m=Admin&a=index',
  'NOT_AUTH_MODULE' => 'Admin,Index',
  'REQUIRE_AUTH_MODULE' => '',
  'NOT_AUTH_ACTION' => 'index',
  'REQUIRE_AUTH_ACTION' => '',
  'GUEST_AUTH_ON' => false,
  'GUEST_AUTH_ID' => 0,
  'RBAC_ROLE_TABLE' => 'wqy_role',
  'RBAC_USER_TABLE' => 'wqy_role_user',
  'RBAC_ACCESS_TABLE' => 'wqy_access',
  'RBAC_NODE_TABLE' => 'wqy_node',
  'SPECIAL_USER' => 'admin',
);
?>