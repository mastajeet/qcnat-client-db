<?php
include_once('base_model.php');
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-08-16
 * Time: 9:12 PM
 */
class Family extends BaseModel
{

    #### Family Info ####

    public $family_id;
    public $name;
    public $tel_1;
    public $tel_2;
    public $address;
    public $email;
    public $created_at;
    public $deleted_at;

    public $inscriptions = null;
    protected $family_members = null;

    static function define_data_types()
    {
        return array(
            'family_id' => 'ID',
            'family_members'=>'has_many',
            'name' => 'string',
            'tel_1' => 'string',
            'tel_2' => 'string',
            'address' => 'string',
            'email' => 'string',
            'created_at' => 'date',
            'deleted_at' => 'date'
        );
    }

    static function define_default_values()
    {
        return [
            'address'=>"",
            'email'=>"",
        ];
    }

    static function define_table_info(){
        return array(
            'model_table' =>"family",
            'model_table_id'=> "family_id");
    }

    function get_family_members(){
        $req = "SELECT family_member_id FROM family_member WHERE family_id = ".$this->family_id;
        $result = self::find($req,get_class(new FamilyMember));
        if($result==[])
            $this->family_members = [];

        foreach($result as $family_member){
            $this->family_members[] = $family_member;
        }
    }

    function get_inscriptions_session($session){
        $inscriptions = [];
        if(is_null($this->family_members))
            $this->get_family_members();
        foreach($this->family_members as $family_member){
            $family_member->get_previous_lessons();
            foreach($family_member->previous_lessons as $lesson){
                if($lesson->session == $session){
                    $inscriptions[] = $lesson->level;
                }
            }
        }
        $this->inscriptions = $inscriptions;
    }

    function to_json(){
        $this->get_family_members();

        $family_members = "[";
        foreach($this->family_members as $family_member){
            $family_members .= "\"".$family_member->name."\", ";

        }
        $family_members = substr($family_members ,0,-2);
        $family_members .= "]";
        return "{\"name\" : \"".$this->name."\", \"family_members\":".$family_members."}";


        }



}