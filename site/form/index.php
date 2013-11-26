
<?php
/**
 * Vefforritun 2013 - verkefni 5, sýnilausn
 *
 * Útfæra skal síðu sem birtir gögn um viðburði ásamt því að bjóða upp á að
 * bæta við viðburðum. Hægt skal vera að fá nánari upplýsingar um viðburð
 * með því að smella á heiti eða takka. Birta skal og bjóða upp á skráningu á:
 *  - Titil, title í grunni, krafist
 *  - Byrjunardagssetningu, start í grunni, geymt sem unix epoch time, kraf-ist
 *  - Endadagsetning, end í grunni, geymt sem unix epoch time
 *  - Lýsing, description í grunni, geymt með newline stöfum sem tilgreina enda á setningu, krafist
 *  - Location, staðsetning í grunni
 * Við skráningu skal bjóða upp á form með titli, byrjunar- og endadagsetn-ingu og lýsingu sem input af type text. 
 * Lýsing skal vera textarea. Ekki þarf að útfæra nákvæma skráningu á dagsetningum heldur gefa upp það form sem
 * nota skal sem placeholder (t.d. dd-mm-áááá kk:mm). Villumeðhöndlun skal vera á reitum skv. forskrift að ofan
 * ásamt því að passa upp á óæskileg gögn (t.d. of langir strengir eða SQL injection.)
 * Útlit á verkefni er frjálst en skal vera smekklegt og viðmót nytsamlegt.
 * 
 * Lausnin skiptist í þrennt:
 * - Þetta skjal, virkar sem hálfgerður controller
 * - Módel fyrir viðburð í event.class.php
 * - View fyrir útlit undir /views
 */

// Sendum út haus sem tilgreinir að efnið okkar sé HTML í UTF-8 stafasetti
header('Content-Type: text/html; charset=utf-8');

require('uppskriftin.class.php');

// $_SERVER superglobal inniheldur upplýsingar um request, viljum vita um HTTP aðferð
$method = $_SERVER['REQUEST_METHOD'];

// munum alltaf annaðhvort sækja eða senda inn gögn, svo skilgreina tengingu við gagnagrunn hér
$db = new PDO('sqlite:db/uppskriftir.db') or die ('unable to connect');

// við munum birta event í formi, hvort sem hann er útfylltur en ógildur eða 
$uppskriftin = new uppskriftin();

if ($method === 'POST')
{

	//var_dump($_POST);
	// sendum event gögn sem var post-að úr $_POST superglobal - viljum ekki að event dependy á global breytu
	$uppskriftin->populate($_POST);

	// aðeins ef engar villur koma upp í validation á viðburð bætum við honum við gagnagrunn
	

	if ($uppskriftin->valid())
	{
		$insert = $db->prepare("INSERT INTO uppskriftir (nafn, tegund, innskraning) VALUES(:nafn, :tegund, :innskraning)");

		//var_dump($db->errorInfo());

		if (!$insert->execute($uppskriftin-> insert()))
		{
			echo 'Gat ekki skráð uppskriftina! ';
		}
		else
		{
			// redirectum notanda á forsíðu með stöðubreytu, sjá nánar:
			// http://en.wikipedia.org/wiki/Post/Redirect/Get
			header('Location: index.php?success=true');
		}
	}
	//var_dump($uppskriftin);
}

// gerum ráð fyrir að ekki sé verið að velja stakan viðburð
$selected_uppskrift = 0;

// athuga hvort querystring innihaldi tölu í breytunni "event"
if (isset($_GET['uppskriftir']) && is_numeric($_GET['uppskriftir']))
{
	$selected_uppskrift = $_GET['uppskriftir'];
}

/** hér fyrir neðan búum við til síðuna úr nokkrum view-um **/

// höfum alltaf hausinn og formið aðgengilegt
include('views/header.php');
include('views/form.php');

// ef ekki er beðið um ákveðinn viðburð, sækja lista af öllum, raðað í dagsetningarröð
if ($selected_uppskrift === 0)
{
	$select = $db->query("SELECT id, nafn, tegund, innskraning FROM uppskriftir ORDER BY tegund");

	// $select breytan er notuð af view
	//include('views/skranings_list.php');
}
// annars sækja stakan viðburð
else
{
	$stm = $db->prepare("SELECT id, nafn, tegund, innskraning FROM uppskriftir WHERE id = :id");
	$stm->execute(array(':id' => $selected_uppskrift));

	$data = $stm->fetch();

	// $data breyta notuð af view
	include('views/skraning.php');
}

// loka síðu
include('views/footer.php');