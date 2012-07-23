Todo.Collection.Todo = (function($) {

    return Backbone.Collection.extend({
        model: Todo.Model.Todo,
        url: '/api/todo',
        comparator: function(todo) {
            return todo.get('is_finished');
        }
    });

})(jQuery);
