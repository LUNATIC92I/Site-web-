<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';
require_admin();
redirect(url('admin/dashboard.php'));
