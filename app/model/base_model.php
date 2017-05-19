<?php

class NotImplementedException extends BadMethodCallException
{
}

class BaseModel
{
    public $updated_values = array();

    static function find_by_id()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();

        return ("SELECT * FROM " . $table_info['model_table'] . " WHERE " . $table_info['model_table_id'] . " = ");
    }


    static function get_all($filter, $order_by, $order,$nb_per_page, $page)
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();
        $request = "SELECT " . $table_info['model_table_id'] . " FROM " . $table_info['model_table'] . " WHERE " . $filter . " ORDER BY " . $order_by ." ". $order;
        $result = BaseModel::find($request, $object);
        return $result;
    }

    static function get_all_in_list($filter, $include_id=False)
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();
        $request = "SELECT * FROM " . $table_info['model_table'] . " WHERE " . $filter;
        $result_array = self::select($request);
        $result_set = array();
        foreach ($result_array as $k => $v) {
            $value = "";
            foreach ($v as $field => $field_value) {
                if ($field != $table_info['model_table_id']) {
                    $value .= " " . $field_value;
                } else {
                    if($include_id==True){
                        $value = $field_value." - ".$value;
                    }
                    $object_id = $field_value;

                }
            }
            $result_set[$object_id] = $value;
        }
        return $result_set;

        $result = BaseModel::find($request, $object);
        return $result;
    }


    static function get_last_id()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();
        $model_table_id = $table_info['model_table_id'];
        $request = "SELECT " . $table_info['model_table_id'] . " FROM " . $table_info['model_table'] . " WHERE 1 ORDER BY " . $table_info['model_table_id'] . " DESC LIMIT 0,1";
        $result = BaseModel::select($request);
        return $result[0][$model_table_id];
    }


    static function last()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();
        $model_table_id = $table_info['model_table_id'];
        $request = "SELECT * FROM " . $table_info['model_table'] . " WHERE 1 ORDER BY " . $table_info['model_table_id'] . " DESC LIMIT 0,1";
        $result = BaseModel::select($request);
        return new $object($result[0][$model_table_id]);
    }

    static function define_data_types()
    {
        return array();
    }

    static function define_default_values()
    {
        return array();
    }


    static function define_table_info()
    {
        throw new NotImplementedException();
    }


    function __construct($Arg = null)
    {
        $object = get_called_class();
        $default_values =$object::define_default_values();

        foreach ($default_values  as $key => $value) {
            $this->$key = $value;
            $this->updated_values[] = $key;
        }




        if (is_array($Arg)) {
            foreach ($Arg as $Key => $val) {
                $this->$Key = $val;
                if(!in_array($Key,$this->updated_values))
                {
                    $this->updated_values[] = $Key;
                }
            }
        }

        if (is_numeric($Arg)) {
            //Assuming ID, search for ID
            $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
            $SQL->SELECT($this->find_by_id() . $Arg);

            $Req = $SQL->FetchAssoc();

            foreach ($Req as $Key => $val) {
                if (!is_null($val) and $val != "") {
                    $this->$Key = $val;
                    $this->updated_values[] = $Key;
                }
            }
            $SQL->CloseConnection();

        }
    }

    function __set($item, $value)
    {
        $object = get_called_class();
        if (!in_array($item, array('data_type', 'updated_values', 'model_table', 'model_table_id')))
            if (!in_array($item, $this->updated_values)) {
                $this->updated_values[] = $item;
            }
        if ($object::get_data_type($item, $value) == "has_many") {
            $this->{$item}[] = $value;
        } else {
            $this->$item = $value;
        }
    }

    function __get($name)
    {
        $object = get_called_class();
        $value_list = $object::define_data_types();
        if (in_array($name, array_keys($value_list))) {
            return $this->$name;
        } elseif (in_array($name, get_class_methods($object))) {
            $this->$name();
        } else {

            throw new Exception(WARNING_UNKNOWN_MODEL_VALUE . ": " . $name . " for " . $object);
        }

    }

    function generate_update_statement()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();

        $model_table_id = $table_info['model_table_id'];

        $Req = "";
        $Req .= "UPDATE " . $table_info['model_table'] . " SET ";
        foreach ($this->updated_values as $value) {
            $value_type = $this->get_data_type($value, $this->$value);

            if ($value_type == "has_many") {
                foreach ($this->$value as $model) {
                    $model->save();
                }
            } elseif ($value_type == "has_one") {
                $this->$value->save();
            } elseif ($value_type != "ID") {
                $field = $value;
                $field_value = $this->convert_data($this->$value, $value_type);
                $Req .= $field . "=" . $field_value . ", ";
            }
        }
        $Req = substr($Req, 0, -2);
        $Req .= " WHERE " . $table_info['model_table_id'] . " = " . $this->$model_table_id;
        return ($Req);
    }

    function generate_insert_statement()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();

        $Req = "";
        $Req .= "INSERT INTO " . $table_info['model_table'] . "(";
        $fields = "";
        $values = "";
        foreach ($this->updated_values as $value) {
            $value_type = $this->get_data_type($value, $this->$value);

            if ($value_type == "has_many") {
                foreach ($this->$value as $model) {
                    $model->save();
                }
            } elseif ($value_type == "has_one") {
                $this->$value->save();
            } elseif ($value_type != "ID") {
                $fields .= "`" . $value . "`, ";
                $field_value = $this->convert_data($this->$value, $value_type);
                $values .= $field_value . ", ";
            }
        }
        $values = substr($values, 0, -2);
        $fields = substr($fields, 0, -2);
        $Req .= $fields . ") VALUES (" . $values . ")";
        return ($Req);
    }


    function save()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();

        $model_table_id = $table_info['model_table_id'];


        if ($this->$model_table_id == 0) {
            if (count($this->updated_values) > 0) {
                BaseModel::insert($this->generate_insert_statement());
                $this->$model_table_id = $object::get_last_id();

            }
        } else {
            if (count($this->updated_values) > 0) {
                BaseModel::update($this->generate_update_statement());
            }
        }
        return $this->$model_table_id;

    }

    function destroy()
    {
        $object = get_called_class();
        $table_info = $object::define_table_info();
        $req = "DELETE FROM " . $table_info['model_table'] . " WHERE " . $table_info['model_table_id'] . " = ".$this->{$table_info['model_table_id']};
        self::delete($req);
        return True;
    }

    static function insert($Req)
    {
        $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $SQL->Insert($Req);
        $SQL->CloseConnection();
    }

    static function update($Req)
    {
        $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $SQL->Update($Req);
        $SQL->CloseConnection();
    }

    static function delete($Req)
    {
        $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $SQL->Delete($Req);
        $SQL->CloseConnection();
    }



    static function find_by($attribute,$value)
     {
         $object = get_called_class();
         $table_info = $object::define_table_info();
         $where_clause = "";
         if(!is_array($attribute) and !is_array($value)){
             $where_clause = $attribute . " = ".$value;
         }else{
             if(count($attribute)==count($value)){
                 for($i=0; $i<count($attribute); $i++) {
                     $where_clause .= $attribute[$i].' = '.$value[$i]." and ";
                 }
                 $where_clause = substr($where_clause,0,-5);
             }else{
                 throw new Exception();
             }
         }

         return self::find("SELECT * FROM " . $table_info['model_table'] . " WHERE " .$where_clause ,$object);
     }


    static function find($Req, $class)
    {
        $table_info = $class::define_table_info();
        $model_table_id = $table_info['model_table_id'];

        $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $SQL->Select($Req);
        $return_value = array();
        while ($rep = $SQL->FetchAssoc()) {
            $return_value[] = new $class($rep[$model_table_id]);
        }
        $SQL->CloseConnection();
        return $return_value;
    }


    static function select($Req)
    {
        $SQL = new SQLHelper(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $SQL->Select($Req);
        $return_value = array();
        if ($SQL->NumRow() == 0) {
            return false;
        }
        while ($rep = $SQL->FetchAssoc()) {
            $return_value[] = $rep;
        }
        $SQL->CloseConnection();
        return $return_value;
    }


    static function convert_data($data, $data_type)
    {
        if ($data_type == "string") {
            return "\"" . addslashes($data) . "\"";
        }
        if ($data_type == "int") {
            return intval($data);
        }
        if ($data_type == "float") {
            return floatval($data);
        }

        if ($data_type == "date") {
            return "\"" . $data . "\"";
        }


        throw new UnexpectedValueException;
    }

    static function guess_data_type($value)
    {

        if (is_int($value))
            return 'int';
        if (is_float($value))
            return 'float';
        if (is_numeric($value)) {
            if (strrpos('.', $value))
                return 'float';
            return 'int';
        }
        if (is_string($value))
            return 'string';
        if (is_numeric($value))
            return 'int';
        else
            return 'string';

    }

    static function get_data_type($field, $value)
    {
        $object = get_called_class();
        $data_types = $object::define_data_types();
        if (array_key_exists($field, $data_types)) {
            return $data_types[$field];
        } else {
            return BaseModel::guess_data_type($value);
        }
    }


}

