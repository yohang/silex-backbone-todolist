Todo.View.TodoList = (function($) {

    return Backbone.View.extend({
        el: $('#main'),

        events: {
            'click #todo-list .delete': 'deleteTodo',
            'click #todo-list .finish': 'finishTodo'
        },

        initialize: function() {
            this.collection = new Todo.Collection.Todo;
        },

        render: function() {
            var filter = function(todo) {
                return 0 == todo.is_finished;
            };

            $(this.el).html(Twig.render(Todo.Template.TodoList, {
                todos: this.collection.toJSON()
            }));
        },

        deleteTodo: function(e) {
            e.preventDefault();

            if (confirm('Etes vous sur de vouloir supprimer ce Todo ?')) {
                var row = this.$(e.currentTarget).parents('tr:first');
                this.collection.get(row.data('id')).destroy();
                row.remove();
            }
        },

        finishTodo: function(e) {
            e.preventDefault();
            var row = this.$(e.currentTarget).parents('tr:first');
            var todo = this.collection.get(row.data('id'));
            todo.set('is_finished', true);
            todo.save();

            this.render();
        }
    });

})(jQuery);
