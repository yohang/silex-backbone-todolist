Todo.Router = (function($) {

    return Backbone.Router.extend({
        routes: {
            '':         'index',
            'todo':     'showList',
            'todo/add': 'add',
            'todo/:id': 'edit'
        },

        initialize: function() {
            this.views = {};
        },


        index: function() {
            this.views.index = this.views.index || new Todo.View.Index;
            this.views.index.render();
        },

        showList: function() {
            var view = this.views.list = this.views.list || new Todo.View.TodoList;
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
            this.views.edit = view = this.views.edit || new Todo.View.TodoEdit({ model: model });
            view.model = model;

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
