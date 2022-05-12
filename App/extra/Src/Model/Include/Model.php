<?php

abstract class Model extends Credo implements ModelInterface
{
    /**
     * 
     * Model
     * 
     * @version 9.3
     */

    private $get = [];
    private $post = [];
    private $files = [];
    protected $table = '';

    use
        ModelPost,
        ModelTJsonResponce,
        ModelHook;


    private function axeElement()
    {
        if (method_exists(get_class($this), 'axe')) $this->{'axe'}();
        else Hell::error("403");
    }

    public function getElement()
    {
        $object = $this->byId($this->get['id']);

        if ($object) {
            $this->setPost($object);
            return $this;
        } else Hell::error("403");
    }

    public function save($post){
        $this->db->beginTransaction();
        $post = $this->cleanForm($post);
        $post = $this->toNull($post);
        $object = $this->cInsert($this->table, $post);
        if (!is_numeric($object)) $this->error($object);
        $this->db->commit();
    }

    public function update($pk, $post){
        $this->db->beginTransaction();
        $post = $this->cleanForm($post);
        $post = $this->toNull($post);
        $object = $this->cUpdate($this->table, $post, $pk);
        if (!is_numeric($object) and $object <= 0) $this->error($object);
        $this->db->commit();
    }

    public function delete($pk){
        $this->db->beginTransaction();
        $object = $this->cDelete($this->table, $pk);
        if ($object <= 0) $this->error($object);
        $this->db->commit();
    }

    final public function csrfToken(){
        $token = bin2hex(random_bytes(24));
        $_SESSION['CSRFTOKEN'] =  $token;
        echo "<input type=\"hidden\" name=\"csrf_token\" value=\"$token\">";
    }

    public function value(String $column = null)
    {
        return (isset($this->getPost()->{$column})) ? $this->getPost()->{$column} : null;
    }

    final public function stop()
    {
        if($this->db->inTransaction()) $this->db->rollBack();
        exit;
    }

    final public function dd()
    {
        parad("Post", $this->getPost());
        $this->stop();
    }

}

?>