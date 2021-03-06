<?php
class Request {
   
    public function getMethod(){
		$method = $_SERVER['REQUEST_METHOD'];
		//print_r( $request = explode("/", substr(@$_SERVER['PATH_INFO'], 2)));

		switch ($method) {
		  case 'PUT':
			return $method; 
			break;
		  case 'POST':
			return $method;
			break;
		  case 'GET':
			return $method;
			break;
		  
		  case 'DELETE':
			return $method; 
			break;
		}
	}
    public function getUrl() { //get URL of file
      return  $url = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
       // $urlbase = $_SERVER['PHP_SELF']; 
    }

    public function connectDb (){ // connect to data base
	  $this->conn_string = "host=localhost dbname=nguyen user=nguyen password=cybershot";
      pg_connect($this->conn_string) or die ("No connect to database! ". pg_last_error($conn)); 	
	}
	public function getEvents(){
		$this->connectDb();
		// query get all events
		$query = "SELECT * FROM events"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }

        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getMatches(){
		$this->connectDb();
		// query get all matches
		$query = "SELECT * FROM matches"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           echo json_encode($myrow);
        }
        pg_close();
	}
	public function getTeams(){
		$this->connectDb();
		// query get all teams
		$query = "SELECT * FROM teams"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getTeamsById($id){
		$this->connectDb();
		// query get team by id
		$query = "SELECT * FROM teams WHERE id = $id"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getTeamsMatchById($id){
		$this->connectDb();
		// query get team by id
		$query = "SELECT * FROM teams t, matches m WHERE t.id = m.home_team_id AND t.id = m.away_team_id AND t.id = $id"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getEventById($id){
		$this->connectDb();
		// query get event by id
		$query = "SELECT * FROM events WHERE id = $id"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getMatchById($id){
		$this->connectDb();
		// query get match by id
		$query = "SELECT * FROM matches WHERE id = $id"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
           
        }
        pg_close();
	}
	public function getCalendarById($id){
		$this->connectDb();
		// query get calendar by id
		$query = "select distinct(th.name) as home_team, ta.name as away_team, m.home_score as home_score, m.away_score as away_score from events e, matches m,teams th,teams ta where e.id = m.event_id and m.home_team_id = ta.id and m.away_team_id = th.id and e.id=$id"; 
		$result = pg_query($query);
        if (!$result) {
            echo "Problem with query " . $query . "<br/>";
            echo pg_last_error();
            exit();
        }  
        while($r = pg_fetch_array($result)) {
			$myrow[] = $r;
           print json_encode($myrow);
          
        }
        pg_close();
	}
	public function delTeamById($id){
		$this->connectDb();
		// query delete team by id
		// first one, delete match this team is in
			//delete match
		$query1 = "DELETE FROM matches WHERE home_team_id = $id";
		$result1 = pg_query($query1);
		$query2 = "DELETE FROM matches WHERE away_team_id = $id"; 
		$result2 = pg_query($query2);
			//delete team
		$query3 = "DELETE FROM teams WHERE id = $id"; 
		$result3 = pg_query($query3);	
        pg_close();
	}
	public function delEventById($id){
		$this->connectDb();
		// query delete event by id
		// first one, delete match this event is in
			//delete match
		$query1 = "DELETE FROM matches WHERE event_id = $id";
		$result1 = pg_query($query1);
		
			//delete event
		$query2 = "DELETE FROM events WHERE id = $id"; 
		$result2 = pg_query($query2);	
        pg_close();
	}
	public function modEvent($id,$name, $event_start_date, $event_end_date){
		$this->connectDb();
		// query update event by id
		$query = "UPDATE events SET name = $name, event_start_date = $event_start_date, event_end_date = $event_end_date WHERE id = $id";
		$result = pg_query($query);
        pg_close();
	}
	public function modTeam($id,$name){
		$this->connectDb();
		// query update team by id
		$query = "UPDATE teams SET name = $name WHERE id = $id";
		$result = pg_query($query);
        pg_close();
	}
	public function addEvent($name,$event_start_date,$event_end_date){
		$this->connectDb();
		// query add event
		$query = "INSERT INTO events(name, event_start_date, event_end_date) 
					VALUES 
					($name,$event_start_date,$event_end_date)";
		$result = pg_query($query);
        pg_close();
	}
	public function addTeam($name){
		$this->connectDb();
		// be sure the name of the new team is different from the others.
		$query1 = "SELECT count(name) FROM teams WHERE name = $name";
		$result1 = pg_query($query1);
		$r = pg_fetch_array($result1);
		$myrow = $r['count'];
		if($myrow = 0){
			// query add team
			$query = "INSERT INTO teams(name) 
					VALUES ($name)";
			$result = pg_query($query);
		}
		else
			return $error= "the name of the new team is existe";
		
        pg_close();
	}
	
}
$toto = new Request;
echo"<pre>";
 print_r( $url=$toto->getUrl());
echo	$method =$toto->getMethod();
echo "</pre>";
// condition execute
	if ($method == "GET"){
		if ($url[0]=="events"){
			if($url[1]!=null){
				$urlId=explode(":", substr($url[1], 1));
				$toto->getEventById($urlId[0]);
				if($url[2]=="schedule"){ //display calandar of match by id_event
					$toto->getCalendarById($urlId[0]);
				}
				else
				$toto->getEventById($urlId[0]);
			}
			else
			$toto->getEvents();
		}
		if ($url[0]=="matches"){
			if($url[1]!=null){
				echo $urlId=explode(":", substr($url[1], 1));
				$toto->getMatchById($urlId[0]);
			}
			else
			$toto->getMatches();
		}	
		if ($url[0]=="teams"){
			if($url[1]!=null){
				echo $urlId=explode(":", substr($url[1], 1));
				$toto->getTeamsById($urlId[0]);
			}
			else
			$toto->getTeams();
		}
		
	}
	if($method = "POST"){
		// fucntion add news inside database
		// add new event.
		if ($url[0]=="events"){
			$name = $_POST["name"];
			$event_start = $_POST["event_start_date"];
			$event_end = $_POST["event_end_date"];
			$toto->addEvent($name,$event_start,$event_end);
			}
		// add new team
		if ($url[0]=="teams"){
			$name = $_POST["name"];

			$toto->addTeam($name);
		}
		
	}
	if($method = "PUT"){
		// fucntion modifie in database
	}
	if($method = "DELETE"){
		// fucntion delete in database
	}
	
?>
