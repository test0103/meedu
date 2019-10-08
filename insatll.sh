#!/bin/sh

# key
php artisan key:generate

# 软链接
php artisan storage:link

# 数据表
php artisan migrate

# 初始化系统权限
php artisan install role

# 初始化管理员
php artisan install administrator --q

# 初始化后台菜单
php artisan install backend_menu
