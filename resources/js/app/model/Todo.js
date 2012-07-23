Todo.Model.Todo = (function($) {

    return Backbone.Model.extend({
        urlRoot: '/api/todo',
        defaults: {
            id: null,
            title: '',
            is_finished: false
        }
    });

})(jQuery);
