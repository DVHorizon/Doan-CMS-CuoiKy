<?php
/**
 * JobScout Sortable Section Repeater Control
 * 
 * Cho phép sắp xếp thứ tự các section kéo thả hoặc bật/tắt (ẩn/hiện) trực quan trong Customizer.
 * 
 * @package JobScout
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return;
}

class JobScout_Sortable_Sections_Control extends WP_Customize_Control {

    public $type = 'jobscout_sortable_sections';

    public function enqueue() {
        wp_enqueue_script( 'jquery-ui-sortable' );
    }

    public function render_content() {
        if ( empty( $this->choices ) ) {
            return;
        }

        $values = $this->value();
        if ( ! is_array( $values ) ) {
            $decoded = json_decode( (string) $values, true );
            $values = is_array( $decoded ) ? $decoded : array_keys( $this->choices );
        }

        // Đảm bảo tất cả choices đều có mặt trong values
        foreach ( array_keys( $this->choices ) as $key ) {
            if ( ! in_array( $key, $values, true ) ) {
                $values[] = $key;
            }
        }
        ?>
        <div class="jobscout-sortable-control-wrapper">
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <ul class="jobscout-sortable-list" id="<?php echo esc_attr( $this->id ); ?>_sortable_list">
                <?php foreach ( $values as $key ) : 
                    if ( ! isset( $this->choices[ $key ] ) ) continue;
                    $label = $this->choices[ $key ];
                ?>
                    <li class="jobscout-sortable-item" data-value="<?php echo esc_attr( $key ); ?>">
                        <span class="dashicons dashicons-menu drag-handle" title="<?php esc_attr_e( 'Kéo thả để sắp xếp', 'jobscout' ); ?>"></span>
                        <span class="item-title"><?php echo esc_html( $label ); ?></span>
                        <span class="item-badge"><?php echo esc_html( $key ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> value="<?php echo esc_attr( is_array( $this->value() ) ? json_encode( $this->value() ) : $this->value() ); ?>" />
        </div>

        <style>
            .jobscout-sortable-list {
                margin: 10px 0 0 0;
                padding: 0;
                list-style: none;
            }
            .jobscout-sortable-item {
                display: flex;
                align-items: center;
                background: #ffffff;
                border: 1px solid #cbd5e1;
                border-radius: 6px;
                padding: 8px 12px;
                margin-bottom: 8px;
                cursor: grab;
                transition: all 0.2s ease;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
            .jobscout-sortable-item:active {
                cursor: grabbing;
            }
            .jobscout-sortable-item.ui-sortable-helper {
                background: #f8fafc;
                border-color: #ea580c;
                box-shadow: 0 8px 20px rgba(234, 88, 12, 0.2);
            }
            .jobscout-sortable-item .drag-handle {
                color: #64748b;
                margin-right: 10px;
                cursor: grab;
                font-size: 18px;
                width: 18px;
                height: 18px;
            }
            .jobscout-sortable-item:hover .drag-handle {
                color: #ea580c;
            }
            .jobscout-sortable-item .item-title {
                flex: 1;
                font-weight: 600;
                font-size: 13px;
                color: #1e293b;
            }
            .jobscout-sortable-item .item-badge {
                font-size: 11px;
                background: #f1f5f9;
                color: #64748b;
                padding: 2px 6px;
                border-radius: 4px;
                font-family: monospace;
            }
            .jobscout-sortable-placeholder {
                background: #ffedd5;
                border: 1px dashed #ea580c;
                border-radius: 6px;
                height: 38px;
                margin-bottom: 8px;
            }
        </style>

        <script>
        jQuery(document).ready(function($) {
            var listId = '#<?php echo esc_js( $this->id ); ?>_sortable_list';
            var inputId = '#<?php echo esc_js( $this->id ); ?>';

            $(listId).sortable({
                handle: '.drag-handle, .item-title',
                placeholder: 'jobscout-sortable-placeholder',
                axis: 'y',
                update: function(event, ui) {
                    var order = [];
                    $(listId + ' .jobscout-sortable-item').each(function() {
                        order.push($(this).data('value'));
                    });
                    $(inputId).val(JSON.stringify(order)).trigger('change');
                }
            });
        });
        </script>
        <?php
    }
}

