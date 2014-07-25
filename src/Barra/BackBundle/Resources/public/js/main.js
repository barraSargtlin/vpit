$(window).load(function() {
    var entities = [];

    var collectEntities = function() {
        var tables = $('table:not(.jsStorage)');

        tables.each(function() {
            var e = [];

            e['table'] = $(this);
            e['action'] = e['table'].attr('data-type');

            e['iFormRow'] = e['table'].find('.formInRow');
            e['iForm'] = e['table'].parent();

            var wrapper = $('.jsStorage[data-type="'+e["action"]+'"]');
            e['uFormRow'] = wrapper.find('tr').detach();
            e['uForm'] = wrapper.find('form').detach();
            wrapper.remove();

            e['activeTr'] = null;
            entities.push(e);
        });
    };


    var chooseEntity = function(action) {
        if (entities.length === 0)
            collectEntities();

        for (var i=0; i < entities.length; i++) {
            if (entities[i]['action'] === action)
                return i;
        }
        window.alert('something went wrong, please reload the site.');
    };


    $('section').on('click', 'td.editableCell', function() {
        var compareString = $(this).closest('table').attr('data-type');
        var i = chooseEntity( compareString );

        if (entities[i]['activeTr'] !== null) return;
        entities[i]['activeTr'] = $(this).parent();

        // remove iForm
        entities[i]['table'].unwrap();
        entities[i]['table'].wrap(entities[i]['uForm']);
        entities[i]['iFormRow'] = entities[i]['iFormRow'].detach();

        // insert uForm
        var id = entities[i]['activeTr'].attr('data-id');
        entities[i]['activeTr'].replaceWith(entities[i]['uFormRow']);
        entities[i]['uFormRow'].find('.formPk').val(id);

        // fill uForm
        fillUForm(i);
        var index = $(this).index();
        entities[i]['uFormRow'].find('.form-control').eq(index).focus();
    });



    var fillUForm = function(i) {
        var values = [];
        entities[i]['activeTr'].children('.editableCell').each(function() {
            values.push( $(this).html() );
        });
        values.reverse();

        entities[i]['uFormRow'].find('.form-control').each(function() {

            if ($(this).prop('type') == 'select-one') {


                $(this).find("option").filter(function() {
                    return $(this).text() == values.pop();
                }).prop('selected', true);

            } else {
                $(this).val( values.pop() );
            }
        });
    };



    $('section').on('submit', "[name$='Update']", function(event) {
        var compareString = $(this).find('table').attr('data-type');
        var i = chooseEntity(compareString);
        event.preventDefault();
        var uForm = $(this);

        $.ajax({
            url: uForm.attr('action'),
            type: "POST",
            data: uForm.serialize()

        }).done(function(response) {
            if (response.code == 200)
                hideUForm(i);

            else if (response.code == 400)
                manageValidationErrors(i, response.message);

            else if (response.code == 404)
                window.alert('404 '+response.message);

            else
                window.alert("uuups fatal error");
        });
    });



    var hideUForm = function(i) {
        var values = [];
        entities[i]['uFormRow'].find('.form-control').each(function() {
            values.push( $(this).val() );
        });

        values.reverse();
        entities[i]['activeTr'].children('.editableCell').each(function() {
            $(this).text(values.pop());
        });

        // toggle Forms
        entities[i]['table'].unwrap();
        entities[i]['table'].wrap(entities[i]['iForm']);
        entities[i]['uFormRow'].replaceWith(entities[i]['activeTr']);
        entities[i]['table'].append(entities[i]['iFormRow']);

        // optical feedback
        entities[i]['activeTr'].addClass('trUpdated')
        setTimeout(function() {
            entities[i]['activeTr'].removeClass('trUpdated');
            entities[i]['activeTr'] = null;
        }, 1500);
    };



    var manageValidationErrors = function(i, errors) {
        $.each(errors, function(fieldname, number) {
            var output = "<ul>";

            $.each(number, function(index, error) {
                output += '<li>'+ error +'</li>';
            });

            output += '</ul>';
            var field = entities[i]['uFormRow'].find("[name$='["+ fieldname +"]']");
            field.before(output);
        });
    }
});




