<?php
/**
 * Sanitization Functions
 * 
 * @package jobscout
*/

function jobscout_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function jobscout_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
    
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function jobscout_sanitize_radio( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function jobscout_sanitize_sortable_sections( $input ) {
    if ( is_array( $input ) ) {
        return array_map( 'sanitize_key', $input );
    }
    $decoded = json_decode( (string) $input, true );
    if ( is_array( $decoded ) ) {
        return array_map( 'sanitize_key', $decoded );
    }
    return array();
}

/**
 * Sanitizes the news sections sortable order.
 *
 * @param mixed $input String or array representing the order of sections.
 * @return string Comma-separated list of valid section IDs.
 */
function jobscout_sanitize_news_sections_order( $input ) {
    $allowed = array( 'banner', 'grid', 'newsletter' );

    $raw_items = array();
    if ( is_array( $input ) ) {
        $raw_items = $input;
    } elseif ( is_string( $input ) ) {
        $trimmed = trim( $input );
        if ( '' === $trimmed ) {
            return implode( ',', $allowed );
        }
        if ( strpos( $trimmed, '[' ) === 0 ) {
            $decoded = json_decode( $trimmed, true );
            if ( is_array( $decoded ) ) {
                $raw_items = $decoded;
            } else {
                $raw_items = explode( ',', $trimmed );
            }
        } else {
            $raw_items = explode( ',', $trimmed );
        }
    } else {
        return implode( ',', $allowed );
    }

    $sanitized = array();
    foreach ( $raw_items as $item ) {
        if ( ! is_scalar( $item ) ) {
            continue;
        }
        $key = sanitize_key( trim( (string) $item ) );
        if ( in_array( $key, $allowed, true ) && ! in_array( $key, $sanitized, true ) ) {
            $sanitized[] = $key;
        }
    }

    foreach ( $allowed as $default_key ) {
        if ( ! in_array( $default_key, $sanitized, true ) ) {
            $sanitized[] = $default_key;
        }
    }

    return implode( ',', $sanitized );
}

/**
 * Sanitizes the news detail sections sortable order.
 *
 * @param mixed $input String or array representing the order of news detail sections.
 * @return string Comma-separated list of valid section IDs.
 */
function jobscout_sanitize_news_detail_sections_order( $input ) {
    $allowed = array( 'breadcrumb', 'header', 'description', 'content', 'related' );

    $raw_items = array();
    if ( is_array( $input ) ) {
        $raw_items = $input;
    } elseif ( is_string( $input ) ) {
        $trimmed = trim( $input );
        if ( '' === $trimmed ) {
            return implode( ',', $allowed );
        }
        if ( strpos( $trimmed, '[' ) === 0 ) {
            $decoded = json_decode( $trimmed, true );
            if ( is_array( $decoded ) ) {
                $raw_items = $decoded;
            } else {
                $raw_items = explode( ',', $trimmed );
            }
        } else {
            $raw_items = explode( ',', $trimmed );
        }
    } else {
        return implode( ',', $allowed );
    }

    $sanitized = array();
    foreach ( $raw_items as $item ) {
        if ( ! is_scalar( $item ) ) {
            continue;
        }
        $key = sanitize_key( trim( (string) $item ) );
        if ( in_array( $key, $allowed, true ) && ! in_array( $key, $sanitized, true ) ) {
            $sanitized[] = $key;
        }
    }

    foreach ( $allowed as $default_key ) {
        if ( ! in_array( $default_key, $sanitized, true ) ) {
            $sanitized[] = $default_key;
        }
    }

    return implode( ',', $sanitized );
}


