<?php
require_once('wp-load.php');
$post_types = get_post_types('', 'names');
print_r($post_types);
