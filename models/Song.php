<?php

/** Class Song
* 
* @author Lucile Gentner lucile.gentner@gmail.com
* @version 1.0
*/

class Song{

	private $song_id;

	private $dbh;

	/** Constructor
	* @author Lucile Gentner lucile.gentner@gmail.com
	*/
	public function __construct($id){
		try{
			$this->dbh = new PDO('mysql:host='.SERVER_NAME.';dbname='.DB_NAME, DB_USR, DB_PWD);
		}catch (PDOException $e){
			die("Error while trying to connect to database : ".$e->getMessage());
		}
		$this->song_id = $id;
	}

	/** Destructor
	* @author Lucile Gentner lucile.gentner@gmail.com
	*/
	public function __destruct(){
		$this->dbh = null;
	}

	/** Get information about one particular song
	* @author Lucile Gentner lucile.gentner@gmail.com
	* @params $id id of the song
	* @returns JSON with song information
	*/
	public function getSongInfo(){
		$stmt = $this->dbh->prepare('SELECT * from SONG WHERE SONG_ID=:song_id');
		$stmt->bindParam(':song_id', $this->song_id);
		if ($stmt->execute()){
			$aResult = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$aResult[] = $row;
			}
			return json_encode($aResult);
		}else{
			return json_encode(array('KO','Cannot get info for this song'));
		}
	}


	
}

?>