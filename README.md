# Detect when a request is for preview generation

## Use-case:
This tool is only to resolve a single modern page link preview question: **How to detect when a request is for preview generation?**

Your page needs the functionality to generate a Link Preview for Facebook, WhatsApp, Twitter. But you don't want to generate those meta-tags if is your user opening the page, and not Facebook's Bot. Generate links previews make your page loading slower. 
To fix it, you need to check if the request is being made by Facebook, Whatsapp, Twitter, or another social network bot.

With a single function, you can verify if your page is being requested to generate a link preview or is only your user opening the page!

## How to use it?

```
<?php 
require('path\to\LinkPreviewOrigin.php');

$response = LinkPreviewOrigin::isForLinkPreview();
//true or false

```
You only need to import the `LinkPreviewOrigin.php` file in this repository and call the `isForLinkPreview` method. It will return a `boolean`. If is `true`, you need to generate a Link Preview Meta-Tag.

## Attention
You need to have the `BlockList.json` file in the same directory of the `LinkPreviewOrigin.php`. The relation with the User-Agents is stored in this file.
