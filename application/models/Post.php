<?php

/**
 *
 */
class Post extends CI_Model
{
    public function getPost()
    {
        return $this->db->get('posts');
    }

    public function getPostById($id = '')
    {
        $query = $this->db->query("SELECT * FROM posts WHERE id = $id LIMIT 1");
        return $query->row();
    }

    public function save($post = null)
    {
        if (!$this->session->userdata('login')) {
            header("Location: " . base_url());
        }
        if (isset($post)) {
            $title = $post['title'];
            $description = $post['description'];
            $content = $post['content'];
            $file_name = $post['file_name'];

            $sql = "INSERT INTO posts (id, title, description, content, img, date) VALUES (null, '$title', '$description', '$content', '$file_name', NOW())";
            if ($this->db->query($sql)) {
                return true;
            }
        }
        return false;
    }

    public function getPostByYearTitle($year = '', $title = '')
    {
        $title = str_replace('-', " ", $title);
        $result = $this->db->query("SELECT * FROM posts WHERE year(date) = $year AND title LIKE '$title'");
        return $result->row();
    }

    public function numPost()
    {
        return intval($this->db->query("SELECT count(*) as number FROM posts")->row()->number);
    }

    public function getPagination($perPage = '')
    {
        return $this->db->get('posts', $perPage, $this->uri->segment(3));
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);

        if (! $this->db->update('posts', $data)) {
            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        $SQL = "DELETE FROM posts WHERE id = $id";

        if ($this->db->query($SQL)) {
            return true;
        }
        return false;
    }
}
