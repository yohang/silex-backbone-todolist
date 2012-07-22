<?php

namespace Todo\Controller;

use Todo\Controller;
use Todo\Model\Todo;
use Symfony\Component\HttpFoundation\Request;

class Api extends Controller
{
    public function initialize()
    {
        $this->app->get('/api/todo', array($this, 'listTodos'));
        $this->app->post('/api/todo', array($this, 'add'));
        $this->app->get('/api/todo/{id}', array($this, 'get'));
        $this->app->put('/api/todo/{id}', array($this, 'update'));
        $this->app->delete('/api/todo/{id}', array($this, 'delete'));
    }

    public function listTodos()
    {
        $stmt = $this->app['db']->query('SELECT * FROM todo ORDER BY is_finished');
        $todos = $stmt->fetchAll(\PDO::FETCH_CLASS, get_class(new Todo));

        return json_encode($todos);
    }

    public function get($id)
    {
        $todo = $this->getTodo($id);

        return json_encode($todo);
    }

    public function add(Request $request)
    {
        $todo = Todo::create(json_decode($request->getContent(), true));
        $this->app['db']->insert('todo', $todo->toArray());

        return json_encode($todo);
    }

    public function update($id, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $todo = $this->getTodo($id);
        $todo->setTitle($data['title']);
        $todo->setIsFinished($data['is_finished']);
        $this->app['db']->update('todo', $todo->toArray(), array('id' => $todo->getId()));

        return json_encode($todo);
    }

    public function delete($id)
    {
        $this->app['db']->delete('todo', array('id' => $id));

        return json_encode(['success' => true]);
    }

    private function getTodo($id)
    {
        $stmt = $this->app['db']->prepare('SELECT * FROM todo WHERE id = ?');
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return Todo::create($stmt->fetch());
    }
}
