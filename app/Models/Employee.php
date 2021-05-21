<?php
 
 namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
 
class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email'];
    protected $table = 'employee';


    public static function getEmployee($skip, $limit){
        $data = DB::table('employee')->skip($skip)->take($limit)->get();
        return $data;
    }

    function getCountEmployee(){
        $data = DB::table('employee')->get()->count();
        return $data;
    }

    public static function getList($args, $offset, $rec)
    {
        $params = json_decode($args);
        $filter = "";
        $where = "";

        // Editable SQL WHERE
        // if (isset($params->businessunit) && ($params->businessunit != "")) {
        //     $filter = $filter . " AND (businessunit  = '$params->businessunit')";
        // }

        // if (isset($params->division) && ($params->division != "")) {
        //     $filter = $filter . " AND (division  = '$params->division')";
        // }

        // if (isset($params->department) && ($params->department != "")) {
        //     $filter = $filter . " AND (department  = '$params->department')";
        // }


        // if (isset($params->src) && ($params->src != "")) {
        //     $where = $where . " AND (docnumber like '%" . $params->src . "%')";
        // }

        $stmt = DB::select(
            "SELECT *
            FROM employee
            ORDER BY id asc
            LIMIT :offset, :rec",
            [
                'offset' => $offset,
                'rec' => $rec
            ]
        );
        return $stmt;
    }

    public static function getCount($args)
    {
        $params = json_decode($args);
        $filter = "";
        $where = "";

        // Editable SQL WHERE
        // if (isset($params->businessunit) && ($params->businessunit != "")) {
        //     $filter = $filter . " AND (businessunit  = '$params->businessunit')";
        // }

        // if (isset($params->division) && ($params->division != "")) {
        //     $filter = $filter . " AND (division  = '$params->division')";
        // }

        // if (isset($params->department) && ($params->department != "")) {
        //     $filter = $filter . " AND (department  = '$params->department')";
        // }

        // if (isset($params->src) && ($params->src != "")) {
        //     $where = $where . " AND (strname like '%" . $params->src . "%')";
        // }

        // if (isset($params->src) && ($params->src != "")) {
        //     $where = $where . " AND (docnumber like '%" . $params->docnumber . "%')";
        // }

        $stmt = DB::select("SELECT count(id) jum
            FROM employee");
        return $stmt;
    }
}