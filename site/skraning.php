
<?php


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
			header('Location: skraning.php?success=true');
		}
	}
	var_dump($uppskriftin);
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

// loka síðu
include('views/footer.php');