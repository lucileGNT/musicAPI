<?php

define ('SERVER_NAME', "localhost");
define ('DB_NAME', "musicapi_db");
define ('DB_USR','root');
define ('DB_PWD','');
require_once ('models/Song.php');
require_once ('models/User.php');

if (isset($_REQUEST['method'])){
	switch ($_REQUEST['method']){
		case 'user' : //get user
			if (isset($_REQUEST['id'])){
				$oneUser = new User ($_REQUEST['id']);
				echo $oneUser->getUserInfo();
			}else{
				echo json_encode(array("error","Please provide an id"));
			}
			break;
		case 'song' : //get song
			if (isset($_REQUEST['id'])){
				$oneSong = new Song ($_REQUEST['id']);
				echo $oneSong->getSongInfo();
			}else{
				echo json_encode(array("error","Please provide an id"));
			}
			break;
		case 'favorites' :
			if (isset($_REQUEST['submethod'])){
				if ($_REQUEST['submethod'] == 'add'){ //add song to favorites
					if (isset($_REQUEST['id']) && isset($_REQUEST['id2'])){
						$oneUser = new User ($_REQUEST['id']);
						echo $oneUser->addSongToList($_REQUEST['id2']);
					}else{
						echo json_encode(array("error","Please provide an id"));
					}	
				}else if ($_REQUEST['submethod'] == 'remove'){ //remove song
					if (isset($_REQUEST['id']) && isset($_REQUEST['id2'])){
						$oneUser = new User ($_REQUEST['id']);
						echo $oneUser->removeSongFromList($_REQUEST['id2']);
					}else{
						echo json_encode(array("error","Please provide an id"));
					}	
				}
			}else{
				if (isset($_REQUEST['id'])){
					$oneUser = new User ($_REQUEST['id']);
					echo $oneUser->getFavoriteSongs();
				}else{
					echo json_encode(array("error","Please provide an id"));
				}
			}
			break;
		default:

			break;
	}
}else{
	echo "<p>I created a small API called musicAPI<br/>
	Here are the methods of musicAPI<br/><br/>

	GET /musicAPI/user/12 							Get information about User with ID =12<br/>
	GET /musicAPI/song/25 							Get information about Song with ID = 25<br/>
	GET /musicAPI/favorites/12						Get list of favorite songs of User with ID = 12<br/>
	POST /musicAPI/favorites/add/12/25				Add song with ID = 25 to the favorite list of user with ID = 12<br/>
	DELETE /musicAPI/favorites/remove/12/25			Remove song with ID = 25 from the favorite list of user with ID = 12<br/><br/>

	The schema of my database is in the file DB.xls<br/>
	You can create a example of database using SQL file musicAPI_db_install.sql (directly imported from PHPmyadmin)</p>";
}
?>