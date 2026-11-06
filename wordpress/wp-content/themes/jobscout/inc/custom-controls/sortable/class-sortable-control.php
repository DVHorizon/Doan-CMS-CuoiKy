<?php
/**
 * JobScout Sortable Customizer Control
 *
 * @package JobScout
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

if ( ! class_exists( 'JobScout_Sortable_Control' ) ) {
    /**
     * Sortable control class for drag-and-drop section reordering.
     */
    class JobScout_Sortable_Control extends WP_Customize_Control {

        /**
         * Control type.
         *
         * @var string
         */
        public $type = 'jobscout_sortable';

        /**
         * Enqueue control scripts and styles.
         */
        public function enqueue() {
            $version = defined( 'JOBSCOUT_THEME_VERSION' ) ? JOBSCOUT_THEME_VERSION : false;

            wp_enqueue_script( 'jquery-ui-sortable' );

            wp_enqueue_style(
                'jobscout-sortable',
                get_template_directory_uri() . '/inc/custom-controls/sortable/sortable.css',
                array(),
                $version
            );

            wp_enqueue_script(
                'jobscout-sortable',
                get_template_directory_uri() . '/inc/custom-controls/sortable/sortable.js',
                array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ),
                $version,
                true
            );
        }

        /**
         * Render control content.
         */
        public function render_content() {
            $choices = is_array( $this->choices ) ? $this->choices : array();
            $values  = $this->value();
            $ordered = array();

            if ( is_array( $values ) ) {
                $ordered = $values;
            } elseif ( is_string( $values ) && '' !== trim( $values ) ) {
                $trimmed = trim( $values );
                if ( strpos( $trimmed, '[' ) === 0 ) {
                    $decoded = json_decode( $trimmed, true );
                    $ordered = is_array( $decoded ) ? $decoded : explode( ',', $trimmed );
                } else {
                    $ordered = explode( ',', $trimmed );
                }
            }

            $clean_ordered = array();
            if ( ! empty( $choices ) ) {
                foreach ( $ordered as $item ) {
                    if ( ! is_scalar( $item ) ) {
                        continue;
                    }
                    $key = sanitize_key( trim( (string) $item ) );
                    if ( isset( $choices[ $key ] ) && ! in_array( $key, $clean_ordered, true ) ) {
                        $clean_ordered[] = $key;
                    }
                }

                foreach ( array_keys( $choices ) as $key ) {
                    if ( ! in_array( $key, $clean_ordered, true ) ) {
                        $clean_ordered[] = $key;
                    }
                }
            }

            $value_str = implode( ',', $clean_ordered );
            ?>
            <div class="jobscout-sortable-control-wrapper">
                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>

                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

                <ul class="jobscout-sortable-list">
                    <?php foreach ( $clean_ordered as $key ) :
                        $label = isset( $choices[ $key ] ) ? $choices[ $key ] : $key;
                    ?>
                        <li class="jobscout-sortable-item" data-id="<?php echo esc_attr( $key ); ?>" data-value="<?php echo esc_attr( $key ); ?>">
                            <span class="dashicons dashicons-menu sort-handle" title="<?php esc_attr_e( 'Drag to reorder', 'jobscout' ); ?>"></span>
                            <span class="jobscout-sortable-title"><?php echo esc_html( $label ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <input type="hidden" class="jobscout-sortable-value" <?php $this->link(); ?> value="<?php echo esc_attr( $value_str ); ?>" />
            </div>
            <?php
        }
    }
}
