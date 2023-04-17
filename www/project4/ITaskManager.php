<?php

/**
 *
 */
interface ITaskManager {

    /**
     * @param $desc
     * @return mixed
     */
    public function create($desc);

    /**
     * @param $id
     * @return mixed
     */
    public function read($id);

    /**
     * @return mixed
     */
    public function readAll();

    /**
     * @param $id
     * @param $newDesc
     * @return mixed
     */
    public function update($id, $newDesc);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

}