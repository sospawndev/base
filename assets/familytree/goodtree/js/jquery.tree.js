(function($) {
    "use strict";
    $.fn.tree_structure = function(options) {
        var defaults = {
            'add_option': false,
            'edit_option': false,
            'delete_option': false,
            'confirm_before_delete': false,
            'fullwidth_option': false,
            'align_option': 'center',
            'draggable_option': false
        };
        return this.each(function() {
            if (options) {
                $.extend(defaults, options);
            }

            // Remove all event listeners on destroy plugin
            $.fn.tree_structure.destroy = function() {
                $(document).off('click', '.' + class_name + '[rel = ' + tree_id + '] span.add_action');
                $(document).off('click', '.' + class_name + '[rel = ' + tree_id + '] span.edit_action');
                $(document).off('click', '.' + class_name + '[rel = ' + tree_id + '] span.delete_action');
                $(document).off('click', '.' + class_name + '[rel = ' + tree_id + '] b.thide');
                $(document).off('mouseenter mouseleave', '.' + class_name + '[rel = ' + tree_id + '] li > div');
                $(document).off('click', '.' + class_name + '[rel = ' + tree_id + '] span.highlight');
                $(document).off('click', '.tree_view_popup .close');
                $(document).off('click', 'input.submit');
                $(document).off('click', 'img.close');
                $(document).off('click', 'input.edit');
            }

            // Options
            var add_option = defaults['add_option']; // Add a new branch to the tree by clicking on add icon. default value is false.
            var edit_option = defaults['edit_option']; // Update particular branch by clicking on edit icon. default value is false.
            var delete_option = defaults['delete_option']; // Delete particular branch with all child branches by clicking on delete icon. default value is false.
            var confirm_before_delete = defaults['confirm_before_delete']; // Confirm before delete any branch. default value is false.
            var fullwidth_option = defaults['fullwidth_option']; // If this is true then tree structure gets full width. if width is bigger than browser width then tree structure set with a horizontal scroll. default value is false.
            var align_option = defaults['align_option']; // Set the alignment of a tree structure with this option. options are left, right and center. default value is 'center'.
            var draggable_option = defaults['draggable_option']; // Perform a drag-and-drop operation with tree branches. Drag the tree branch which we want to move and then drop the dragged branch on the destination branch. The dragged branch will now bound to the destination branch. default value is false.

            // Common variables
            var vertical_line_text = '<span class="vertical"></span>';
            var horizontal_line_text = '<span class="horizontal"></span>';
            var add_action_text = add_option == true ? '<span class="add_action" title="Add"></span>' : '';
            var edit_action_text = edit_option == true ? '<span class="edit_action" title="Update"></span>' : '';
            var delete_action_text = delete_option == true ? '<span class="delete_action" title="Delete"></span>' : '';
            var highlight_text = '<span class="highlight" title="Highlight"></span>';
            var class_name = $(this).attr('class');
            var tree_id = $(this).attr('rel');
            var event_name = 'pageload';

            if (align_option != 'center') {
                $('.' + class_name + '[rel = ' + tree_id + '] li').css({'text-align': align_option});
            }

            // If fullwidth_option is true
            if (fullwidth_option) {
                var i = 0;
                var prev_width;
                var get_element;
                if ($('.' + class_name + '[rel = ' + tree_id + '] li li').length > 0) {
                    $('.' + class_name + '[rel = ' + tree_id + '] li li').each(function() {
                        var this_width = $(this).width();
                        if (i == 0 || this_width > prev_width) {
                            prev_width = $(this).width();
                            get_element = $(this);
                        }
                        i++;
                    });
                    var loop = get_element.closest('ul').children('li').eq(0).nextAll().length;
                    var fullwidth = parseInt(0);
                    for (var j = 0; j <= loop; j++) {
                        fullwidth += parseInt(get_element.closest('ul').children('li').eq(j).outerWidth(), 10);
                    }
                    $('.' + class_name + '[rel = ' + tree_id + ']').closest('div').width(fullwidth + 750);
                }
            }

            $('.' + class_name + '[rel = ' + tree_id + '] li.thide').each(function() {
                $(this).children('ul').hide();
            });

            // Update HTML structure to each branch by adding vertical and horizontal lines and action buttons
            function prepend_data(target) {
                target.prepend(vertical_line_text + horizontal_line_text).children('div').prepend(add_action_text + delete_action_text + edit_action_text);
                if (target.children('ul').length != 0) {
                    target.hasClass('thide') ? target.children('div').prepend('<b class="thide tshow"></b>') : target.children('div').prepend('<b class="thide"></b>');
                }
                target.children('div').prepend(highlight_text);
            }

            // Draw lines between each branch to show the relations
            function draw_line(target) {
                var tree_offset_left = $('.' + class_name + '[rel = ' + tree_id + ']').offset().left;
                tree_offset_left = parseInt(tree_offset_left, 10);
                var child_width = target.children('div').outerWidth(true) / 2;
                var child_left = target.children('div').offset().left;
                if (target.parents('li').offset() != null) {
                    var parent_child_height = target.parents('li').offset().top;
                }
                var vertical_height = (target.offset().top - parent_child_height) - target.parents('li').children('div').outerHeight(true) / 2;
                target.children('span.vertical').css({'height': vertical_height, 'margin-top': -vertical_height, 'margin-left': child_width, 'left': child_left - tree_offset_left});
                if (target.parents('li').offset() == null) {
                    var width = 0;
                } else {
                    var parents_width = target.parents('li').children('div').offset().left + (target.parents('li').children('div').width() / 2);
                    var current_width = child_left + (target.children('div').width() / 2);
                    var width = parents_width - current_width;
                }
                var horizontal_left_margin = width < 0 ? -Math.abs(width) + child_width : child_width;
                target.children('span.horizontal').css({'width': Math.abs(width), 'margin-top': -vertical_height, 'margin-left': horizontal_left_margin, 'left': child_left - tree_offset_left});
            }

            // Update tree structure
            function call_structure() {
                $('.' + class_name + '[rel = ' + tree_id + '] li').each(function() {
                    if (event_name == 'pageload') {
                        prepend_data($(this));
                    }
                    draw_line($(this));
                });
            }

            call_structure();

            event_name = 'others';

            $(window).resize(function() {
                call_structure();
            });

            // Extend and shrink all child branches by click on show/hide button
            $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] b.thide', function() {
                $(this).toggleClass('tshow');
                $(this).closest('li').toggleClass('thide').children('ul').toggle();
                call_structure();
            });

            // Change the branch color by its relation with parent and child branch on mouse movement
            $(document).on("mouseenter mouseleave", '.' + class_name + '[rel = ' + tree_id + '] li > div', function(event) {
                if (event.type == 'mouseenter' || event.type == 'mouseover') {
                    $('.' + class_name + '[rel = ' + tree_id + '] li > div.current').removeClass('current');
                    $('.' + class_name + '[rel = ' + tree_id + '] li > div.children').removeClass('children');
                    $('.' + class_name + '[rel = ' + tree_id + '] li > div.parent').removeClass('parent');
                    $(this).addClass('current');
                    $(this).closest('li').children('ul').children('li').children('div').addClass('children');
                    $(this).closest('li').closest('ul').closest('li').children('div').addClass('parent');
                    $(this).children('span.highlight, span.add_action, span.delete_action, span.edit_action').show();
                } else {
                    $(this).children('span.highlight, span.add_action, span.delete_action, span.edit_action').hide();
                }
            });

            // Display particular branch only with their parent and child branches
            $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] span.highlight', function() {
                if ($(this).closest("ul").attr("class") != "tree") {
                    $('.' + class_name + '[rel = ' + tree_id + '] li.highlight').removeClass('highlight');
                    $('.' + class_name + '[rel = ' + tree_id + '] li > div.parent').removeClass('parent');
                    $('.' + class_name + '[rel = ' + tree_id + '] li > div.children').removeClass('children');
                    $(this).closest('li').addClass('highlight');
                    $('.highlight li > div').addClass('children');
                    var _this = $(this).closest('li').closest('ul').closest('li');
                    find_parent(_this);

                    if (fullwidth_option) {
                        $('.' + class_name + '[rel = ' + tree_id + ']').parent('div').parent('div').scrollLeft(0);
                    }

                    $('.' + class_name + '[rel = ' + tree_id + '] li > div').not(".parent, .current, .children").closest('li').addClass('tnone');
                    $('.' + class_name + '[rel = ' + tree_id + '] li div b.thide.tshow').closest('div').closest('li').children('ul').addClass('tshow');
                    $('.' + class_name + '[rel = ' + tree_id + '] li div b.thide').addClass('tnone');
                    if ($('.back_btn').length == 0) {
                        $('.' + class_name + '[rel = ' + tree_id + ']').prepend('<img src="images/back.png" class="back_btn" />');
                    }
                    call_structure();

                    $('.back_btn').click(function() {
                        $('.' + class_name + '[rel = ' + tree_id + '] ul.tshow').removeClass('tshow');
                        $('.' + class_name + '[rel = ' + tree_id + '] li.tnone').removeClass('tnone');
                        $('.' + class_name + '[rel = ' + tree_id + '] li div b.thide').removeClass('tnone');
                        $(this).remove();
                        call_structure();
                    });
                }
            });

            function find_parent(_this) {
                if (_this.length > 0) {
                    _this.children('div').addClass('parent');
                    _this = _this.closest('li').closest('ul').closest('li');
                    return find_parent(_this);
                }
            }

            // Display branch details in popup by click on view button
            if ($('.' + class_name + '[rel = ' + tree_id + '] .view_btn').length > 0) {
                $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] .view_btn', function() {
                    var view_ele_id = $(this).closest("div").attr("id");
                    var data = {
                        action: 'viewdetail',
                        view_ele_id: view_ele_id,
                        tree_id: tree_id
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'admin-ajax.php',
                        data: data,
                        success: function(data) {
                            $("body").append(data);
                        }
                    });
                });

                $(document).on("click", '.tree_view_popup .close', function() {
                    $(this).closest(".tree_view_popup").remove();
                });
            }

            // Functionality to add new branch by click on add icon
            if (add_option) {
                $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] span.add_action', function() {
                    var _this = $(this);
                    _this.closest("div").find("span.add_action, span.edit_action, span.delete_action, span.highlight").hide();
                    if ($('form.add_data').length > 0) {
                        $('form.add_data').remove();
                    }
                    if ($('form.edit_data').length > 0) {
                        $('form.edit_data').remove();
                    }

                    var data = {
                        action: 'addform',
                        tree_id: tree_id
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'admin-ajax.php',
                        data: data,
                        success: function(data) {
                            var addquery = data;
                            $(".form_box").remove();
                            _this.closest('.tree').find('.z-index').removeClass('z-index');
                            _this.parent('div').addClass('z-index').append("<section class='form_box'>" + addquery + "</section>");
                        }
                    });

                    $(document).on("click", "input.submit", function(event) {
                        var _addthis = $(this);
                        var ajax_add_id;
                        event.preventDefault();
                        var parent_id = _addthis.closest('div').attr('id');
                        var data = new FormData(_addthis.closest('form')[0]);
                        var params = "action=add&parent_id=" + parent_id + "&tree_id=" + tree_id;
                        _addthis.closest("li").before("<img src='images/load.gif' class='load' />");
                        $.ajax({
                            type: 'POST',
                            url: 'admin-ajax.php?' + params,
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function(data) {
                                $("img.load").remove();
                                var obj = jQuery.parseJSON(data);
                                if (obj.msg === false) {
                                    alert(obj.msg_text);
                                } else {
                                    $(document).off("click", "input.submit");
                                    var element_target = _addthis.closest('form.add_data').closest('li');
                                    _addthis.closest('form.add_data').find(".close").trigger("click");
                                    element_target.append(obj.html);
                                    if (!edit_option) {
                                        element_target.find("#"+obj.msg_text).find(".edit_action").remove();
                                    }
                                    if (!delete_option) {
                                        element_target.find("#"+obj.msg_text).find(".delete_action").remove();
                                    }
                                    call_structure();
                                    if (draggable_option) {
                                        draggable_event();
                                    }
                                }
                            }
                        });
                    });

                    $(document).on("click", "img.close", function() {
                        $(document).off("click", "input.submit");
                        $(this).closest('.tree').find('.z-index').removeClass('z-index');
                        $(this).closest('.form_box').remove();
                    });
                });
            }

            // Functionality to update branch by click on edit icon
            if (edit_option) {
                $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] span.edit_action', function() {
                    var _this = $(this);
                    _this.closest("div").find("span.add_action, span.edit_action, span.delete_action, span.highlight").hide();
                    if ($('form.add_data').length > 0) {
                        $('form.add_data').remove();
                    }
                    if ($('form.edit_data').length > 0) {
                        $('form.edit_data').remove();
                    }
                    var edit_ele_id = _this.closest("div").attr("id");
                    var data = {
                        action: 'editform',
                        edit_ele_id: edit_ele_id,
                        tree_id: tree_id
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'admin-ajax.php',
                        data: data,
                        success: function(data) {
                            var editquery = data;
                            $(".form_box").remove();
                            _this.closest('.tree').find('.z-index').removeClass('z-index');
                            _this.closest('div').addClass('z-index').append("<section class='form_box'>" + editquery + "</section>");
                        }
                    });

                    $(document).on("click", "input.edit", function(event) {
                        var _editthis = $(this);
                        event.preventDefault();
                        var parent_id = _editthis.closest('div').attr('id');
                        var params = "action=edit&id=" + parent_id;
                        var data = new FormData(_editthis.closest('form')[0]);
                        _editthis.closest("li").before("<img src='images/load.gif' class='load' />");
                        $.ajax({
                            type: 'POST',
                            url: 'admin-ajax.php?' + params,
                            data: data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function(data) {
                                $("img.load").remove();
                                var obj = jQuery.parseJSON(data);
                                if (obj.msg === false) {
                                    alert(obj.msg_text);
                                } else {
                                    $(document).off("click", "input.edit");
                                    if (_editthis.closest('form').find('input:checked').length > 0) {
                                        if (_editthis.closest('li').hasClass('thide') == false) {
                                            _editthis.closest('div').find('b.thide').trigger('click');
                                        }
                                    } else {
                                        if (_editthis.closest('li').hasClass('thide')) {
                                            _editthis.closest('div').find('b.thide').trigger('click');
                                        }
                                    }
                                    var element_target = _editthis.closest('form.edit_data').closest('div');
                                    _editthis.closest('form.edit_data').find(".close").trigger("click");
                                    element_target.find(".title").text(obj.title);
                                    if (obj.img) {
                                        element_target.find(".img").attr("src", obj.img);
                                    }
                                    call_structure();
                                }
                            }
                        });
                    });

                    $(document).on("click", "img.close", function() {
                        $(document).off("click", "input.edit");
                        $(this).closest('.tree').find('.z-index').removeClass('z-index');
                        $(this).closest('.form_box').remove();
                    });
                });
            }

            // Functionality to delete branch by click on delete icon
            if (delete_option) {
                $(document).on("click", '.' + class_name + '[rel = ' + tree_id + '] span.delete_action', function() {
                    var _deletethis = $(this);
                    if (_deletethis.closest('div').attr('id') == 1) {
                        alert("You cant delete root person");
                    } else {
                        var target_element = _deletethis.closest('li').closest('ul').closest('li');
                        var confirm_message = 1;
                        if (confirm_before_delete) {
                            var confirm_text = _deletethis.closest('li').children('ul').length === 0 ? "Do you want to deleat this?" : "Do you want to deleat this with\nall child elements?";
                            confirm_message = confirm(confirm_text);
                        }
                        if (confirm_message) {
                            _deletethis.closest('li').addClass('ajax_delete_all');
                            var ajax_delete_id = Array();
                            ajax_delete_id.push(_deletethis.closest('div').attr('id'));
                            $('.ajax_delete_all li').each(function() {
                                ajax_delete_id.push($(this).children('div').attr('id'));
                            });
                            _deletethis.closest('li').removeClass('ajax_delete_all');
                            var data = {
                                action: 'delete',
                                id: ajax_delete_id,
                                tree_id: tree_id
                            };
                            _deletethis.closest("li").before("<img src='images/load.gif' class='load' />");

                            $.ajax({
                                type: 'POST',
                                url: 'admin-ajax.php',
                                data: data,
                                success: function(data) {
                                    if (data) {
                                        $("img.load").remove();
                                        _deletethis.closest('li').fadeOut().remove();
                                        call_structure();
                                        if (target_element.children('ul').children('li').length == 0) {
                                            target_element.children('ul').remove();
                                        }
                                    }
                                }
                            });
                        }
                    }
                });
            }

            // Drag and drop functionality
            function draggable_event() {
                droppable_event();
                $('.' + class_name + '[rel = ' + tree_id + '] li > div').draggable({
                    cursor: 'move',
                    distance: 40,
                    zIndex: 5,
                    revert: true,
                    revertDuration: 100,
                    snap: '.tree li div',
                    snapMode: 'inner',
                    start: function(event, ui) {
                        $('li.li_children').removeClass('li_children');
                        $(this).closest('li').addClass('li_children');
                    },
                    stop: function(event, ul) {
                        droppable_event();
                    }
                });
            }

            function droppable_event() {
                $('.' + class_name + '[rel = ' + tree_id + '] li > div').droppable({
                    accept: '.tree li div',
                    drop: function(event, ui) {
                        $('div.check_div').removeClass('check_div');
                        $('.li_children div').addClass('check_div');
                        var _this = $(this);
                        if (_this.hasClass('check_div')) {
                            alert('Cant Move on Child Element.');
                        } else {
                            var data = {
                                action: 'drag',
                                id: $(ui.draggable[0]).attr('id'),
                                parent_id: _this.attr('id'),
                                tree_id: tree_id
                            };

                            $.ajax({
                                type: 'POST',
                                url: 'admin-ajax.php',
                                data: data,
                                success: function(data) {}
                            });
                            
                            if (_this.next('ul').length == 0) {
                                _this.after('<ul><li>' + $(ui.draggable[0]).attr({'style': ''}).closest('li').html() + '</li></ul>');
                            } else {
                                $(this).next('ul').append('<li>' + $(ui.draggable[0]).attr({'style': ''}).closest('li').html() + '</li>');
                            }

                            if ($(ui.draggable[0]).closest('ul').children('li').length == 1) {
                                $(ui.draggable[0]).closest('ul').remove();
                            } else {
                                $(ui.draggable[0]).closest('li').remove();
                            }
                            call_structure();
                            draggable_event();
                        }
                    }
                });
            }

            if (draggable_option) {
                draggable_event();
            }
        });
    };
})(jQuery);