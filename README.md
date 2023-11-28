# Detect when a request is for preview generation

<p align="center">
  <img src="https://raw.githubusercontent.com/brunoinds/link-preview-origin/main/LinkPreviewOrigin.png"/>
</p>

## Use-case:
This tool is only to resolve a single modern page link preview question: **How to detect when a request is for a link preview generation?**

Your page needs the functionality to generate a Link Preview for Facebook, WhatsApp, Twitter. But you don't want to generate those meta-tags if is your user opening the page, and not Facebook's Bot. Generate links previews make your page loading slower. 
To fix it, you need to check if the request is being made by Facebook, Whatsapp, Twitter, or another social network bot.

With a single function, you can verify if your page is being requested to generate a link preview or is only your user opening the page!

## How to install it?

You can install this package via composer:

```bash
composer require brunoinds/link-preview-detector
```

## How to use it?

```php
use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;

$response = LinkPreviewOrigin::isForLinkPreview();
//returns a boolean (true/false). If it is true, it means the request is coming from a link preview crawler.
```
