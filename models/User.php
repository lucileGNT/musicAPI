<?php

/**Class User
*
* @author Lucile Gentner lucile.gentner@gmail.com
* @version 1.0
*/

class User{

	private $user_id;

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
		$this->user_id = $id;
	}

	/** Destructor
	* @author Lucile Gentner lucile.gentner@gmail.com
	*/
	public function __destruct(){
		$this->dbh = null;
	}


	/** Get information about one particular user
	* @author Lucile Gentner lucile.gentner@gmail.com
	* @params $id id of the user
	* @returns JSON with user information
	*/
	public function getUserInfo(){
		$stmt = $this->dbh->prepare('SELECT * FROM USER WHERE USER_ID=:user_id');
		$stmt->bindParam(':user_id', $this->user_id);
		if ($stmt->execute()){
			$aResult = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$aResult[] = $row;
			}
			return json_encode($aResult);
		}else{
			return json_encode(array('KO','Cannot get info for this user'));
		}
	}


	/** Get list of favorite songs from user
	* @author Lucile Gentner lucile.gentner@gmail.com
	* @params $iUserId id of the user
	* @returns JSON with list of favorite songs
	*/
	function getFavoriteSongs(){
		$stmt = $this->dbh->prepare('
			SELECT DISTINCT FAVORITE_SONGS.song_id, SONG.title
			FROM FAVORITE_SONGS, SONG
			WHERE SONG.SONG_ID = FAVORITE_SONGS.SONG_ID
			AND FAVORITE_SONGS.USER_ID =:user_id'
			);
		$stmt->bindParam(':user_id', $this->user_id);
		if ($stmt->execute()){
			$aResult = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$aResult[] = $row;
			}
			return json_encode($aResult);
		}else{
			return json_encode(array('KO','Cannot get favorite list for this user'));
		}
	}

	/** Add song to users favorite list
	* @author Lucile Gentner lucile.gentner@gmail.com
	* @params $iUserId id of the user
	* @params $iSongId id of the song
	* @returns JSON with true or false
	*/
	function addSongToList($iSongId){
		$stmt = $this->dbh->prepare('INSERT INTO FAVORITE_SONGS (USER_ID, SONG_ID) VALUES (:user_id,:song_id)');
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->bindParam(':song_id', $iSongId);
		$res = $stmt->execute();
		if ($res){
			return json_encode (array('OK'));
		}else{
			return json_encode(array('KO','Cannot add this song'));
		}
	}

	/** Remove song from users favorite list
	* @author Lucile Gentner lucile.gentner@gmail.com
	* @params $iUserId id of the user
	* @params $iSongId id of the song
	* @returns JSON with true or false
	*/
	function removeSongFromList($iSongId){
		$stmt = $this->dbh->prepare('DELETE FROM FAVORITE_SONGS WHERE USER_ID = :user_id AND SONG_ID = :song_id');
		$stmt->bindParam(':user_id', $this->user_id);
		$stmt->bindParam(':song_id', $iSongId);
		$res = $stmt->execute();
		if ($res){
			return json_encode (array('OK'));
		}else{
			return json_encode(array('KO','Cannot remove this song'));
		}
	}
	
}

?>