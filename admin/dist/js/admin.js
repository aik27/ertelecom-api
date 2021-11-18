$(document).ready(function () {
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.form-category').click(function () {
        let name = $(this).attr('data-id');
        $('#' + name).slideToggle('fast');
    });

    $('.admin-sidebar__button').click(function () {
        $.ajax({
            type: "GET",
            url: '/ajax/switcher',
            data: "element=sidebar",
            success: function (msg) {}
        });
    });

    $("input, textarea").each(function () {
        addMaxLengthHelper($(this));
    });

    $("input, textarea").keyup(function () {
        addMaxLengthHelper($(this));
    });

});

function sendGridMultiple(url, type, msg)
{
    if (confirm(msg)) {
        var el = $('#grid input[type=\"checkbox\"]');
        var form = $('<form action=' + url + ' method=\"POST\"></form>'),
            csrfParam = $('meta[name=csrf-param]').prop('content'),
            csrfToken = $('meta[name=csrf-token]').prop('content');
        if (csrfParam) {
            form.append('<input type=\"hidden\" name=' + csrfParam + ' value=' + csrfToken + '>');
        }
        form.append('<input type=\"hidden\" name=\"type\" value=' + type + '>');
        $.each(el, function (index, id) {
            if ($(this).is(':checked')) {
                form.append('<input type=\"hidden\" name=\"selection[]\" value=' + $(this).attr('value') + '>');
            }
        });
        form.appendTo('body').submit();
    }
}

function saveGridPosition(url)
{
    $('#form-position').remove();
    var el = $('.form-position');
    var form = $('<form id=\"form-position\" action=' + url + ' method=\"POST\"></form>'),
        csrfParam = $('meta[name=csrf-param]').prop('content'),
        csrfToken = $('meta[name=csrf-token]').prop('content');
    if (csrfParam) {
        form.append('<input type=\"hidden\" name=' + csrfParam + ' value=' + csrfToken + '>');
    }
    $.each(el, function (index, id) {
        form.append('<input type=\"hidden\" name=' + $(this).attr('name') + ' value=' + $(this).val() + '>');
    });
    //form.appendTo('body');
    form.appendTo('body').submit();
}

function makeGridClickable(url)
{
    $('tbody td').on('dblclick', function (e) {
        var id = $(this).closest('tr').data('key');
        if (e.target == this) {
            location.href = url + "?id=" + id;
        }
    });
}

function addMaxLengthHelper(el)
{
    let parent = el.parent();
    if (el.attr("maxlength") > 0) {
        if ($(".admin-max-length-helper", parent).length <= 0) {
            $('.control-label', parent).after('<span class="admin-max-length-helper"></span>');
        }
        $(".admin-max-length-helper", parent).html(`${el.val().length} / ${el.attr("maxlength")}`);
    }
}

function changeSearchField(field, value)
{
    const url = new URL(window.location.href);
    url.searchParams.set(field, value);
    window.location.href = url.href;
}