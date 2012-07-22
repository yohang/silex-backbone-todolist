Todo.View.TodoEdit = (function($) {

    return Backbone.View.extend({
        el: $('#main'),

        events: {
            'click #form-actions .back-btn': 'goBack',
            'click #form-actions .save-btn': 'saveTodo'
        },

        initialize: function() {},

        render: function() {
            $(this.el).html(Twig.render(Todo.Template.Edit, { todo: this.model.toJSON() }));
        },

        goBack: function(e) {
            e.preventDefault();
            this.trigger('back');
        },

        saveTodo: function(e) {
            e.preventDefault();

            var title, isFinished = false;

            title = $.trim($('#title').val());

            this.model.save({
                title: title,
                is_finished: isFinished
            }, {
                success: function() {
                    this.model.trigger('save-success');
                }.bind(this)
            });
        }
    });

})(jQuery);
