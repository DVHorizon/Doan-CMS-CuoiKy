/**
 * JobScout Sortable Customizer Control Script
 *
 * Handles drag-and-drop section reordering using WordPress core jQuery UI Sortable.
 *
 * @package JobScout
 */
(function($, api) {
    'use strict';

    if (!api || !api.controlConstructor) {
        return;
    }

    var SortableControl = api.Control.extend({
        ready: function() {
            var control = this;
            var container = control.container;
            var list = container.find('.jobscout-sortable-list');
            var input = container.find('.jobscout-sortable-value');

            list.sortable({
                items: '> li.jobscout-sortable-item',
                handle: '.dashicons-menu, .sort-handle, .jobscout-sortable-title',
                axis: 'y',
                cursor: 'grab',
                placeholder: 'jobscout-sortable-placeholder',
                update: function(event, ui) {
                    var order = [];
                    list.find('li.jobscout-sortable-item').each(function() {
                        var id = $(this).attr('data-id') || $(this).data('id');
                        if (id) {
                            order.push(id);
                        }
                    });

                    var orderStr = order.join(',');
                    input.val(orderStr).trigger('change');

                    if (control.setting) {
                        control.setting.set(orderStr);
                    }
                }
            });
        }
    });

    api.controlConstructor['jobscout-sortable'] = SortableControl;
    api.controlConstructor['jobscout_sortable'] = SortableControl;

    $(document).ready(function() {
        $('.jobscout-sortable-list').each(function() {
            var list = $(this);
            if (!list.hasClass('ui-sortable')) {
                list.sortable({
                    items: '> li.jobscout-sortable-item',
                    handle: '.dashicons-menu, .sort-handle, .jobscout-sortable-title',
                    axis: 'y',
                    cursor: 'grab',
                    placeholder: 'jobscout-sortable-placeholder',
                    update: function(event, ui) {
                        var order = [];
                        list.find('li.jobscout-sortable-item').each(function() {
                            var id = $(this).attr('data-id') || $(this).data('id');
                            if (id) {
                                order.push(id);
                            }
                        });
                        var orderStr = order.join(',');
                        list.siblings('.jobscout-sortable-value').val(orderStr).trigger('change');
                    }
                });
            }
        });
    });

})(jQuery, wp.customize);
