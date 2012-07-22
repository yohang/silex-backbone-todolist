Todo.Model.Todo = (function($) {

    return Backbone.Model.extend({
        urlRoot: '/index_dev.php/api/todo',
        defaults: {
            id: null,
            title: '',
            is_finished: false
        }
    });

})(jQuery);
