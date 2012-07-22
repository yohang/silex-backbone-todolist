Todo.Router = (function($) {

    return Backbone.Router.extend({
        routes: {
            '':         'index',
            'todo':     'showList',
            'todo/add': 'add',
            'todo/:id': 'edit'
        },

        initialize: function() {

        },


        index: function() {
            (new Todo.View.Index).render();
        },

        showList: function() {
            var view = new Todo.View.TodoList;
            view.collection.fetch({
               success: function() {
                   view.render();
                }
            });
        },

        add: function() {
            this.addOrEdit(function(model, view) {
                view.render();
            }, null);
        },

        edit: function(id) {
            this.addOrEdit(function(model, view) {
                model.fetch({
                    success: function() {
                        view.render();
                    }
                });
            }, id);
        },

        addOrEdit: function(callback, id) {
            var model, view;

            model = new Todo.Model.Todo({ id: id });
            view = new Todo.View.TodoEdit({ model: model });

            callback(model, view);

            view.on('back', function() {
                delete view;
                this.navigate('#/todo')
            }.bind(this));
            view.model.on('save-success', function() {
                delete view;
                this.navigate('#/todo');
            }.bind(this));
        }
    });

})(jQuery);

$(function() {
    new Todo.Router;
    Backbone.history.start();
});
