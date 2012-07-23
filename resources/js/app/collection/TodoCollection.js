Todo.Collection.Todo = (function($) {

    return Backbone.Collection.extend({
        model: Todo.Model.Todo,
        url: '/index_dev.php/api/todo',
        comparator: function(todo) {
            return todo.get('is_finished');
        }
    });

})(jQuery);
