<?php
require_once('wp-load.php');
$taxonomies = get_taxonomies('', 'names');
print_r($taxonomies);
