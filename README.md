# CoffeeHouse API Wrapper for PHP

This is a very simple API Wrapper for the CoffeeHouse API. Using
This Library only supports the v2 API which is based from
this [Documentation](https://gist.github.com/Netkas/d3617e5b5b66c7851c728d3c0073529a)

## Usage

```php
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'CoffeeHouse' . DIRECTORY_SEPARATOR . 'CoffeeHouse.php');

$CoffeeHouse = new CoffeeHouse("<API KEY>");

// Create a new Session
$Session = $CoffeeHouse->createSession('en');
print("Session ID: " . $Session->ID . "\n");
print("Session Language: " . $Session->Language . "\n");
print("Session Available: " . $Session->Available . "\n");
print("Session Expires: " . $Session->Expires . "\n");

// Get an output from the AI
$Output = $CoffeeHose->thinkThought($Session->ID, "Hello! How are you?");
print("Output: " . $Output);
```