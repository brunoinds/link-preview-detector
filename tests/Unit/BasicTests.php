<?php

use Brunoinds\LinkPreviewDetector\LinkPreviewDetector;



test('Check main response to be boolean', function () {
    $this->expect(LinkPreviewDetector::isForLinkPreview())->toBeBool();
});
