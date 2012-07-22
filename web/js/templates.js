/**
 * @fileoverview Compiled template for file
 *
 * index.html.twig
 */

goog.provide('Todo.Template.Index');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
Todo.Template.Index = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(Todo.Template.Index, twig.Template);

/**
 * @inheritDoc
 */
Todo.Template.Index.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
Todo.Template.Index.prototype.render_ = function(sb, context, blocks) {
    // line 2
    sb.append("<div class=\"hero-unit\">\n    <h1>TODO Manager<\/h1>\n    <p>Build with backbone<\/p>\n<\/div>\n");
};

/**
 * @inheritDoc
 */
Todo.Template.Index.prototype.getTemplateName = function() {
    return "Todo.Template.Index";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
Todo.Template.Index.prototype.isTraitable = function() {
    return false;
};

/**
 * @fileoverview Compiled template for file
 *
 * todo_edit.html.twig
 */

goog.provide('Todo.Template.Edit');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
Todo.Template.Edit = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(Todo.Template.Edit, twig.Template);

/**
 * @inheritDoc
 */
Todo.Template.Edit.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
Todo.Template.Edit.prototype.render_ = function(sb, context, blocks) {
    // line 2
    sb.append("<h1>Nouveau Todo<\/h1>\n<form class=\"form-horizontal\">\n    <fieldset>\n\n        <div class=\"control-group\">\n            <label for=\"title\" class=\"control-label\">Title<\/label>\n            <div class=\"controls\">\n                <div class=\"input-prepend\">\n                    <span class=\"add-on\">\n                        <i class=\"icon-user\"><\/i>\n                    <\/span>\n                    <input type=\"text\" class=\"input-xlarge\" id=\"title\" value=\"");
    // line 13
    sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "title"), "html", null, true));
    sb.append("\" \/>\n                    <p class=\"help-block\">Le titre du todo<\/p>\n                <\/div>\n            <\/div>\n        <\/div>\n\n    <\/fieldset>\n\n    <div class=\"form-actions\" id=\"form-actions\">\n        <a class=\"btn save-btn\">Enregistrer<\/a>\n        <a class=\"btn back-btn\">Retour<\/a>\n    <\/div>\n<\/form>\n");
};

/**
 * @inheritDoc
 */
Todo.Template.Edit.prototype.getTemplateName = function() {
    return "Todo.Template.Edit";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
Todo.Template.Edit.prototype.isTraitable = function() {
    return false;
};

/**
 * @fileoverview Compiled template for file
 *
 * todo_list.html.twig
 */

goog.provide('Todo.Template.TodoList');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
Todo.Template.TodoList = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(Todo.Template.TodoList, twig.Template);

/**
 * @inheritDoc
 */
Todo.Template.TodoList.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
Todo.Template.TodoList.prototype.render_ = function(sb, context, blocks) {
    // line 2
    sb.append("\n<div class=\"page-header\">\n    <h1>Liste des todos<\/h1>\n<\/div>\n\n<table class=\"table\" id=\"todo-list\">\n    <thead>\n    <tr>\n        <th>Id<\/th>\n        <th>Titre<\/th>\n        <th>Terminer<\/th>\n        <th>Supprimer<\/th>\n    <\/tr>\n    <\/thead>\n    <tbody>\n    ");
    // line 17
    context['_parent'] = context;
    var seq = "todos" in context ? context["todos"] : null;
    twig.forEach(seq, function(v, k) {
        context["_key"] = k;
        context["todo"] = v;
        // line 18
        sb.append("        <tr data-id=\"");
        sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "id"), "html", null, true));
        sb.append("\">\n            <td><a href=\"#\/todo\/");
        // line 19
        sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "id"), "html", null, true));
        sb.append("\">");
        sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "id"), "html", null, true));
        sb.append("<\/a><\/td>\n            <td><a href=\"#\/todo\/");
        // line 20
        sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "id"), "html", null, true));
        sb.append("\">");
        sb.append(twig.filter.escape(this.env_, twig.attr("todo" in context ? context["todo"] : null, "title"), "html", null, true));
        sb.append("<\/a><\/td>\n            <td>\n                ");
        // line 22
        if (((0) == (twig.attr("todo" in context ? context["todo"] : null, "is_finished")))) {
            // line 23
            sb.append("                    <a class=\"btn btn-success finish\">\n                        <i class=\"icon-check\"><\/i> <span class=\"hide\">Terminer<\/span>\n                    <\/a>\n                ");
        } else {
            // line 27
            sb.append("                    Termin\u00e9\n                ");
        }
        // line 29
        sb.append("            <\/td>\n            <td>\n                <a class=\"btn btn-danger delete\">\n                    <i class=\"icon-trash icon-white\"><\/i> <span class=\"hide\">Supprimer<\/span>\n                <\/a>\n            <\/td>\n        <\/tr>\n    ");
    }, this);
    // line 37
    sb.append("    <\/tbody>\n<\/table>\n\n\n");
};

/**
 * @inheritDoc
 */
Todo.Template.TodoList.prototype.getTemplateName = function() {
    return "Todo.Template.TodoList";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
Todo.Template.TodoList.prototype.isTraitable = function() {
    return false;
};
