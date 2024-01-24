/*jslint browser: true, devel: true, white: true, eqeq: true, plusplus: true, sloppy: true, vars: true*/
/*global $ */

/*************** General ***************/
const updateOutput = function (e) {
    const list = e.length ? e : $(e.target),
        output = list.data('output');
    if (window.JSON) {
        if (output) {
            const filteredList = removeCircularReferences(list.nestable('serialize'));
            output.val(JSON.stringify(filteredList));
        }
    } else {
        alert('JSON browser support required for this page.');
    }
};

const removeCircularReferences = (obj) => {
    const seen = new WeakSet();
    return JSON.parse(JSON.stringify(obj, (key, value) => {
        if (typeof value === 'object' && value !== null) {
            if (seen.has(value)) {
                return;
            }
            seen.add(value);
        }
        return value;
    }));
};

const nestableList = $("#nestable > .dd-list");

/***************************************/


/*************** Delete ***************/
const deleteFromMenuHelper = function (target) {
    if (target.data('new') === 1) {
        // if it's not yet saved in the database, just remove it from DOM
        target.fadeOut(function () {
            target.remove();
            updateOutput($('#nestable').data('output', $('#json-output')));
        });
    } else {
        // otherwise hide and mark it for deletion
        target.appendTo(nestableList); // if children, move to the top level
        target.data('deleted', '1');
        target.fadeOut();
    }
};

//lấy
$(function () {
    updateOutput($('#nestable').data('output', $('#json-output')));
});


/*!
 * Nestable jQuery Plugin - Copyright (c) 2012 David Bushell - http://dbushell.com/
 * Dual-licensed under the BSD or MIT licenses
 */
;(function ($, window, document, undefined) {
    const hasTouch = 'ontouchstart' in document;

    /**
     * Detect CSS pointer-events property
     * events are normally disabled on the dragging element to avoid conflicts
     * https://github.com/ausi/Feature-detection-technique-for-pointer-events/blob/master/modernizr-pointerevents.js
     */
    const hasPointerEvents = (function () {
        const el = document.createElement('div'),
            docEl = document.documentElement;
        if (!('pointerEvents' in el.style)) {
            return false;
        }
        el.style.pointerEvents = 'auto';
        el.style.pointerEvents = 'x';
        docEl.appendChild(el);
        const supports = window.getComputedStyle && window.getComputedStyle(el, '').pointerEvents === 'auto';
        docEl.removeChild(el);
        return !!supports;
    })();

    const defaults = {
        listNodeName: 'ol',
        itemNodeName: 'li',
        rootClass: 'dd',
        listClass: 'dd-list',
        itemClass: 'dd-item',
        dragClass: 'dd-dragel',
        handleClass: 'dd-handle',
        collapsedClass: 'dd-collapsed',
        placeClass: 'dd-placeholder',
        noDragClass: 'dd-nodrag',
        emptyClass: 'dd-empty',
        expandBtnHTML: '<button data-action="expand" type="button">Expand</button>',
        collapseBtnHTML: '<button data-action="collapse" type="button">Collapse</button>',
        group: 0,
        maxDepth: 5,
        threshold: 20
    };

    function Plugin(element, options) {
        this.w = $(document);
        this.el = $(element);
        this.options = $.extend({}, defaults, options);
        this.init();
    }

    Plugin.prototype = {

        init: function () {
            const list = this;

            list.reset();

            list.el.data('nestable-group', this.options.group);

            list.placeEl = $('<div class="' + list.options.placeClass + '"/>');

            $.each(this.el.find(list.options.itemNodeName), function (k, el) {
                list.setParent($(el));
            });

            list.el.on('click', 'button', function (e) {
                if (list.dragEl) {
                    return;
                }
                const target = $(e.currentTarget),
                    action = target.data('action'),
                    item = target.parent(list.options.itemNodeName);
                if (action === 'collapse') {
                    list.collapseItem(item);
                }
                if (action === 'expand') {
                    list.expandItem(item);
                }
            });

            const onStartEvent = function (e) {
                var handle = $(e.target);
                if (!handle.hasClass(list.options.handleClass)) {
                    if (handle.closest('.' + list.options.noDragClass).length) {
                        return;
                    }
                    handle = handle.closest('.' + list.options.handleClass);
                }

                if (!handle.length || list.dragEl) {
                    return;
                }

                list.isTouch = /^touch/.test(e.type);
                if (list.isTouch && e.touches.length !== 1) {
                    return;
                }

                e.preventDefault();
                list.dragStart(e.touches ? e.touches[0] : e);
            };

            const onMoveEvent = function (e) {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragMove(e.touches ? e.touches[0] : e);
                }
            };

            const onEndEvent = function (e) {
                if (list.dragEl) {
                    e.preventDefault();
                    list.dragStop(e.touches ? e.touches[0] : e);
                }
            };

            if (hasTouch) {
                list.el[0].addEventListener('touchstart', onStartEvent, false);
                window.addEventListener('touchmove', onMoveEvent, false);
                window.addEventListener('touchend', onEndEvent, false);
                window.addEventListener('touchcancel', onEndEvent, false);
            }

            list.el.on('mousedown', onStartEvent);
            list.w.on('mousemove', onMoveEvent);
            list.w.on('mouseup', onEndEvent);

        },

        serialize: function () {
            let data,
                depth = 0,
                list = this;
            let step = function (level, depth) {
                const array = [],
                    items = level.children(list.options.itemNodeName);
                items.each(function () {
                    const li = $(this),
                        item = $.extend({}, li.data()),
                        sub = li.children(list.options.listNodeName);
                    if (sub.length) {
                        item.children = step(sub, depth + 1);
                    }
                    array.push(item);
                });
                return array;
            };
            data = step(list.el.find(list.options.listNodeName).first(), depth);
            return data;
        },

        serialise: function () {
            return this.serialize();
        },

        reset: function () {
            this.mouse = {
                offsetX: 0,
                offsetY: 0,
                startX: 0,
                startY: 0,
                lastX: 0,
                lastY: 0,
                nowX: 0,
                nowY: 0,
                distX: 0,
                distY: 0,
                dirAx: 0,
                dirX: 0,
                dirY: 0,
                lastDirX: 0,
                lastDirY: 0,
                distAxX: 0,
                distAxY: 0
            };
            this.isTouch = false;
            this.moving = false;
            this.dragEl = null;
            this.dragRootEl = null;
            this.dragDepth = 0;
            this.hasNewRoot = false;
            this.pointEl = null;
        },

        expandItem: function (li) {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action="expand"]').hide();
            li.children('[data-action="collapse"]').show();
            li.children(this.options.listNodeName).show();
        },

        collapseItem: function (li) {
            const lists = li.children(this.options.listNodeName);
            if (lists.length) {
                li.addClass(this.options.collapsedClass);
                li.children('[data-action="collapse"]').hide();
                li.children('[data-action="expand"]').show();
                li.children(this.options.listNodeName).hide();
            }
        },

        expandAll: function () {
            const list = this;
            list.el.find(list.options.itemNodeName).each(function () {
                list.expandItem($(this));
            });
        },

        collapseAll: function () {
            const list = this;
            list.el.find(list.options.itemNodeName).each(function () {
                list.collapseItem($(this));
            });
        },

        setParent: function (li) {
            if (li.children(this.options.listNodeName).length) {
                li.prepend($(this.options.expandBtnHTML));
                li.prepend($(this.options.collapseBtnHTML));
            }
            li.children('[data-action="expand"]').hide();
        },

        unsetParent: function (li) {
            li.removeClass(this.options.collapsedClass);
            li.children('[data-action]').remove();
            li.children(this.options.listNodeName).remove();
        },

        dragStart: function (e) {
            const mouse = this.mouse,
                target = $(e.target),
                dragItem = target.closest(this.options.itemNodeName);

            this.placeEl.css('height', dragItem.height());

            mouse.offsetX = e.offsetX !== undefined ? e.offsetX : e.pageX - target.offset().left;
            mouse.offsetY = e.offsetY !== undefined ? e.offsetY : e.pageY - target.offset().top;
            mouse.startX = mouse.lastX = e.pageX;
            mouse.startY = mouse.lastY = e.pageY;

            this.dragRootEl = this.el;

            this.dragEl = $(document.createElement(this.options.listNodeName)).addClass(this.options.listClass + ' ' + this.options.dragClass);
            this.dragEl.css('width', dragItem.width());

            dragItem.after(this.placeEl);
            dragItem[0].parentNode.removeChild(dragItem[0]);
            dragItem.appendTo(this.dragEl);

            $(document.body).append(this.dragEl);
            this.dragEl.css({
                'left': e.pageX - mouse.offsetX,
                'top': e.pageY - mouse.offsetY
            });
            // total depth of dragging item
            let i, depth,
                items = this.dragEl.find(this.options.itemNodeName);
            for (i = 0; i < items.length; i++) {
                depth = $(items[i]).parents(this.options.listNodeName).length;
                if (depth > this.dragDepth) {
                    this.dragDepth = depth;
                }
            }
        },

        dragStop: function (e) {
            const el = this.dragEl.children(this.options.itemNodeName).first();
            el[0].parentNode.removeChild(el[0]);
            this.placeEl.replaceWith(el);

            this.dragEl.remove();
            this.el.trigger('change');
            if (this.hasNewRoot) {
                this.dragRootEl.trigger('change');
            }
            this.reset();
        },

        dragMove: function (e) {
            let list, parent, prev, next, depth,
                opt = this.options,
                mouse = this.mouse;

            this.dragEl.css({
                'left': e.pageX - mouse.offsetX,
                'top': e.pageY - mouse.offsetY
            });

            // mouse position last events
            mouse.lastX = mouse.nowX;
            mouse.lastY = mouse.nowY;
            // mouse position this events
            mouse.nowX = e.pageX;
            mouse.nowY = e.pageY;
            // distance mouse moved between events
            mouse.distX = mouse.nowX - mouse.lastX;
            mouse.distY = mouse.nowY - mouse.lastY;
            // direction mouse was moving
            mouse.lastDirX = mouse.dirX;
            mouse.lastDirY = mouse.dirY;
            // direction mouse is now moving (on both axis)
            mouse.dirX = mouse.distX === 0 ? 0 : mouse.distX > 0 ? 1 : -1;
            mouse.dirY = mouse.distY === 0 ? 0 : mouse.distY > 0 ? 1 : -1;
            // axis mouse is now moving on
            const newAx = Math.abs(mouse.distX) > Math.abs(mouse.distY) ? 1 : 0;

            // do nothing on first move
            if (!mouse.moving) {
                mouse.dirAx = newAx;
                mouse.moving = true;
                return;
            }

            // calc distance moved on this axis (and direction)
            if (mouse.dirAx !== newAx) {
                mouse.distAxX = 0;
                mouse.distAxY = 0;
            } else {
                mouse.distAxX += Math.abs(mouse.distX);
                if (mouse.dirX !== 0 && mouse.dirX !== mouse.lastDirX) {
                    mouse.distAxX = 0;
                }
                mouse.distAxY += Math.abs(mouse.distY);
                if (mouse.dirY !== 0 && mouse.dirY !== mouse.lastDirY) {
                    mouse.distAxY = 0;
                }
            }
            mouse.dirAx = newAx;

            /**
             * move horizontal
             */
            if (mouse.dirAx && mouse.distAxX >= opt.threshold) {
                // reset move distance on x-axis for new phase
                mouse.distAxX = 0;
                prev = this.placeEl.prev(opt.itemNodeName);
                // increase horizontal level if previous sibling exists and is not collapsed
                if (mouse.distX > 0 && prev.length && !prev.hasClass(opt.collapsedClass)) {
                    // cannot increase level when item above is collapsed
                    list = prev.find(opt.listNodeName).last();
                    // check if depth limit has reached
                    depth = this.placeEl.parents(opt.listNodeName).length;
                    if (depth + this.dragDepth <= opt.maxDepth) {
                        // create new sub-level if one doesn't exist
                        if (!list.length) {
                            list = $('<' + opt.listNodeName + '/>').addClass(opt.listClass);
                            list.append(this.placeEl);
                            prev.append(list);
                            this.setParent(prev);
                        } else {
                            // else append to next level up
                            list = prev.children(opt.listNodeName).last();
                            list.append(this.placeEl);
                        }
                    }
                }
                // decrease horizontal level
                if (mouse.distX < 0) {
                    // we can't decrease a level if an item preceeds the current one
                    next = this.placeEl.next(opt.itemNodeName);
                    if (!next.length) {
                        parent = this.placeEl.parent();
                        this.placeEl.closest(opt.itemNodeName).after(this.placeEl);
                        if (!parent.children().length) {
                            this.unsetParent(parent.parent());
                        }
                    }
                }
            }

            let isEmpty = false;

            // find list item under cursor
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'hidden';
            }
            this.pointEl = $(document.elementFromPoint(e.pageX - document.body.scrollLeft, e.pageY - (window.pageYOffset || document.documentElement.scrollTop)));
            if (!hasPointerEvents) {
                this.dragEl[0].style.visibility = 'visible';
            }
            if (this.pointEl.hasClass(opt.handleClass)) {
                this.pointEl = this.pointEl.parent(opt.itemNodeName);
            }
            if (this.pointEl.hasClass(opt.emptyClass)) {
                isEmpty = true;
            } else if (!this.pointEl.length || !this.pointEl.hasClass(opt.itemClass)) {
                return;
            }

            // find parent list of item under cursor
            const pointElRoot = this.pointEl.closest('.' + opt.rootClass),
                isNewRoot = this.dragRootEl.data('nestable-id') !== pointElRoot.data('nestable-id');

            /**
             * move vertical
             */
            if (!mouse.dirAx || isNewRoot || isEmpty) {
                // check if groups match if dragging over new root
                if (isNewRoot && opt.group !== pointElRoot.data('nestable-group')) {
                    return;
                }
                // check depth limit
                depth = this.dragDepth - 1 + this.pointEl.parents(opt.listNodeName).length;
                if (depth > opt.maxDepth) {
                    return;
                }
                const before = e.pageY < (this.pointEl.offset().top + this.pointEl.height() / 2);
                parent = this.placeEl.parent();
                // if empty create new list to replace empty placeholder
                if (isEmpty) {
                    list = $(document.createElement(opt.listNodeName)).addClass(opt.listClass);
                    list.append(this.placeEl);
                    this.pointEl.replaceWith(list);
                } else if (before) {
                    this.pointEl.before(this.placeEl);
                } else {
                    this.pointEl.after(this.placeEl);
                }
                if (!parent.children().length) {
                    this.unsetParent(parent.parent());
                }
                if (!this.dragRootEl.find(opt.itemNodeName).length) {
                    this.dragRootEl.append('<div class="' + opt.emptyClass + '"/>');
                }
                // parent root list has changed
                if (isNewRoot) {
                    this.dragRootEl = pointElRoot;
                    this.hasNewRoot = this.el[0] !== this.dragRootEl[0];
                }
            }
        }

    };

    $.fn.nestable = function (params) {
        let lists = this,
            retval = this;


        lists.each(function () {
            const plugin = $(this).data("nestable");

            if (!plugin) {
                $(this).data("nestable", new Plugin(this, params));
                $(this).data("nestable-id", new Date().getTime());
            } else {
                if (typeof params === 'string' && typeof plugin[params] === 'function') {
                    retval = plugin[params]();
                }
            }
        });

        return retval || lists;
    };

})(window.jQuery || window.Zepto, window, document);

// Get the add button in each accordion item
var addButtons = document.querySelectorAll('.accordion-item .btn-primary');

// Loop through each add button and add a click event listener
addButtons.forEach(function (button) {
    $(button).on('click', function () {
        var checkboxes = $(this).closest('.accordion-item').find('input[type="checkbox"]:checked');
        var newLiArray = checkboxes.map(function () {
            var id = $(this).val();
            var table =$(this).attr('data-table');
            return $('<li>', {
                'class': 'dd-item',
                'data-name': $(this).next().text().trim(),
                'data-id': id,
                'data-icon': $(this).icon ? $(this).icon : '',
                'data-slug': $(this).attr('data-slug'),
                'data-item-id': id,
                'data-table': table,
                'data-new': '1',
                'data-deleted': '0',
                html: '<div class="dd-handle">' + $(this).next().text().trim() + '</div>' +
                    '<span id="btn-delete" class="button-delete btn btn-danger btn-xs pull-right" style="padding:0;" data-owner-id="' + id + '"  data-owner-table="'+table+'">' +
                    '<i class="bx bx-x" aria-hidden="true"></i></span>' +
                    '<span class="button-edit btn btn-success btn-xs pull-right" type="button" data-bs-toggle="modal" data-bs-target="#modalCenter" style="padding:0;" data-owner-id="' + id + '" data-item-id="' + id + '"  data-owner-table="'+table+'" data-owner-name="' + id + '">' +
                    '<i class="bx bxs-pencil" aria-hidden="true"></i></span>'
            });
        }).get();

        var ol = $('#nestable ol').first();
        checkboxes.prop('checked', false);
        ol.append(newLiArray);
        init_delete_item();

        let data = $('.dd').nestable('serialize');
        $('textarea[name="data"]').val(JSON.stringify(data)).trigger('input');
    });
});
init_delete_item()

// Thêm sự kiện click cho nút "Thêm"
$('#menu-add-link').click(function (event) {
    event.preventDefault();

    // Lấy giá trị từ các trường nhập liệu
    var name = $('#addInputSlug').val();
    var url = $('#basic-default-slug').val();
    var id = 0;

    // Tạo một phần tử li mới với các thuộc tính tương ứng
    var newLi = $('<li>', {
        'class': 'dd-item',
        'data-name': name,
        'data-id': id,
        'data-icon': '',
        'data-slug': url.toLowerCase().replace(/\s+/g, "-"),
        'data-new': '1',
        'data-item-id': id,
        'data-table': 'default',
        'data-deleted': '0',
        html: '<div class="dd-handle">' + name + '</div>' +
            '<span id="btn-delete" class="button-delete btn btn-danger btn-xs pull-right" style="padding:0;" data-owner-id="' + id + '" data-owner-table ="default">' +
            '<i class="bx bx-x" aria-hidden="true"></i></span>' +
            '<span class="button-edit btn btn-success btn-xs pull-right" type="button" data-bs-toggle="modal" data-bs-target="#modalCenter" style="padding:0;" data-owner-id="' + id + '" data-owner-name="' + name + '">' +
            '<i class="bx bxs-pencil" aria-hidden="true"></i></span>'
    });

    // Thêm phần tử li mới vào cuối danh sách dạng cây
    $('#nestable ol').append(newLi);

    // Đặt lại giá trị của các trường nhập liệu
    $('#addInputSlug').val('');
    $('#basic-default-slug').val('');

    // Cập nhật giá trị của textarea chứa dữ liệu danh sách dạng cây
    let data = $('.dd').nestable('serialize');
    $('textarea[name="data"]').val(JSON.stringify(data)).trigger('input');

    // Khởi tạo sự kiện xóa phần tử và sự kiện sửa phần tử cho phần tử li mới
    init_delete_item();
});

function init_delete_item() {
    $('.button-delete').click(function () {
        const ownerId = $(this).data('owner-id');
        const ownerTable = $(this).data('owner-table');
        const item = $('[data-id="' + ownerId + '"][owner-table="' + ownerTable + '"]');
        item.remove();
    });
}

$(document).on('click', '.button-edit', function (e) {
    let __this = this
    let name_input = $(__this).closest('.dd-item').attr('data-name')
    let icon_input = $(__this).closest('.dd-item').attr('data-icon') != '' ? $(__this).closest('.dd-item').attr('data-icon') : ''
    let input_id = $(__this).closest('.dd-item').attr('data-id')
    let input_table = $(__this).closest('.dd-item').attr('data-table')
    let item_id = $(__this).closest('.dd-item').attr('data-item-id')
    $("#nameWithTitle").attr("value", name_input);
    $('.input_id').val(input_id)
    $('.input_item_id').val(item_id)
    $('.input_table').val(input_table)
    $('#modalCenter').find("#nameWithTitle").val(name_input);
    $('#modalCenter').find("#iconWithTitle").val(icon_input);
    // $('#modalCenter').find("#iconWithTitle").val(item_id);
})

$(document).on('click', '.save-changes', function (e) {
    e.stopPropagation();
    let __this = this;
    let id = $(__this).closest('#modalCenter').find('.input_id').val();
    let table = $(__this).closest('#modalCenter').find('.input_table').val();
    let new_name = $(__this).closest('#modalCenter').find("#nameWithTitle").val();
    let new_icon = $(__this).closest('#modalCenter').find("#iconWithTitle").val();

    $(".dd-item[data-id=" + id + "][data-table=" + table + "]").attr('data-icon', new_icon);
    $(".dd-item[data-id=" + id + "][data-table=" + table + "]").attr('data-name', new_name);
    $(".dd-item[data-id=" + id + "][data-table=" + table + "]").find('.dd-handle:first').html(new_name);

    return false;
  });


// }
