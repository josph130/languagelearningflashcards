<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Learning Flashcards</title>
</head>
<body>

<?php
session_start();

// Define available files with display names
$files = [
    'query_tr.json' => 'Turkish',
    'query_az.json' => 'Azerbaijani',
    'query_kk.json' => 'Kazakh',
    'query_uz.json' => 'Uzbek',
    'query_qxq.json' => 'Qashqai',
    'query_kmz.json' => 'Khorasani Turkic',
    'query_slr.json' => 'Salar',
    'query_soy.json' => 'Soyot'
];

// Handle file selection
if (isset($_POST['file'])) {
    $_SESSION['file'] = $_POST['file'];
    $_SESSION['current'] = 0; // Reset index when changing files
}

// Use selected file or default to the first one
$file = isset($_SESSION['file']) ? $_SESSION['file'] : array_key_first($files);

// Read JSON file
$json = file_get_contents($file);

// Decode JSON data
$data = json_decode($json, true);

// Check if decoding was successful
if ($data === null) {
    die('Error decoding JSON');
}

// Check if a "current" index is set in the session
if (!isset($_SESSION['current'])) {
    $_SESSION['current'] = 0;
}

// Display file selection dropdown
echo '<form method="post" action="index.php">';
echo '<label for="file">Select a language:</label>';
echo '<select name="file" id="file">';
foreach ($files as $f => $name) {
    $selected = ($f === $file) ? 'selected' : '';
    echo '<option value="' . $f . '" ' . $selected . '>' . $name . '</option>';
}
echo '</select>';
echo '<select name="group" id="group">';
    echo '<option value="all">All</option>';
echo '</select>';
echo '<input type="submit" value="Load">';
echo '</form>';
echo '<hr>';

// Display the current entry
$currentEntry = $data[$_SESSION['current']];
echo '<center><h1>Under Construction!</h1>';
echo '<h2>' . $currentEntry['sensenameLabel'] . '</h2>';
echo '<img src="' . $currentEntry['images'] . '?width=250" alt="' . $currentEntry['sensenameLabel'] . '">';
echo '<h2>' . $currentEntry['lemmas'] . '</h2></center>';
echo '<h2>' . $nextIndex . '/' . count($data) . '</h2></center>';
echo '<hr>';

// Display Next button
$nextIndex = ($_SESSION['current'] + 1) % count($data);
echo '<form method="post" action="index.php">';
echo '<input type="hidden" name="nextIndex" value="' . $nextIndex . '">';
echo '<center><input type="submit" value="Next"></center>';
echo '</form>';
echo '<hr>';
echo '<p>Please feel free to contact me at <a href="https://www.wikidata.org/wiki/User_talk:Joseph">https://www.wikidata.org/wiki/User_talk:Joseph</a></p>';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nextIndex'])) {
    $_SESSION['current'] = intval($_POST['nextIndex']);
    header('Location: index.php');
    exit;
}
?>

</body>
</html>
