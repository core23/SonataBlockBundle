UPGRADE 3.x
===========

## Deprecated AbstractBlockServiceTest class

The `Tests\Block\AbstractBlockServiceTest` class is deprecated. Use `Test\AbstractBlockServiceTestCase` instead.

## Deprecated BlockService assets in classes

The methods `BlockServiceInterface::getJavascripts` and `BlockServiceInterface::getStylesheets` are deprecated in favor of the new twig tags `sonata_block_javascript` and `sonata_block_stylesheets` to allow overriding the block assets.
