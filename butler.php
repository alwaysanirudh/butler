<?php
include('db_fns.php');

// includes a weight out of 20 for each word.
// Action = action
// Noun = person, place, thing
// Marker = something after this is important.
$wordlist = array(
				array("call",		True, "action"),
				array("check",		True, "action"),
				array("where",		True, "action"),
				array("what",		True, "action"),
				array("be",			True, "action"),
				array("get",		True, "action"),
				array("see",		True, "action"),
				array("email",		True, "action"),
				array("meeting",	True, "action"),
				array("remind",		True, "action"),
				array("schedule",	True, "action|noun"),
				array("at", 		True, "marker")
			);

// Get the phrase
if(isset($_POST['p'])){
	$phrase = $_POST['p'];
}else{
	$phrase = $_GET['p'];
}
$ophrase = $phrase;

// Get rid of some punctuation, and make lowercase.
$phrase = str_replace(',', '', $phrase);
$phrase = strtolower($phrase);
$phrase = str_replace('.', '', $phrase);
$phrase = strtolower($phrase);

// explode it into phrases by space
$phrase = explode(' ', $phrase);

// Setup every word with a weight of 0
foreach($phrase as $key => $wordbite){
	$phrase[$key] = array($wordbite, 0);
}

function register_action($word){
	switch ($word) {
		case 'meeting':
			// We'll schedule this new meeting!

			break;
		
		default:
			echo "Ouch. We didn't find a keyword...";
			break;
	}
}

function findActionWord($phrase, $actions){
	// Finds the "action" word. Email, call, find, etc.
	giveWeight(&$phrase, $actions, True);
	$reverted = new ArrayIterator(array_reverse($phrase));

	$value = 0;
	$winningword = null;
	foreach ($reverted as $key => $word) {
		if($word[1]>=$value){
			$value = $word[1];
			$winningword = $key;
		}
	}
	return $reverted[$winningword];
}
function giveWeight($phrasearray, $keywordsarray, $giveSWeight=True){
	// Keywordsarray model = array("word", True|False)
	// gives weight to words based on a list of known words.
	// If a word is found to have weight, the weight is given to its array, and
	// if giveSWeight is True, then words around it are given weight as well.
	$j = 0;
	foreach ($phrasearray as $key => &$wordchunk) {
		for ($i=0; $i < sizeof($keywordsarray); $i++) { 
			if($wordchunk[0]==$keywordsarray[$i][0]){
				// if giveSWeight is true, give weight to other words as well
				if ($giveSWeight) {
					try {
						if($key!=0){
							$phrasearray[$key-1][1]++;
						}
						if($key!=sizeof($phrasearray)-1){
							$phrasearray[$key+1][1]++;
						}
						$wordchunk[1]+=2;
					} catch (Exception $e) {
						
					}
				}
				else{
					$wordchunk[1]++;
				}
			}
		}
		$j++;
	}
}

echo json_encode(findActionWord($phrase, $wordlist));
?>