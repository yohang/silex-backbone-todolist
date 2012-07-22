Todo.View.Index = (function($) {

    return Backbone.View.extend({
        el: $('#main'),

        initialize: function() {},

        render: function() {
            $(this.el).html(Twig.render(Todo.Template.Index, {}));
        }
    });

})(jQuery);
