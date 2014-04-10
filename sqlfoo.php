
<?php // sqlfoo.php
// @Eric
include_once 'rnfunctions.php';
include_once 'config.php';

class user {

	// Table Name
	static private $aDatasets = array("all" => "*",
	                                  "depplace" => "id, trip_id, price, depplace, arrplace, deptime, arrtime, expert, sendtime, poster,additional,instructions, expert",
	                                  "flexibility" => "trip_id, nearby, anyairlines, multistops, depplace,arrplace,deptime,arrtime, depflexibility, arrflexibility, people ,class, poster",
	                                  "id" => "id",
	                                  "trip_id" => "trip_id",
	                                  "user" => "user, expert");
    static private $aTableName = array("bids" => "bids",
	                                   "itinerary" => "itinerary",
	                                   "rnmembers" => "rnmembers");
	static private $aDistinct = array("DISTINCT" => "DISTINCT");
	static private $aLimit =array("1" => "LIMIT 1");

	public function get($sTableName = "itinerary", $sDataset = "all", $sDistinct = "", $sLimit="") {

		$sSQL = "SELECT ";
		
		$sSQL .= self::$aDistinct[$sDistinct] . " " . self::$aDatasets[$sDataset] . " FROM " . self::$aTableName[$sTableName] . " WHERE 1 = 1 ";
        
		if ($this->name){
            $sSQL .= " AND name = '" . $this->name . "' ";
		}
		if ($this->paid){
			$sSQL .= " AND paid = '" . $this->paid . "' ";
		}
		if ($this->user){
			$sSQL .= " AND user = '" . $this->user . "' ";
		}
		if ($this->awarded){
			$sSQL .= " AND awarded = '" . $this->awarded . "' ";
		}
		if ($this -> trip_id){
			$sSQL .= " AND trip_id = '" . $this -> trip_id . "' ";
		}
		if ($this -> id){
			$sSQL .= " AND id = '" . $this -> id . "' ";
		}
		if ($this -> pricel){
			$sSQL .= " AND price > '" . $this -> pricenl . "' ";
		}	
		if ($this -> priceo){
	        $sSQL .= " ORDER BY price "; 
		}
		    $sSQL .= self::$aLimit[$sLimit];

		return $sSQL;

	}

}

//mysql_close($con);

?>