<?php
class User
{
    public function findAll()
    {
        $fp = fopen('user.csv', 'r');
        $cnt = 0;
        while ($data = fgetcsv($fp)) {
            $res[$cnt]['ID'] = substr($data[0], 3);
            $res[$cnt]['name'] = substr($data[1], 5);
            $res[$cnt]['gender'] = substr($data[2], 7);
            $cnt++;
        }
        fclose($fp);
        return $res;
    }

    public function insert($user)
    {
        $fp = fopen('user.csv', "a");
        foreach ($user as $key => $value) {
            fwrite($fp, $key. '='. $value .',');
        } 
        fwrite($fp, "\n");
        fclose($fp);
        http_response_code(201);
    }

    public function update($user)
    {
        $fp = fopen('user.csv', 'r');
        $cnt = 0;
        $is_update = false;
        while ($data = fgetcsv($fp)) {
            if ($user->ID == substr($data[0], 3)) {
                $data[0] = 'ID='.$user->ID;
                $data[1] = 'name='. $user->name; 
                $data[2] = 'gender='. $user->gender;
                $is_update = true;
            }
            $edited_data[] = $data;
        }
        $fp = fopen('user.csv', 'w');
        foreach ($edited_data as $list) {
            fputcsv($fp, $list);
        }
        fclose($fp);
        
        if ($is_update) {
            http_response_code(201);
        } else {
            http_response_code(204);
        }
    }

    public function delete($id)
    {
        $fp = fopen('user.csv', 'r');
        $cnt = 0;
        $is_delete = false;
        while ($data = fgetcsv($fp)) {
            if ($id !== substr($data[0], 3)) {
                $deleted_data[] = $data;                
            } else {
                $is_delete = true;
            }        
        }
        $fp = fopen('user.csv', 'w');
        foreach ($deleted_data as $list) {
            fputcsv($fp, $list);
        }
        fclose($fp);
        
        if ($is_delete) {
            http_response_code(201);
        } else {
            http_response_code(204);
        }
    }
}