<?php
require_once('wp-load.php');

// 1. Create 5 Companies (taxonomy 'companies')
$company_names = ['Google', 'Apple', 'Microsoft', 'Amazon', 'Meta'];
$company_terms = [];

foreach ($company_names as $company_name) {
    $term = term_exists($company_name, 'companies');
    if (!$term) {
        $term = wp_insert_term($company_name, 'companies');
    }
    if (!is_wp_error($term)) {
        $company_terms[$company_name] = $term['term_id'];
    }
}

// 2. Create 5 Jobs for each company (total 25 jobs)
$job_titles = ['Software Engineer', 'UI/UX Designer', 'Project Manager', 'QA Tester', 'Support Specialist'];

foreach ($company_names as $company_name) {
    $term_id = $company_terms[$company_name];
    foreach ($job_titles as $job_title) {
        $post_title = $job_title . ' at ' . $company_name;
        
        // Check if job exists
        $existing = get_page_by_title($post_title, OBJECT, 'job_listing');
        if (!$existing) {
            $post_id = wp_insert_post([
                'post_title' => $post_title,
                'post_content' => 'We are hiring a ' . $job_title . ' to join our amazing team at ' . $company_name . '. Apply now!',
                'post_status' => 'publish',
                'post_type' => 'job_listing'
            ]);
            
            if ($post_id) {
                // Set taxonomy term
                if ($term_id) {
                    wp_set_object_terms($post_id, [(int)$term_id], 'companies');
                }
                // Set metadata just in case WP Job Manager relies on _company_name
                update_post_meta($post_id, '_company_name', $company_name);
                update_post_meta($post_id, '_job_location', 'New York'); // default location
            }
        }
    }
}

// 3. Create 5 Blog Posts
$blog_posts = [
    '5 Tips for a Successful Interview',
    'How to Write a Great Resume',
    'Top 10 Soft Skills Employers Want',
    'Navigating the Remote Work Environment',
    'The Future of Tech Jobs in 2026'
];

foreach ($blog_posts as $post_title) {
    $existing = get_page_by_title($post_title, OBJECT, 'post');
    if (!$existing) {
        wp_insert_post([
            'post_title' => $post_title,
            'post_content' => 'This is an insightful article about ' . $post_title . '. Read more to learn about the best practices and industry standards.',
            'post_status' => 'publish',
            'post_type' => 'post'
        ]);
    }
}

echo "Data insertion complete!\n";
