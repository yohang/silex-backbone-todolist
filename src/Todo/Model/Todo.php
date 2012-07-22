<?php

namespace Todo\Model;

class Todo implements \JsonSerializable
{
    private $id;

    private $title = '';

    private $is_finished = false;

    public function getId()
    {
        return $this->id;
    }

    public function setIsFinished($isFinished)
    {
        $this->is_finished = $isFinished;
    }

    public function getIsFinished()
    {
        return $this->is_finished;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function fromArray(array $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->is_finished = $data['is_finished'] == 0 ? false : true;

        return $this;
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'is_finished' => $this->is_finished ? 1 : 0
        );
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public static function create(array $data)
    {
        return (new self)->fromArray($data);
    }
}
