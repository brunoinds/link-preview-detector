# Detect when a request is for preview generation

<p align="center">
  <img src="https://raw.githubusercontent.com/brunoinds/link-preview-origin/main/link-preview-origin.png"/>
</p>

## Use-case:
This tool addresses a common issue in modern web development: **How to detect if a request is for generating a link preview?**

Suppose your webpage needs to generate link previews for platforms like Facebook, WhatsApp, and Twitter. These previews are generated using meta-tags, which can slow down your page load time. Ideally, you want to generate these meta-tags only when the request is made by a bot from these platforms, not when a regular user is opening the page.

This tool provides a simple function that allows you to determine whether a page request is for generating a link preview or just a regular page visit by a user. This way, you can optimize your page load time by generating link previews only when necessary.

## How to install it?
You can install this package via composer:

```bash
composer require brunoinds/link-preview-detector
```

## How to use it?

### Method 1: Auto recognition
This method auto-capture the request origin and user-agent, and detects if is for link preview.

```php
use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;

$response = LinkPreviewDetector::isForLinkPreview();
//returns a boolean (true/false). If it is true, it means the request is coming from a link preview crawler.
```


### Method 2: Manual recognition
With this method you can pass an specific User-Agent and will return if is a link preview crawler:

```php
use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;

$userAgent = $_SERVER['HTTP_USER_AGENT'];

$response = LinkPreviewDetector::isForLinkPreviewUserAgent($userAgent);
```


## How to implement it (examples):
With the following example you can only send the metadata when it's required.

```php
use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;
$isForLinkPreview = LinkPreviewDetector::isForLinkPreview();

if ($isForLinkPreview)
{
  echo '<meta property="og:title" content="Your Website Title" />';
  echo '<meta property="og:description" content="Your Website Description" />';
  echo '<meta property="og:image" content="URL to the image" />';
  echo '<meta property="og:url" content="URL to your website" />';
}
```


One of the key benefits of this library is that it allows you to optimize your server's response based on the type of request. When a request is made specifically for link preview generation, **you don't need to send the entire webpage content**. Instead, you can **just send the meta-data required for the link preview**. This means you can **avoid sending unnecessary data** like JavaScript files, images, and other HTML content. This can significantly **improve the performance** of your server and the speed at which link previews are generated.
Here's an example of how you can use this library to achieve this:

```php
use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;

$isForLinkPreview = LinkPreviewDetector::isForLinkPreview();

if ($isForLinkPreview) {
  // Send only the meta-data required for link preview
  echo '<meta property="og:title" content="Your Website Title" />';

} else {
  // Send the entire webpage
   echo '
    <!DOCTYPE html>
    <html>
      <head>
        <title>Your Website Title</title>
        <script src="your-script.js"></script>
      </head>
      <body>
        <h1>Welcome to My Website</h1>
        <p>This is a sample paragraph.</p>
      </body>
    </html>';
}