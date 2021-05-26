<div class="clearfix">
    <ul class="<?=$cssClass ?>">
        <?php foreach ($sortedMenu as $item) { ?>
            <li<?= isCurrentUrl($item['url']) ? ' class="chosen"' : '' ?>><a href="<?= $item['url'] ?>"><?= cropString($item['title']) ?></a></li>
        <?php } ?>
    </ul>
</div>
