<?php

// Include the Telegram Bot API library
require 'path/to/telegram-bot-api.php';

// Set the bot token
$botToken = '7094896891:AAFDdQUcOLlUwpSSPs9yp2wndS07t4nUzlQ';

// Set the Spotify API key
$spotifyApiKey = 'YOUR_SPOTIFY_API_KEY';

// Create a new bot instance
$bot = new TelegramBotAPI($botToken);

// Get the chat ID and voice message file ID
$chatID = $bot->getChatID();
$fileID = $bot->getFileID();

// Get the voice message file path
$voiceFilePath = $bot->getFilePath($fileID);

// Download the voice message file
$voiceFile = file_get_contents('https://api.telegram.org/file/bot' . $botToken . '/' . $voiceFilePath);

// Decode the voice message file
$voiceData = json_decode($voiceFile, true);

// Get the audio file ID from the voice message
$audioFileID = $voiceData['result']['audio']['file_id'];

// Get the audio file path
$audioFilePath = $bot->getFilePath($audioFileID);

// Download the audio file
$audioFile = file_get_contents('https://api.telegram.org/file/bot' . $botToken . '/' . $audioFilePath);

// Decode the audio file
$audioData = json_decode($audioFile, true);

// Get the song name from the audio file
$songName = $audioData['result']['title'];

// Search for the song on Spotify
$searchResult = file_get_contents('https://api.spotify.com/v1/search?q=' . urlencode($songName) . '&type=track&limit=1&access_token=' . $spotifyApiKey);

// Decode the search result
$searchData = json_decode($searchResult, true);

// Get the Spotify URI of the first track in the search result
$spotifyURI = $searchData['tracks']['items'][0]['uri'];

// Play the song on Spotify
// Implement your own logic to play the song on Spotify

// Send a reply message to the user
$bot->sendMessage($chatID, 'Now playing: ' . $songName);

?>
