<?php


namespace App;


use Illuminate\Support\Facades\Cookie;


class dataIdManager
{
    public $database;
    public $is_cookie;
    public $data = [];
    public $empty = true;
    public $column;

    /**
     * dataIdManager constructor.
     * @param $database
     * @param bool $is_cookie
     * @param String $not_cookie_data
     * @param string $column
     */
    function __construct($database,bool $is_cookie = true,$column = '')
    {
        $this->database = $database;
        $this->is_cookie = $is_cookie;
        $this->column = $column;

        $data = '';
        if ($this->is_cookie) {
            $data = Cookie::get($this->database);
        } else {
            $data = $database->{$column};
        }
        $data = explode(',', $data);
        if ($data) {
            foreach ($data as $id) {
                $this->data[$id] = $id;
            }
            $this->empty = false;
        }


    }

    /**
     * @param $id
     */
    public function add_id($id)
    {
        if (!$this->have_id($id)) {
            $this->data[$id] = $id;
            return true;
        }
        return false;
    }

    public function remove_id($id)
    {
        if ($this->have_id($id)) {
            unset($this->data[$id]);
            return true;
        }
        return false;
    }

    public function toggle_id($id)
    {
        if ($this->have_id($id)) {
            unset($this->data[$id]);
            return false;
        }else{
            $this->data[$id] = $id;
            return true;
        }
    }

    public function have_id($id)
    {
        if ($this->empty) {
            return false;
        }

        if (isset($this->data[$id])) {
            return true;
        } else {
            return false;
        }
    }

    public function save()
    {
        if ($this->is_cookie) {

                return \cookie()->forever($this->database,implode(',',$this->data));

        } else {
            $this->database->{$this->column} = implode(',',$this->data);
            return $this->database->save();
        }
    }
    public function get_all(){
        return $this->data;
    }

}
